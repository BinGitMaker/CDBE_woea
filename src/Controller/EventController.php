<?php

namespace App\Controller;


use App\Repository\LogoRepository;
use App\Repository\AboutRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    #[Route('/agenda', name: 'event')]
    public function index(LogoRepository $logos, AboutRepository $abouts, EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'logos' => $logos->findAll(),
            'abouts' => $abouts->findAll(),
            'events' => $eventRepository->findAll(),
        ]);
    }
}
