<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\Etablissement1Type;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etablissement')]
class EtablissementController extends AbstractController
{
    #[Route('/', name: 'app_etablissement_index', methods: ['GET'])]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtablissementRepository $etablissementRepository): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(Etablissement1Type::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etablissementRepository->save($etablissement, true);

            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etablissement/new.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etablissement_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EtablissementRepository $etablissementRepository): Response
    {
        $form = $this->createForm(Etablissement1Type::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etablissementRepository->save($etablissement, true);

            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etablissement/edit.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablissement, EtablissementRepository $etablissementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablissement->getId(), $request->request->get('_token'))) {
            $etablissementRepository->remove($etablissement, true);
        }

        return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
