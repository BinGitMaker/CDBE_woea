<?php

namespace App\Form;

use App\Entity\SendMsg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('name', TextType::class,[
                'label' => 'Votre prénom :',
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
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Votre email :',
                'attr' => [
                    'placeholder' => 'Saisissez votre email'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message :',
                'attr' => ['rows' => 12 ]
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
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
