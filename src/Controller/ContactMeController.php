<?php

namespace App\Controller;

use App\Service\Mail;
use App\Form\SendMsgType;
use App\Repository\LogoRepository;
use App\Repository\AboutRepository;
use App\Repository\ContactMeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactMeController extends AbstractController
{
    #[Route('/contactez-moi', name: 'contactMe')]
    public function index(Request $request, ContactMeRepository $contactMes, AboutRepository $abouts, LogoRepository $logos): Response
    {
       /*  $message = new SendMsg(); */
        
        $form = $this->createForm(SendMsgType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->addFlash('notice', 'Merci d\'avoir contacté Sandrine, elle vous repondra dans les meilleur délais.');

            $mail = new Mail();
            $mailerFname = $form->get('firstname')->getData();
            $mailerLname = $form->get('lastname')->getData();
            $mailerMail = $form->get('mail')->getData();
            $mailerMsg = $form->get('message')->getData();
            $owner = "Sandrine ";
            $website = "Cabinet de Bien-Être : Sandrine";
            $admin = "cabinet.de.bien.etre.sp@gmail.com";

            $content = "Bonjour " . $owner . ",<br/><br/>Tu viens de recevoir une nouvelle demande de contact :<br/>" . 
            "De la part de : " . $mailerFname . " " . $mailerLname . "<br/>Son mail :" . $mailerMail . "<br/>" .                 
            "Son Message : " . $mailerMsg . "<br/>";

            $contentMailer = 'Voici la copie du message que vous venez d\'envoyer :<br/>' . $mailerMsg;

            $mail->send($admin, $owner, 'Nouvelle demande de contact de la part de ' . $mailerFname . " " . $mailerLname, $content);
            $mail->send($mailerMail, $mailerFname . " " . $mailerLname, 'Vous venez d\'envoyer cet email à ' . $website, $contentMailer);
        }

        return $this->render('contactMe/index.html.twig', [
            'contactMes' => $contactMes->findAll(),
            'abouts' => $abouts->findAll(),
            'logos' => $logos->findAll(),
            'form' => $form->createView(),
            
        ]);
    }
}
