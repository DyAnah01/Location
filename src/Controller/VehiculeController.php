<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name:'app_vehicule')]
    public function index(VehiculeRepository $repoVehicule, Request $request , EntityManager $manager): Response
    {
        $vehicule = new Vehicule ;
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        $vehicule = $repoVehicule->findAll();

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule); 
            $manager->flush();

            $this->addFlash('succes', "La catégorie N°$vehicule a bien été ajoutée");
            
            return $this->redirectToRoute("index");
    
        }
       
        return $this->render('vehicule/index.html.twig',[
            "Vehicule"=>$vehicule,
            "formVehicule" => $form->createView(),
            // dans l'objet form se trouve une methode createView permettant de créer la structure en html du formulaire
        ]);

    }
}
