<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Votre prénom :',
                'attr' => [
                    'placeholder' => 'Saisissez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom :',
                'attr' => [
                    'placeholder' => 'Saisissez votre nom'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Votre mail :',
                'attr' => [
                    'placeholder' => 'Saisissez votre mail'
                ]
            ])
            ->add('password', PasswordType::class,[
                'label' => 'Votre mot de passe :',
                'attr' => [
                    'placeholder' => 'Saisissez votre mot de passe'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'S\'inscrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
