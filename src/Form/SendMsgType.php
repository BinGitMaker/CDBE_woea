<?php

namespace App\Form;

use App\Entity\SendMsg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class SendMsgType extends AbstractType
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
                    'class' => 'shadow p-3 bg-light rounded',
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
                    'placeholder' => 'Saisissez votre nom',
                    'class' => 'shadow p-3 bg-light rounded',
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Votre email :',
                'attr' => [
                    'placeholder' => 'Saisissez votre email',
                    'class' => 'shadow p-3  bg-light rounded',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message :',
                'attr' => [
                    'placeholder' => 'En quoi puis-je vous aider?',
                    'class' => 'shadow p-3 mb-3 bg-light rounded',
                    'rows' => 12 ],
            ])
            ->add('captcha', ReCaptchaType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-rdv btn-lg btn-dark bg-primary text-light'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SendMsg::class,
        ]);
    }
}
