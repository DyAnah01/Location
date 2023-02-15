<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name:'app_vehicule')]
    public function index(VehiculeRepository $repoVehicule, Request $request , EntityManagerInterface $manager): Response
    {
        $vh= new Vehicule ;
        $form = $this->createForm(VehiculeType::class, $vh);
        $form->handleRequest($request);
        $vehicule = $repoVehicule->findAll();

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vh); 
            $manager->flush();
            
           

            $this->addFlash('success', "La catégorie N°".$vh->getId() ."a bien été ajoutée");
            
            return $this->redirectToRoute("app_vehicule");
    
        }
       
        return $this->render('vehicule/index.html.twig',[
            "vehicule"=>$vehicule,
            "formVehicule" => $form->createView(),
            // dans l'objet form se trouve une methode createView permettant de créer la structure en html du formulaire
        ]);

    }
    #[Route('/vehicule/detail/{id}', name: 'detail')] // Detail
    public function vehicule_detail($id, VehiculeRepository $repoA){
        $vehicule = $repoA->find($id);
        return $this->render("vehicule/vehicule_detail.html.twig",[
            "ve" => $vehicule
        ]);
    }

    #[Route('/vehicule/update/{id}', name: "update_vehicule")] // update
    public function vehicule_modifier($id, VehiculeRepository $repoAg, Request $request, EntityManagerInterface $manager)
    {
        $vehicule = $repoAg->find($id);
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule);
            $manager->flush();

            $this->addFlash("success", "vehicule N°" . $vehicule->getId() . " a bien été modifié");
            return $this->redirectToRoute("app_vehicule");
        }
        return $this->render("vehicule/vehicule_update.html.twig",[
            "formVehicule" => $form->createView(),
            "vehicule" => $vehicule
        ]);

    }

    #[Route('/vehicule/supprimer/{id}', name:'supprimer_vehicule')] // delete
    public function vehicule_delete(Vehicule $vehicule, EntityManagerInterface $manager)
    {
        $idVe = $vehicule->getId();
        $manager->remove($vehicule);
        $manager->flush();

        $this->addFlash("success", "L'agence N° $idVe a été supprimé");
        return $this->redirectToRoute("app_vehicule");

    }
}
