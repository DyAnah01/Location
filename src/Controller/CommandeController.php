<?php

namespace App\Controller;

// use App\Entity\Commande;
// use App\Form\AgencesType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repoCo): Response
    {
        $commande = $repoCo->findAllCommande();
        // dd($commande);
        // die;
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commande' => $commande,
            
        ]);
    }
}
