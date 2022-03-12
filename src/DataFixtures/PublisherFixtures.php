<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class PublisherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $publisher = new Publisher;
            $publisher->setName("Publisher $i");
            $publisher->setImage("https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Rockstar_Games_Logo.svg/800px-Rockstar_Games_Logo.svg.png");
            $publisher->setHeadquarters("USA");
            $publisher->setYear(\DateTime::createFromFormat('Y/m/d','2000/05/10'));
            $publisher->setEmail("Email$i@gmail.com");
            $manager->persist($publisher);
        }
        $manager->flush();
    }
}
