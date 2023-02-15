<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\AccueilType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(CommandeRepository $repoCo, Request $request, EntityManagerInterface $manager): Response
    {
        
        $c = $repoCo->findAllCommande();
        // dd($c);
        $com = new Commande;
        $form = $this->createForm(AccueilType::class, $com);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($com);
            $manager->flush();

            return $this->redirectToRoute('app_accueil');
        }


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            "c" => $c,
            "formCo" => $form->createView(),

        ]);
    }
}
