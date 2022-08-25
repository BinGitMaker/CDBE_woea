<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Mail;
use App\Form\RegisterType;
use App\Repository\LogoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, LogoRepository $logos): Response
    {
        $notification = null;

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            //verif User doesn't exist yet
            $search_mail = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_mail){

                $password = $encoder->hashPassword($user,$user->getPassword());

                $user->setPassword($password);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $mail = new Mail();
                    $content = "Bonjour ".$user->getFirstname()."<br/>Bienvenue dans mon Cabinet de Bien-Être - Sandrine Picod.<br/>";
                    $mail->send(
                        $user->getEmail(), //get user email
                        $user->getFirstname(), //get user information
                        'Bienvenue dans mon Cabinet de Bien-Être - Sandrine Picod.', //Subject of mail
                        $content //content of mail
                    );

                $notification = "Votre inscription est validée. Vous pouvez dès à présent vous connecter à votre compte.";
            }else{
                $notification = "L'email que vous avez renseigné existe dèjà.";
            }
        }
        
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'logos' => $logos->findAll(),
            'notification' => $notification,
        ]);
    }
}
