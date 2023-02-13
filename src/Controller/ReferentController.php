<?php

namespace App\Controller;

use App\Entity\Referent;
use App\Form\Referent1Type;
use App\Repository\ReferentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/referent')]
class ReferentController extends AbstractController
{
    #[Route('/', name: 'app_referent_index', methods: ['GET'])]
    public function index(ReferentRepository $referentRepository): Response
    {
        return $this->render('referent/index.html.twig', [
            'referents' => $referentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_referent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReferentRepository $referentRepository): Response
    {
        $referent = new Referent();
        $form = $this->createForm(Referent1Type::class, $referent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referentRepository->save($referent, true);

            return $this->redirectToRoute('app_referent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referent/new.html.twig', [
            'referent' => $referent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referent_show', methods: ['GET'])]
    public function show(Referent $referent): Response
    {
        return $this->render('referent/show.html.twig', [
            'referent' => $referent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_referent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Referent $referent, ReferentRepository $referentRepository): Response
    {
        $form = $this->createForm(Referent1Type::class, $referent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $referentRepository->save($referent, true);

            return $this->redirectToRoute('app_referent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referent/edit.html.twig', [
            'referent' => $referent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_referent_delete', methods: ['POST'])]
    public function delete(Request $request, Referent $referent, ReferentRepository $referentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referent->getId(), $request->request->get('_token'))) {
            $referentRepository->remove($referent, true);
        }

        return $this->redirectToRoute('app_referent_index', [], Response::HTTP_SEE_OTHER);
    }
}
