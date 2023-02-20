<?php

namespace App\Controller;

// use App\Entity\Agences;
use App\Entity\Commande;
// use App\Entity\User;
// use App\Entity\Vehicule;
// use App\Form\AccueilType;
use App\Repository\AgencesRepository;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;



class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(VehiculeRepository $repoVehicule, AgencesRepository $repoAgences, Request $request, EntityManagerInterface $manager): Response
    {
        $v = $repoVehicule->getAllV();
        // dd($v);
        $agence = $repoAgences->findAll();
                

        if ($request->isMethod('post')) {
            // dd($request);
            $agences = $repoAgences->findAll();

            $idAgence = $request->request->get('ag');
            //    dd($agence);

            $v = $repoVehicule->getIdAg($idAgence);
         
            $start = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeDebut'));
            $end = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeFin'));

            $intervalle = $start->diff($end);

            // $start = $commande->gej();
            // $end =  $commande->getEnd();
            // $diff = $start->diff($end);
            // $commande->setTotal( ($diff));
            
            // dd($intervalle);
            return $this->render('accueil/index.html.twig', [
                'filterVehicule' => true,
                'controller_name' => 'AccueilController',
                "v" => $v,
                "agences" => $agences,
                'day'=>$intervalle->days,
                'start'=>$start->format('y-m-d H:i:s'),
                'end'=>$end->format('y-m-d H:i:s'),
    
            ]);
        }
        return $this->render('accueil/index.html.twig', [
            'filterVehicule' => false,
            'controller_name' => 'AccueilController',
            "v" => $v,
            "agences" => $agence,
        ]);
    }

    #[Route('/accueil/validation/{idVehicule}/{idUser}/{idAgence}/{prix_total}/{start}/{end}', name: 'validation_commande')]
    public function ajoutUserCommande($idVehicule, $idUser, $idAgence, $prix_total,$start,$end, VehiculeRepository $repoVehicule, UserRepository $repoUser, AgencesRepository $repoAgences, Request $request, EntityManagerInterface $manager)
    {
        // dd($c);
        // FK Commande
        $vehicule = $repoVehicule->find($idVehicule);
        $user = $repoUser->find($idUser);
        $agences = $repoAgences->find($idAgence);

        // $start = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeDebut'));
        // $end = \DateTime::createFromFormat('Y-m-d\TH:i', $request->request->get('timeFin'));
        
        $commande = new Commande;
        $commande->setIdVehicule($vehicule);
        $commande->setIdUser($user);
        $commande->setIdAgence($agences);
        $commande->setDateHeureDepart(new \DateTime($start));
        $commande->setDateHeureFin(new \DateTime($end));
        $commande->setPrixTotal($prix_total);
        $commande->setDateEnregistrement(new \DateTime());
        // $commande->setIdMembre($user);

        // dd($commande);

        $manager->persist($commande);
        $manager->flush();
        return $this->redirectToRoute('app_accueil');
    }




    #[Route('/accueil/historiqueDeCommande', name:'historique')]
    public function historique()
    {
        return $this->render('accueil/historique.html.twig');
    }



}
