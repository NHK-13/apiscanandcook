<?php

namespace App\Controller;

use App\Entity\AllergeneRecette;
use App\Form\AllergeneRecetteType;
use App\Repository\AllergeneRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/allergene/recette")
 */
class AllergeneRecetteController extends AbstractController
{
    /**
     * @Route("/", name="allergene_recette_index", methods={"GET"})
     */
    public function index(AllergeneRecetteRepository $allergeneRecetteRepository): Response
    {
        return $this->render('allergene_recette/index.html.twig', [
            'allergene_recettes' => $allergeneRecetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="allergene_recette_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $allergeneRecette = new AllergeneRecette();
        $form = $this->createForm(AllergeneRecetteType::class, $allergeneRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($allergeneRecette);
            $entityManager->flush();

            return $this->redirectToRoute('allergene_recette_index');
        }

        return $this->render('allergene_recette/new.html.twig', [
            'allergene_recette' => $allergeneRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allergene_recette_show", methods={"GET"})
     */
    public function show(AllergeneRecette $allergeneRecette): Response
    {
        return $this->render('allergene_recette/show.html.twig', [
            'allergene_recette' => $allergeneRecette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="allergene_recette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AllergeneRecette $allergeneRecette): Response
    {
        $form = $this->createForm(AllergeneRecetteType::class, $allergeneRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('allergene_recette_index');
        }

        return $this->render('allergene_recette/edit.html.twig', [
            'allergene_recette' => $allergeneRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="allergene_recette_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AllergeneRecette $allergeneRecette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allergeneRecette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($allergeneRecette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('allergene_recette_index');
    }
}
