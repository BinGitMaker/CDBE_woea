<?php

namespace App\Form;

use App\Entity\MassCategory;
use App\Entity\Massage;
use App\Entity\Pack;
use App\Entity\PackCatSolo;
use App\Entity\PackCatMulti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MassageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du Massage',
                ])
            ->add('slug', TextType::class, [
                'label' => 'Slug (ecrire-ainsi-le-slug)',
                ])
            ->add('undertitle', TextType::class, [
                'label' => 'Sous-titre du Massage',
                ])
            ->add('illustration', FileType::class, [
                'label' => 'photo du Massage',
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
            ->add('explication', TextareaType::class, [
                'label' => 'Explication',
                'attr' => ['rows' => '4']
                ])
            ->add('problem', TextareaType::class, [
                'label' => 'Problematique',
                'attr' => ['rows' => '4']
                ])
            ->add('good', TextareaType::class, [
                'label' => 'Bienfaits',
                'attr' => ['rows' => '4']
                ])
            ->add('work', TextareaType::class, [
                'label' => 'Déroulement',
                'attr' => ['rows' => '4']
                ])
            ->add('oil', CheckboxType::class, [
                'label' => 'huile',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
            ->add('massCategory', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'class' => MassCategory::class,
            ])
            ->add('pack', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Forfait',
                'class' => Pack::class,
                'multiple' => true,
                'expanded' => true,
            ])
             ->add('packCatSolo', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Intitulé du groupe de forfait seul',
                'class' => PackCatSolo::class,
                'expanded' => true,
            ])
            ->add('packCatMulti', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Intitulé du groupe de forfait multiple',
                'class' => PackCatMulti::class,
                'expanded' => true,
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Massage::class,
        ]);
    }
}
