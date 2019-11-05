<?php

namespace App\Controller;

use App\Entity\TypeRecette;
use App\Form\TypeRecetteType;
use App\Repository\TypeRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/recette")
 */
class TypeRecetteController extends AbstractController
{
    /**
     * @Route("/", name="type_recette_index", methods={"GET"})
     */
    public function index(TypeRecetteRepository $typeRecetteRepository): Response
    {
        return $this->render('type_recette/index.html.twig', [
            'type_recettes' => $typeRecetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_recette_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeRecette = new TypeRecette();
        $form = $this->createForm(TypeRecetteType::class, $typeRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeRecette);
            $entityManager->flush();

            return $this->redirectToRoute('type_recette_index');
        }

        return $this->render('type_recette/new.html.twig', [
            'type_recette' => $typeRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_recette_show", methods={"GET"})
     */
    public function show(TypeRecette $typeRecette): Response
    {
        return $this->render('type_recette/show.html.twig', [
            'type_recette' => $typeRecette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_recette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeRecette $typeRecette): Response
    {
        $form = $this->createForm(TypeRecetteType::class, $typeRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_recette_index');
        }

        return $this->render('type_recette/edit.html.twig', [
            'type_recette' => $typeRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_recette_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeRecette $typeRecette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeRecette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeRecette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_recette_index');
    }
}
