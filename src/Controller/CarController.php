<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car_index')]
    public function carIndex() {
        $car = $this->getDoctrine()->getRepository(Car::class)->findAll();
        return $this->render("/car/index.html.twig",
        [
            'car' => $car
        ]);
    }

    #[Route('/car/detail/{id}', name : 'car_detail')]
    public function carDetail ($id) {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        return $this->render("car/detail.html.twig",
        [
            'car' => $car
        ]);
    }

    #[Route('/car/delete/{id}', name: 'car_delete')]
    public function carDelete ($id) {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($car);
        $manager->flush($car);
        return $this->redirectToRoute("car_index");
    }
}
