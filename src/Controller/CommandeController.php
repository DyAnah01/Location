<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
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
    #[Route('/commande/update/{id}', name:'update_commande')]
    public function commande_modifier($id, CommandeRepository $repoC, Request $request ,EntityManagerInterface $manager)
    {
        $commande = $repoC->findAllCommande($id);
        $form =$this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($commande);
            $manager->flush();

            $this->addFlash("success","La commande N°" . $commande->getId(). " a été modifié");
            return $this->redirectToRoute('app_commande');
        }

        return $this->render("commande/com_update.html.twig",[
            "formCommande" => $form->createView(),
            "Commande" => $commande,
        ]);
    }

}
