<?php

namespace App\DataFixtures;

use App\Entity\Step;
use App\Entity\Board;
use App\Entity\Task;
use App\Entity\History;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
    }
}