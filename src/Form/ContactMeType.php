<?php

namespace App\Form;

use App\Entity\ContactMe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactMeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone', TextType::class,[
                'label' => 'Saisissez votre numéro de téléphone :',
                'constraints' => new Length(
                    [
                        'min' => 12,
                        'max' => 12,
                        'minMessage' => 'Il semblerait que vous ayez tapé un numero en trop, votre numéro de téléphone est trop court, il doit comporter {{ limit }} caractères au minimum',
                        'maxMessage' => 'Il semblerait que vous ayez oublié de saisir un numero, votre numéro de  téléphone est trop long , il doit comporter {{ limit }} caractères au maximum',
                    ]
                ), 
                'attr' => [
                    'placeholder' => '+33600112233',
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Votre email :',
                'attr' => [
                    'placeholder' => 'Saisissez votre email'
                ]
            ])
            ->add('address1', TextType::class, [
                'label' => 'Adresse de votre cabinet n°1',
                'required' => false,
                ])
            ->add('address2', TextType::class, [
                'label' => 'Adresse de votre cabinet n°2',
                'required' => false,
                ])
            ->add('map', FileType::class,  [
                'label' => 'Google view de votre cabinet n°1',
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
            ->add('content', TextareaType::class, [
                'label' => 'Texte de presentation de votre page contact
                (pour les saut de ligne ajouter ceci "<br>" sans espace)',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMe::class,
        ]);
    }
}
