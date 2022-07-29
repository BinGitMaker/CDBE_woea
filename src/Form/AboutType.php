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
            ->add('undertitle', TextareaType::class)
            ->add('title1', TextType::class)
            ->add('description1', TextareaType::class)
            ->add('pics1', TextType::class)
            ->add('title2', TextType::class)
            ->add('description2', TextareaType::class)
            ->add('pics2', TextType::class)
            ->add('title3', TextType::class)
            ->add('description3', TextareaType::class)
            ->add('pics3', TextType::class)
            ->add('illustration', FileType::class,  [
                'label' => 'photo',
                'mapped' => false,
                'required' => false,
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
