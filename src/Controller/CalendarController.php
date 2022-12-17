<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'calendar')]
    public function index(LogoRepository $logos): Response
    {
        return $this->render('calendar/index.html.twig', [
            'logos' => $logos->findAll(),
        ]);
    }
}
