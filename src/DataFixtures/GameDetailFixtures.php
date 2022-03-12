<?php

namespace App\DataFixtures;

use App\Entity\GameDetail;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GameDetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $gameDetail = new GameDetail;
            $gameDetail->setPrice(999.99);
            $gameDetail->setBirthday(\DateTime::createFromFormat('Y-m-d', '2000-03-23'));
            $gameDetail->setPlatform('Mac');
            $manager->persist($gameDetail);
        }

        $manager->flush();
    }
}
