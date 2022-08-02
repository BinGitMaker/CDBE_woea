<?php

namespace App\Form;

use App\Entity\Pack;
use App\Entity\Massage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('time', IntegerType::class, [
                'label' => 'Durée du massage/forfait',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix du massage/forfait',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Description de massage/forfait',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du forfait',
            ])
            ->add('isSolo', CheckboxType::class, [
                'label' => 'Séance(Activé)/Forfait(Désactivé)',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
            ->add('modality', TextareaType::class, [
                'label' => 'Modalité du massage/forfait',
                'required' => false,
            ])
            ->add('packHasMassages', EntityType::class, [
                'class' => Massage::class,
                'choice_label' => 'title',
                'mapped' => false,
                'label' => 'Massage(s) Associé(s)',
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pack::class,
        ]);
    }
}
