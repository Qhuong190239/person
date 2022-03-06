<?php

namespace App\DataFixtures;

use App\Entity\PersonDetail;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PersonDetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=20; $i++) {
            $personDetail = new PersonDetail;
            $personDetail->setAddress("Hanoi");
            $personDetail->setMobile("0945762145");
            $personDetail->setNationality("Vietnam");
            $personDetail->setBirthday(\DateTime::createFromFormat('Y-m-d', '1998-03-23'));
            $manager->persist($personDetail);
        }

        $manager->flush();
    }
}
