<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    #[Route('/membre', name: 'app_membre')]
    
    public function index(MembreRepository $repoMembre, Request $request, EntityManagerInterface $manager):Response
    {
        $membre = $repoMembre->findAll();
        $mem = new Membre;
        $form = $this->createForm(Membre::class,$mem);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
         $manager->persist($mem);
         $manager->flush();

         $this->addFlash ('success', 'Membre'.$mem->getId(). "a bien ete ajouter"); 
         return $this->redirectToRoute ('membre/index.html.twig'); 

        }

        return $this->render("membre/index.html.twig", [
            'controller_name'=>'membreController',
            'membre'=>$membre,
            "formMembre"=> $form->createView(),
        ]);
    }
}
