<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<20; $i++) {
            $person = new Person();
            $person->setName("Person $i");
            $manager->persist($person);
        }

        $manager->flush();
    }
}
