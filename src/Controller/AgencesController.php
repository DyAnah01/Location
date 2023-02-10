<?php

namespace App\Controller;

use App\Repository\AgencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgencesController extends AbstractController
{
    #[Route('/agences', name: 'app_agences')]
    public function index(AgencesRepository $repoAgences): Response
    {
        $agences = $repoAgences->findAll();

        

        return $this->render('agences/index.html.twig', [
            'controller_name' => 'AgencesController',
            "agences" => $agences,
        ]);
    }



    // #[Route('/agences/showAdd', name: "showAdd")]
    // public function agences_ajouter()


}
