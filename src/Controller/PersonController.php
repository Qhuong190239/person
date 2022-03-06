<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    #[Route('/person', name: 'person_index')]
    public function personIndex(){
        $person = $this->getDoctrine()->getRepository(Person::class)->findAll();
        return $this->render("person/index.html.twig",
    [
        'person' => $person
    ]);

    }

    #[Route('/person/detail/{id}', name: 'person_detail')]
    public function personDetail ($id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        return $this->render("person/detail.html.twig",
        [
            'person' =>$person
        ]);
    }

    #[Route('/person/delete/{id}', name:'person_delete')]
    public function personDelete ($id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($person);
        $manager->flush();
        return $this->redirectToRoute("person_index");
    }
}
