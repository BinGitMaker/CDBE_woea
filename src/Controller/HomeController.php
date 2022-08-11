<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use App\Repository\AboutRepository;
use App\Repository\ContactMeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AboutRepository $abouts, ContactMeRepository $contactMes, LogoRepository $logos): Response
    {

        return $this->render('home/index.html.twig',[
            'abouts' => $abouts->findAll(),
            'contactMes' => $contactMes->findAll(),
            'logos' => $logos->findAll(),
        ]);
    }
}
