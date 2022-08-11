<?php

namespace App\Controller;

use App\Entity\SendMsg;
use App\Form\SendMsgType;
use App\Repository\LogoRepository;
use App\Repository\AboutRepository;
use App\Repository\ContactMeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactMeController extends AbstractController
{
    #[Route('/contactez-moi', name: 'contactMe')]
    public function index(ContactMeRepository $contactMes, AboutRepository $abouts, LogoRepository $logos): Response
    {
        $message = new SendMsg();
        
        $form = $this->createForm(SendMsgType::class, $message);

        return $this->render('contactMe/index.html.twig', [
            'contactMes' => $contactMes->findAll(),
            'abouts' => $abouts->findAll(),
            'form' => $form->createView(),
            'logos' => $logos->findAll(),
        ]);
    }
}
