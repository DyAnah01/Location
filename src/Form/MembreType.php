<?php

namespace App\Form;

use App\Entity\Membre;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',TextType::class,[
                "label"=>"Pseudo",
                "required"=>false,
                "attr"=>[
                "placholder"=>"saisir le pseudo",
                "class"=> "border border -primary"
                ]
                ])

            ->add('mdp',PasswordType::class,[
                "label"=>"Passe",
                "required"=>false,
                "attr"=>[
                "placeholder"=>"saisir mot de passe",
                "class"=>"border border-primary"
                ]
            ])
            ->add('nom',TextType::class,[
                  "label" =>"Nom",
                  "required"=>false,
                  "attr"=>[
                  "placeholder"=>"saisir votre nom",
                  "class"=>"border border -primary"
                  ] 
            ])

            ->add('prenom',TextType::class,[
                  "label"=>"Prenom",
                  "required"=>false,
                  "attr"=>[
                  "placeholde"=>"saisir votre prenom",
                  "class"=>"border border -primary"
                  ]
            ])

            ->add ('mdp',PasswordType::class,[
                  "label"=>"mdp",
                  "required"=>false,
                  "attr"=>[
                  "placeholder"=>"saisir le mot de passe",
                  "class"=>"border border -primary"
                    
                  ]
            ])

            ->add('email',EmailType::class,[
                 "label"=>"Mail",
                 "required"=>false,
                 "attr"=>[
                 "placeholder"=>"saisir votre mail",
                 "class"=>"border border -primary"
                 ]
            ])

             ->add('civilite',ChoiceType::class,[
                'choices'=>[
                 "homme"=>'H',
                 "femme"=>'M',   
                ],
                
             ])
                
            
            ->add('statut',ChoiceType::class,[
                 'choices'=>[
                 "admin"=> 0,
                 "user"=> 1,  
                 ],
                
            ])

            ->add('date_enregistrement',DateType:: class,[
                "label"=>"date",
                 "required"=>false,
                 "attr"=>[
                 "placeholder"=>"saisir date enregistrement",
                 "class"=>"border border-primary"

                 ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
