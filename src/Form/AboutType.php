<?php

namespace App\Form;

use App\Entity\About;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AboutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('undertitle', TextareaType::class, [
                'label' => 'Sous-titre',
                ])
            ->add('title1', TextType::class, [
                'label' => 'Titre n°1',
                ])
            ->add('description1', TextareaType::class, [
                'label' => 'Descriptif',
                'attr' => ['rows' => '15'],
            ])
            ->add('pics1', FileType::class,  [
                'label' => 'Image du texte n°1',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'Merci de charger une photo valide',
                    ])
                ], 
            ])
            ->add('title2', TextType::class, [
                'label' => 'Titre n°2',
                ])
            ->add('description2', TextareaType::class, [
                'label' => 'Descriptif',
                'attr' => ['rows' => '15'],
            ])
            ->add('pics2', FileType::class,  [
                'label' => 'Image du texte n°2',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'Merci de charger une photo valide',
                    ])
                ], 
            ])
            ->add('title3', TextType::class,  [
                'label' => 'Titre n°3',
                ])
            ->add('description3', TextareaType::class, [
                'label' => 'Descriptif',
                'attr' => ['rows' => '15'],
            ])
            ->add('pics3', FileType::class,  [
                'label' => 'Image du texte n°3',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'Merci de charger une photo valide',
                    ])
                ], 
            ])
            ->add('illustration', FileType::class,  [
                'label' => 'Photo de profil',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'Merci de charger une photo valide',
                    ])
                ], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => About::class,
        ]);
    }
}
