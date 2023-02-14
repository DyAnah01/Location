<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repoCo): Response
    {
        $commande = $repoCo->findAll();

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commande' => $commande,
        ]);
    }
}
