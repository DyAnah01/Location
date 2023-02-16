<?php

namespace App\Form;

use App\Entity\Agences;
use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccueilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_heure_depart',DateType::class,[
                "label"=>"Début de location",
                 "required"=>false,
                 "attr"=>[
                 "placeholder"=>"saisir date enregistrement",
                 "class"=>"m-0 p-0"

                 ]
            ])
            ->add('date_heure_fin',DateType::class,[
                "label"=>"Fin de location",
                 "required"=>false,
                 "attr"=>[
                 "placeholder"=>"Fin de location",
                 "class"=>"m-0 p-0"

                 ]
            ])
            // ->add('date_heure_fin')
            // ->add('prix_total')
            // ->add('date_enregistrement')
            // ->add('id_membre')
            // ->add('id_vehicule')
            // ->add('id_agence')
            ->add('id_agence', EntityType::class, [
                'class' => Agences::class,
                'placeholder' => 'Adresse de départ',
                'choice_label'=>'titre',
                'label' => "Adresse de départ",
                'required'=>false,
                "attr" => [
                    "class" => "m-0 p-2",
                ]
               ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
