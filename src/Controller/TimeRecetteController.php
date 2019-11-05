<?php

namespace App\Controller;

use App\Entity\TimeRecette;
use App\Form\TimeRecetteType;
use App\Repository\TimeRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/time/recette")
 */
class TimeRecetteController extends AbstractController
{
    /**
     * @Route("/", name="time_recette_index", methods={"GET"})
     */
    public function index(TimeRecetteRepository $timeRecetteRepository): Response
    {
        return $this->render('time_recette/index.html.twig', [
            'time_recettes' => $timeRecetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="time_recette_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timeRecette = new TimeRecette();
        $form = $this->createForm(TimeRecetteType::class, $timeRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timeRecette);
            $entityManager->flush();

            return $this->redirectToRoute('time_recette_index');
        }

        return $this->render('time_recette/new.html.twig', [
            'time_recette' => $timeRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="time_recette_show", methods={"GET"})
     */
    public function show(TimeRecette $timeRecette): Response
    {
        return $this->render('time_recette/show.html.twig', [
            'time_recette' => $timeRecette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="time_recette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TimeRecette $timeRecette): Response
    {
        $form = $this->createForm(TimeRecetteType::class, $timeRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('time_recette_index');
        }

        return $this->render('time_recette/edit.html.twig', [
            'time_recette' => $timeRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="time_recette_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TimeRecette $timeRecette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeRecette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timeRecette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('time_recette_index');
    }
}
