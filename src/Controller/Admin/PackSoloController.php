<?php

namespace App\Controller\Admin;

use App\Entity\PackCatSolo;
use App\Form\PackCatSoloType;
use App\Repository\PackCatSoloRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/forfait/solo', name: 'admin_pack_solo_')]
class PackSoloController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PackCatSoloRepository $packCatSoloRepository): Response
    {
        return $this->render('admin/pack/_solo_index.html.twig', [
            'packCatSolos' => $packCatSoloRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, PackCatSoloRepository $packCatSoloRepository): Response
    {
        $packCatSolo = new PackCatSolo();
        $form = $this->createForm(PackCatSoloType::class, $packCatSolo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packCatSoloRepository->add($packCatSolo, true);

            return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/_solo_new.html.twig', [
            'packCatSolos' => $packCatSolo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PackCatSolo $packCatSolo, PackCatSoloRepository $packCatSoloRepository): Response
    {
        $form = $this->createForm(PackCatSoloType::class, $packCatSolo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packCatSoloRepository->add($packCatSolo, true);

            return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/_solo_edit.html.twig', [
            'packCatSolo' => $packCatSolo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, PackCatSolo $packCatSolo, PackCatSoloRepository $packCatSoloRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packCatSolo->getId(), $request->request->get('_token'))) {
            $packCatSoloRepository->remove($packCatSolo, true);
        }

        return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
    }
}
