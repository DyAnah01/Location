<?php

namespace App\Form;

use App\Entity\Agences;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                "label"=>"Titre",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Titre de l'annonce",
                    "class"=>"border border-primary"]
            ]
             )
            ->add('marque', TextType::class,  [
                "label"=>"Marque",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Marque",
                    "class"=>"border border-primary"]
            ]
            )
            ->add('modele', TextType::class,  [
                "label"=>"Modele",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Modele",
                    "class"=>"border border-primary"]
            ]
            )
            ->add('description',TextareaType::class, [
                "label"=>"description",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Description de votre vehicule",
                    "class"=>"border border-primary"]
            ]
            )
            ->add('photo', TextType::class,  [
                "label"=>"photo",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "photo 1",
                    "class"=>"border border-primary"]
            ]
            )
            ->add('prix_journalier', TextType::class,  [
                "label"=>"Prix",
                "required"=>false,//mettre valeur par défaut qui est ne nom de propriété à false pour le modifier
                "attr"=>[
                    "placeholder"=> "Prix journalier",
                    "class"=>"border border-primary"]
            ])
        
           ->add('id_agence', EntityType::class, [
            'class' => Agences::class,
            'placeholder' => 'selectioner une agence',
            'choice_label'=>'titre',
            'required'=>false
           ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
