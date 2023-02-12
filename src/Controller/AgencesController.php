<?php

namespace App\Controller;

use App\Entity\Agences;
use App\Form\AgencesType;
use App\Repository\AgencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgencesController extends AbstractController
{
    #[Route('/agences', name: 'app_agences')]
    public function index(AgencesRepository $repoAgences, Request $request, EntityManagerInterface $manager): Response
    {
        $agences = $repoAgences->findAll();

        $ag = new Agences;
        $form = $this->createForm(AgencesType::class, $ag);
        $form->handleRequest(($request));

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($ag);
            $manager->flush();

            $this->addFlash('success', "L'Agence n° ". $ag->getId() . " a bien été ajoutée");
            return $this->redirectToRoute('app_agences');
        }
        return $this->render('agences/index.html.twig', [
            'controller_name' => 'AgencesController',
            "agences" => $agences,
            "formAgences" => $form->createView(),
        ]);
    }



    #[Route('/agences/update/{id}', name: "update_agence")]
    public function agences_modifier($id, AgencesRepository $repoAg, Request $request, EntityManagerInterface $manager)
    {
        $agence = $repoAg->find($id);
        $form = $this->createForm(AgencesType::class, $agence);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($agence);
            $manager->flush();

            $this->addFlash("success", "L'agence N°" . $agence->getId() . " a bien été modifié");
            return $this->redirectToRoute("update_agence");
        }
        return $this->render("agences/agences_update.html.twig",[
            "formAgence" => $form->createView(),
            "agence" => $agence
        ]);

    }


}
