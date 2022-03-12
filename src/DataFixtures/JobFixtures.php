<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $job = new Job;
            $job->setName("Job $i");
            $job->setCompany("FPT");
            $job->setPosition("Manager");
            $job->setSalary(floatval(rand(2000, 4000)));
            $manager->persist($job);
        }
        $manager->flush();
    }
}
