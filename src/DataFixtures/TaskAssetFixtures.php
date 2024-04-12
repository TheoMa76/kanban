<?php

namespace App\DataFixtures;

use App\Entity\TaskAsset;
use App\Entity\TaskAssetType;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaskAssetFixtures extends Fixture
{

    /**
     * Seeder 
     *
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 10; $i++) {
            $taskAssetType = new TaskAssetType();
            $taskAssetType->setType($this->faker->word);
            $taskAssetType->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
            $taskAssetType->setUpdatedAt($this->faker->dateTimeBetween($taskAssetType->getCreatedAt(), 'now'));
            $manager->persist($taskAssetType);

            for ($j = 0; $j < 5; $j++) {
                $taskAsset = new TaskAsset();
                $taskAsset->setContent($this->faker->realText(30));
                $taskAsset->setTaskAssetType($taskAssetType);
                $taskAsset->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
                $taskAsset->setUpdatedAt($this->faker->dateTimeBetween($taskAsset->getCreatedAt(), 'now'));
                $manager->persist($taskAsset);
            }
        }

        $manager->flush();
    }
}
