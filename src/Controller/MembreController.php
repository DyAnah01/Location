<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    #[Route('/admin/membre', name: 'app_membre')]
    public function index(MembreRepository $repoMembre, Request $request, EntityManagerInterface $manager):Response
    {
        $membre = $repoMembre->findAll();
        $mem = new Membre;

     
        $form = $this->createForm(MembreType::class,$mem);


       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
         $manager->persist($mem);
         $manager->flush();

         $this->addFlash ('success', 'Membre'.$mem->getId(). "a bien ete ajouter"); 
         return $this->redirectToRoute ('app_membre'); 

        }

        return $this->render("membre/index.html.twig", [
            'controller_name'=>'membreController',
            'membre'=> $membre,
            "formMembre"=> $form->createView(),
        ]);
    

    // Affihcer detail 
       }

    #[Route('/admin/membre/detail/{id}', name: 'detail')]
     public function membre_detail($id, MembreRepository $reposM){
       $membre = $reposM->find($id);
       return $this->render("membre/membre_detail.html.twig",[
        "add" => $membre
    ]);

    }

    #[Route('/admin/membre/update/{id}', name: "membre_update")]
    public function membre_modifier($id, membreRepository $reposMe, Request $request, EntityManagerInterface $manager)
    {
        $membre = $reposMe->find($id);
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($membre);
            $manager->flush();

            $this->addFlash("success", "membre N°" . $membre->getId() . " a bien été modifié");
            return $this->redirectToRoute("app_membre");
        }
        return $this->render("membre/membre_update.html.twig",[
            "formMembre" => $form->createView(),
            "membre" => $membre
        ]);

    }

    #[Route('/admin/membre/suprimer/{id}', name:'supprimer_membre')]
    public function membre_delete(Membre $membre, EntityManagerInterface $manager)
    {
        $idMe = $membre->getId();
        $manager->remove($membre);
        $manager->flush();

        $this->addFlash("success", " Membre N° $idMe a été supprimé");
        return $this->redirectToRoute("app_membre");

    }

}


   


