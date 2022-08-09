<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProdCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du Produit',
                ])
            ->add('slug', TextType::class, [
                'label' => 'Slug (ecrire-ainsi-le-slug)',
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
            ->add('subtitle', TextType::class, [
                'label' => 'sous-titre',
                ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'attr' => ['rows' => '4']
                ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix du produit',
            ])
            ->add('category', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'class' => ProdCategory::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
