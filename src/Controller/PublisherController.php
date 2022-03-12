<?php

namespace App\Controller;

use App\Entity\Publisher;
use App\Form\PublisherType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;


class PublisherController extends AbstractController
{
    #[Route('/publisher', name: 'publisher_index')]
    public function publisherIndex() {
            $publisher = $this->getDoctrine()->getRepository(Publisher::class)->findAll();
            return $this->render("/publisher/index.html.twig",
            [
                'publisher' => $publisher
            ]
        );
    }

    #[Route('/publisher/detail/{id}', name: 'publisher_detail')]
    public function publisherDetail ($id) {
        $publisher = $this->getDoctrine()->getRepository(Publisher::class)->find($id);
        if ($publisher != null) {
            return $this->render("/publisher/detail.html.twig",
            [
                'publisher' => $publisher
            ]);            
        } else {
            return $this->redirectToRoute("publisher_detail");
        }

    }

    #[Route('/publisher/delete/{id}', name : 'publisher_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function publisherDelete ($id) {
        $publisher = $this->getDoctrine()->getRepository(Publisher::class)->find($id);
        if ($publisher != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($publisher);
            $manager->flush();            
        }
        return $this->redirectToRoute('publisher_index');
    }

    #[Route('publisher/add', name: 'publisher_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function publisherAdd (Request $request) {
        $publisher = new Publisher;
        $publisherForm = $this->createForm(PublisherType::class,$publisher);
        $publisherForm->handleRequest($request);
        if ($publisherForm->isSubmitted() && $publisherForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($publisher);
            $manager->flush();
            return $this->redirectToRoute("publisher_index");
        }
        return $this->render("publisher/add.html.twig",
    [
        'publisherForm' => $publisherForm->createView()
    ]);
    }

    #[Route('publisher/edit/{id}', name: 'publisher_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function publisherEdit (Request $request, $id) {
        $publisher = $this->getDoctrine()->getRepository(Publisher::class)->find($id);
        $publisherForm = $this->createForm(PublisherType::class,$publisher);
        $publisherForm->handleRequest($request);
        if ($publisherForm->isSubmitted() && $publisherForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($publisher);
            $manager->flush();
            return $this->redirectToRoute("publisher_index");
        }
        return $this->render("publisher/edit.html.twig",
    [
        'publisherForm' => $publisherForm->createView()
    ]);
    }
}
