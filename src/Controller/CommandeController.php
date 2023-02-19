<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;


class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repoCo, Request $request): Response
    {
        $commande = $repoCo->findAllCommande();
        // dd($commande);
        // die;

        $start = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('dayStart'));
        $end = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('dayEnd'));

        
        // $start = $start->format('d/m/Y'); // for example
        // $end = $end->format('d/m/Y'); // for example

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commande' => $commande,
            'start' => $start,
            'end' => $end,
        ]);
    }

    // #[Route('/commande/update/{id}', name:'update_commande')]
    // public function commande_modifier($id, CommandeRepository $repoC, Request $request ,EntityManagerInterface $manager)
    // {
    //     $commande = $repoC->findAllCommande($id);
    //     // dd($commande);
    //     // die;
    //     $form =$this->createForm(CommandeType::class, $commande);
    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $manager->persist($commande);
    //         $manager->flush();

    //         $this->addFlash("success","La commande N°" . $commande->getId(). " a été modifié");
    //         return $this->redirectToRoute('app_commande');
    //     }

    //     return $this->render("commande/com_update.html.twig",[
    //         "commande" => $commande,
    //     ]);
    // }
    #[Route('/commande/supprimer/{id}', name:'supprimer_commande')]
    public function agences_delete(Commande $co, EntityManagerInterface $manager)
    {
        $idCommande = $co->getId();
        $manager->remove($co);
        $manager->flush();

        $this->addFlash("success", "L'agence N° $idCommande a été supprimé");
        return $this->redirectToRoute("app_commande");

    }

}
