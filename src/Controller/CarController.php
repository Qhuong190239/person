<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/car', name : 'car_index')]
    public function carIndex () {
        $car = $this->getDoctrine()->getRepository(Car::class)->findAll();
        return $this->render("car/index.html.twig",
        [
            'car' => $car
        ]);
    }

    #[Route('/car/detail/{id}', name : 'car_detail')]
    public function carDetail ($id) {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        if ($car != null) {
            return $this->render("car/detail.html.twig",
            [
                'car' => $car
            ]);
        } else {
            return $this->redirectToRoute("car_index");
        }
        
    }

    #[Route('/car/delete/{id}', name : 'car_delete')]
    public function carDelete ($id) {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        if ($car != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($car);
            $manager->flush($car);
        }
        return $this->redirectToRoute("car_index");
    }

    #[Route('/car/add', name : 'car_add')]
    public function carAdd (Request $request) {
        $car = new Car;
        $carForm = $this->createForm(CarType::class,$car);
        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush(); 
            return $this->redirectToRoute("car_index");
        } 
        return $this->renderForm("car/add.html.twig",
        [
            'carForm' => $carForm
        ]);
    }

    #[Route('/car/edit/{id}', name: 'car_edit')]
    public function carEdit (Request $request, $id) {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);;
        $carForm = $this->createForm(CarType::class,$car);
        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush(); 
            return $this->redirectToRoute("car_index");
        } 
        return $this->renderForm("car/edit.html.twig",
        [
            'carForm' => $carForm
        ]);
    }
}