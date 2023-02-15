<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(Request $request, EntityManagerInterface $manager, CommandeRepository $repoCo): Response
    {
        
        $c = $repoCo->findAllCommande();
        // dd($c);
        // die;
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            "c" => $c,

        ]);
    }


    // #[Route("/gestion/afficher", name:"category_afficher")]
    // public function category_afficher(CategoryRepository $repoCategory)
    // {
    //     $categories = $repoCategory->findAll();//SELECT * FROM category
    //     return $this->render("admin_category/category_afficher.html.twig",[
    //         "categories" => $categories
    //     ]);
    // }
}
