<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<10; $i++) {
            $game = new Game();
            $game->setName("Game $i");
            $game->setImage("https://shoptrongnghia.com/wp-content/uploads/2022/02/Elden-Ring.jpg");
            $manager->persist($game);
        }

        $manager->flush();
    }
}
