<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'évenement',
                'constraints' => new Length(
                    [
                        'max' => 17,
                    ]), 
                ])
            ->add('illustration', FileType::class, [
                'label' => 'Photo de l\'évenement',
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
                    ])], 
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descriptif',
                'attr' => ['rows' => '4'],
                'constraints' => new Length(
                    [
                        'max' => 370,
                    ]),
                ])
            ->add('startDate', DateType::class, [
                'label' => 'Début de l\'évenement',
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
            ])
            ->add('endDate', DateType::class, [
                'label' => 'Fin de l\'évenement',
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse de l\'évenement',
                'constraints' => new Length(
                    [
                        'max' => 30,
                    ]), 
                ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix du produit',
            ])
            ->add('public', TextType::class, [
                'label' => 'Public de l\'évenement',
                'constraints' => new Length(
                    [
                        'max' => 30,
                    ]), 
                ])
            ->add('is_old', CheckboxType::class, [
                'label' => 'Archives(Activé)/sinon(Désactivé) // Si Activé: l\'évenement apparaitra en archive et disparaitra des actifs',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
            ->add('is_workshop', CheckboxType::class, [
                'label' => 'Atelier(Activé)/sinon(Désactivé) // Si Activé: l\'évenement est consideré comme Atelier sinon il sera considéré comme Salon',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
