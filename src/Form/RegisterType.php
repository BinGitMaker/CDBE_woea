<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class,[
            'label' => 'Votre prénom :',
            'constraints' => new Length(
                [
                    'min' => 2,
                    'max' => 30,
                    'minMessage' => 'Votre prénom est trop court, il doit comporter {{ limit }} caractères au minimum',
                    'maxMessage' => 'Votre prénom est trop long, il doit comporter {{ limit }} caractères au maximum',
                ]
            ), 
            'attr' => [
                'placeholder' => 'Saisissez votre prénom',
            ]
        ])
        ->add('lastname', TextType::class,[
            'label' => 'Votre nom :',
            'constraints' => new Length(
                [
                    'min' => 2,
                    'max' => 30,
                    'minMessage' => 'Votre nom est trop court, il doit comporter {{ limit }} caractères au minimum',
                    'maxMessage' => 'Votre nom est trop long, il doit comporter {{ limit }} caractères au maximum',
                ]
            ),
            'attr' => [
                'placeholder' => 'Saisissez votre nom'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Votre email :',
            'attr' => [
                'placeholder' => 'Saisissez votre email'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class, 
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques!',
            'label' => 'Votre mot de passe :',
            'required' => true,
            'first_options' => [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Saisissez votre mot de passe'
                ],
            ],
            'constraints' => new Length(
                [
                    'min' => 8,
                    'max' => 30,
                    'minMessage' => 'Votre mot de passe doit comporter {{ limit }} caractères au minimum et être composé d\'au moins : <br> - 1 lettre minuscule <br> - 1 lettre majuscule <br> - 1 chiffre <br> - 1 caractère spéciale',
                    'maxMessage' => 'Votre mot de passe est trop long, il doit comporter {{ limit }} caractères au maximum',
                ]
            ),
            'second_options' => [
                'label' => 'Confirmation du mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre mot de passe'
                ]
            ],
            
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'S\'inscrire',
            'attr' => [
                'class' => 'btn btn-lg btn-primary'
            ]
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
