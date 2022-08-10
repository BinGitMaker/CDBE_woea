<?php

namespace App\Controller\Admin;

use App\Entity\ContactMe;
use App\Form\ContactMeType;
use App\Repository\ContactMeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contactez-moi', name: 'admin_contactMe_')]
class ContactMeCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ContactMeRepository $contactMeRepository): Response
    {
        return $this->render('admin/contactMe/index.html.twig', [
            'contactMes' => $contactMeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactMeRepository $contactMeRepository): Response
    {
        $contactMe = new ContactMe();
        $form = $this->createForm(ContactMeType::class, $contactMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactMeRepository->add($contactMe, true);

            return $this->redirectToRoute('admin_contactMe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/contactMe/new.html.twig', [
            'contactMe' => $contactMe,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactMe $contactMe, ContactMeRepository $contactMeRepository): Response
    {
        $form = $this->createForm(ContactMeType::class, $contactMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactMeRepository->add($contactMe, true);

            return $this->redirectToRoute('admin_contactMe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/contactMe/edit.html.twig', [
            'contactMe' => $contactMe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, ContactMe $contactMe, ContactMeRepository $contactMeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactMe->getId(), $request->request->get('_token'))) {
            $contactMeRepository->remove($contactMe, true);
        }

        return $this->redirectToRoute('admin_contactMe_index', [], Response::HTTP_SEE_OTHER);
    }
}
