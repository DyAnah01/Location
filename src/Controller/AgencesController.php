<?php

namespace App\Controller;

use App\Repository\AgencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgencesController extends AbstractController
{
    #[Route('/agences', name: 'app_agences')]
    public function index(): Response
    {
        return $this->render('agences/index.html.twig', [
            'controller_name' => 'AgencesController',
        ]);
    }


    #[Route('/agences', name:"afficher")]
    public function agences_afficher(AgencesRepository $repoAgences)
    {
        $agences = $repoAgences->findAll();

        return $this->render("agences/agences_afficher.html.twig", [
            "agences" => $agences
        ]);
    }
}
