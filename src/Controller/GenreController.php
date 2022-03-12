<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    #[Route('/genre', name : 'genre_index')]
    public function genreIndex () {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        return $this->render("genre/index.html.twig",
        [
            'genre' => $genre
        ]);
    }

    #[Route('/genre/detail/{id}', name : 'genre_detail')]
    public function genreDetail ($id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        if ($genre != null) {
            return $this->render("genre/detail.html.twig",
            [
                'genre' => $genre
            ]);
        } else {
            return $this->redirectToRoute("genre_index");
        }
        
    }

    #[Route('/genre/delete/{id}', name : 'genre_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function genreDelete ($id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        if ($genre != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($genre);
            $manager->flush($genre);
        }
        return $this->redirectToRoute("genre_index");
    }

    #[Route('/genre/add', name : 'genre_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function genreAdd (Request $request) {
        $genre = new Genre;
        $genreForm = $this->createForm(GenreType::class,$genre);
        $genreForm->handleRequest($request);
        if ($genreForm->isSubmitted() && $genreForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($genre);
            $manager->flush(); 
            return $this->redirectToRoute("genre_index");
        } 
        return $this->renderForm("genre/add.html.twig",
        [
            'genreForm' => $genreForm
        ]);
    }

    #[Route('/genre/edit/{id}', name: 'genre_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function genreEdit (Request $request, $id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);;
        $genreForm = $this->createForm(GenreType::class,$genre);
        $genreForm->handleRequest($request);
        if ($genreForm->isSubmitted() && $genreForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($genre);
            $manager->flush(); 
            return $this->redirectToRoute("genre_index");
        } 
        return $this->renderForm("genre/edit.html.twig",
        [
            'genreForm' => $genreForm
        ]);
    }
}