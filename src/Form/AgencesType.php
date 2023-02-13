<?php

namespace App\Form;

use App\Entity\Agences;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class , [
                'label'=> "Titre",
                'required'=> false,
                    "attr" => [
                        'placehoder'=> "Titre de l'agence",
                        "class" => 'form-control'
                    ]
            ])
            ->add('adresse', TextType::class, [
                'label'=> "Adresse",
                "required" => false,
                "attr" => [
                    "placeholder" => "Saisir l'adresse",
                    "class" => 'form-control'
                ]
            ])
            ->add('ville', TextType::class, [
                "label" => "Ville",
                "required" => false,
                "attr" => [
                    "placeholder" => "La ville",
                    "class" => "form-control"
                ]
            ])
            ->add('cp', NumberType::class, [
                "label"=>"Code Postal",
                "required" => false,
                "attr"=> [
                    "placeholder" => "Code Postal",
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label"=> "Description",
                "required" => false,
                "attr" => [
                    "placeholder" => "Description",
                    "class" => "form-control"
                ]
            ])
            ->add('photo', TextType::class, [
                'label' => "photo",
                "required" => false,
                "attr" => [
                    "placeholder" => "Photo",
                    "class" => "form-control"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agences::class,
        ]);
    }
}
