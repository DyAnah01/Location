<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contact)
    {   
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

      return $this->render('contact/index.html.twig',[
              'form' => $form->createView()
      ]);
    }
   
   
}



// return $this->render('contact/index.html.twig', [
//     'controller_name' => 'ContactController',
// ]);