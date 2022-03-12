<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $car = new Car;
            $car->setName("Car $i");
            $car->setModel(rand(2015,2021));
            $car->setBrand("Audi");
            $car->setPrice(floatval(rand(30000,50000)));
            $manager->persist($car);
        }

        $manager->flush();
    }
}