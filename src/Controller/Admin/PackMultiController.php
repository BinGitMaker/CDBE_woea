<?php

namespace App\Controller\Admin;

use App\Entity\PackCatMulti;
use App\Form\PackCatMultiType;
use App\Repository\PackCatMultiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('admin/forfait/multi', name: 'admin_pack_multi_')]
class PackMultiController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PackCatMultiRepository $packCatMultiRepository): Response
    {
        return $this->render('admin/pack/_multi_index.html.twig', [
            'packCatMultis' => $packCatMultiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, PackCatMultiRepository $packCatMultiRepository): Response
    {
        $packCatMulti = new PackCatMulti();
        $form = $this->createForm(PackCatMultiType::class, $packCatMulti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packCatMultiRepository->add($packCatMulti, true);

            return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/_multi_new.html.twig', [
            'packCatMultis' => $packCatMulti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PackCatMulti $packCatMulti, PackCatMultiRepository $packCatMultiRepository): Response
    {
        $form = $this->createForm(PackCatMultiType::class, $packCatMulti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packCatMultiRepository->add($packCatMulti, true);

            return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pack/_multi_edit.html.twig', [
            'packCatMulti' => $packCatMulti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, PackCatMulti $packCatMulti, PackCatMultiRepository $packCatMultiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packCatMulti->getId(), $request->request->get('_token'))) {
            $packCatMultiRepository->remove($packCatMulti, true);
        }

        return $this->redirectToRoute('admin_pack_solo_index', [], Response::HTTP_SEE_OTHER);
    }
}
