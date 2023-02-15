<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;






class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contact,Request $request,EntityManagerInterface $manager)
    {   
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
          $manager->persist($contact);
          $manager->flush();
          $this->addflash('success', "La categorie a bien ete ajoutée");
          return $this->redirectToRoute("contacts_afficher");
        }

      return $this->render('contact/index.html.twig',[
              'form' => $form->createView()
      ]);
    }
   
    #[Route('/contacts', name: 'contacts_afficher')]
    public function afficher_contact(ContactRepository $contactRepository)
  {
    $contacts = $contactRepository->findAll();
    return $this->render('contact/contact.html.twig',[
      "contacts" => $contacts
    ]);
  }
  /**
     * @Route("/contact/supprimer/{id}", name="delete_message")
     */
    public function delete(Contact $contact, EntityManagerInterface $manager)
    {
        $manager->remove($contact);
        $manager->flush();

        $this->addFlash('success', "l'agence" . $contact->getId() . "a bien été supprimer");
        return $this->redirectToRoute("contats_afficher");
}

}



 


