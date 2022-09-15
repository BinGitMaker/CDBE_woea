<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Mail;
use App\Entity\ResetPassword;
use App\Form\ResetPasswordType;
use App\Repository\LogoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/mot-de-passe-oublié', name: 'reset_password')]
    public function index(Request $request, LogoRepository $logos): Response
    {
        if ($this->getUser()){
            return $this->redirectToRoute('home');
        }

        if ($request->get('email')){
            $user = $this->entityManager
                ->getRepository(User::class)
                ->findOneByEmail($request->get('email'));

            if($user){
                // Etape 1: enregistrer en base la demande de reset_password avec user, token, createdAt
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new \DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                // Etape 2: Envoyer un email à l'utilisateur avec un lien lui permettant de reinitialiser le mot de passe
                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getFirstname()."<br/>Vous avez demandé à réinitialiser votre mot de passe sur le site de 'Sandrine Picod : Cabinet de Bien-Être'.<br/><br/>";
                $content .= "Ce lien restera actif durant les 3 prochaines heures afin de <a href='.$url.'> mettre à jour votre mot de passe</a>.";

                $mail = new Mail();
                $mail->send(
                    $user->getEmail(), 
                    $user->getFirstname().''.$user->getLastname(), 'Réinitialisez votre mot de passe', $content);
                    //param 1 to_name, param 2 subject, param 3 contenu
                    $this->addFlash('notice', 'Vous allez recevoir dans quelques secondes un mail avec la procédure pour réinitialiser votre mot de passe.');
                }else{
                    $this->addFlash('notice', 'Cette adresse e-mail n\'existe pas.');
                }
        };
        
        return $this->render('reset_password/index.html.twig', [
            'logos' => $logos->findAll(),
        ]);
    }

    #[Route('/modifier-mon-mot-de-passe/{token}', name: 'update_password')]
    public function update(Request $request, $token, UserPasswordHasherInterface $encoder, LogoRepository $logos): Response
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);
        
        if(!$reset_password){
            return $this->redirectToRoute('reset_password');
        }
        //Verifier si le createdAt = now - 3h
        $now = new \DateTime();
        if ($now > $reset_password->getCreatedAt()->modify('+ 3 hour')){
            //Modifier mon mot de passe 
            $this->addFlash('notice', 'Votre demande de renouvellement mot de passe a expiré. Merci de la renouveller.');
            return $this->redirectToRoute('reset_password');
        }

        // Rendre une vue avec mot de passe et confrimez votre mot de passe
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_pwd = $form->get('new_password')->getData();
            
            //Encodez des mots de passe
            $password = $encoder->hashPassword($reset_password->getUser(),$new_pwd);
            $reset_password->getUser()->setPassword($password);
            
            //Flush en BDD
            $this->entityManager->flush();
                
            //Redirection de l'utilisateur vers la page de connexion
            $this->addFlash('notice','Votre mot de passe a bien été mis à jour');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView(),
            'logos' => $logos->findAll(),
        ]); 
    }
}
