<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',TexteType::class,[
                "label"=>"Pseudo",
                "require"=>false,
                "attr"=>[
                "placholder"=>"saisir le pseudo",
                "class"=> "border border -primary"
                ]
                ])

            ->add('mdp',Password::class,[
                "label"=>"Passe",
                "require"=>false,
                "attr"=>[
                "placeholder"=>"saisir mot de passe",
                "class"=>"border border-primary"
                ]
            ])
            ->add('nom',TextType::class,[
                  "label" =>"Nom",
                  "require"=>false,
                  "attr"=>[
                  "placeholder"=>"saisir votre nom",
                  "class"=>"border border -primary"
                  ] 
            ])

            ->add('prenom',TextType::class,[
                  "label"=>"Prenom",
                  "require"=>false,
                  "attr"=>[
                  "placeholde"=>"saisir votre prenom",
                  "class"=>"border border -primary"
                  ]
            ])
            ->add('email',EmailType::class,[
                 "label"=>"Mail",
                 "require"=>false,
                 "attr"=>[
                 "placeholder"=>"saisir votre mail",
                 "class"=>"border border -primary"
                 ]
            ])

            // ->add('civilite',ChoiceType::class,[
            //      "choises"=>[

            //      ]
            // ])
            ->add('statut')
            ->add('date_enregistrement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
