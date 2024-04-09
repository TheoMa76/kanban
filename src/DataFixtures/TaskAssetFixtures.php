<?php

namespace App\DataFixtures;

use App\Entity\TaskAsset;
use App\Entity\TaskAssetType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TaskAssetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $taskAssetType = new TaskAssetType();
            $taskAssetType->setType($faker->word);
            $manager->persist($taskAssetType);


            for ($j = 0; $j < 5; $j++) {
                $taskAsset = new TaskAsset();
                $taskAsset->setContent($faker->text(1500));
                $taskAsset->setTaskAssetType($taskAssetType);
                $manager->persist($taskAsset);
            }
        }

        $manager->flush();
    }
}
