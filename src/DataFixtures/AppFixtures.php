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
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $step = new Step();
            $step->setTitle($faker->sentence())
                ->setPosition($i)
                ->setCreatedAt($faker->dateTimeThisMonth())
                ->setUpdatedAt($faker->dateTimeThisMonth());
            $manager->persist($step);

            $board = new Board();
            $board->setTitle($faker->sentence(3))
                ->setCreatedAt($faker->dateTimeThisMonth())
                ->setUpdatedAt($faker->dateTimeThisMonth())
                ->addStep($step);
            $manager->persist($board);

            for ($j = 0; $j < 5; $j++) {
                $task = new Task();
                $task->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph())
                    ->setPriority($faker->randomElement(['low', 'medium', 'high']))
                    ->setStatus($faker->randomElement(['1', '2', '3']))
                    ->setCreatedAt($faker->dateTimeThisMonth())
                    ->setUpdatedAt($faker->dateTimeThisMonth())
                    ->setStep($step);
                $manager->persist($task);

                $history = new History();
                $history->setEvent($faker->sentence())
                    ->setEventDate($faker->dateTimeThisMonth())
                    ->setDetails($faker->sentence())
                    ->setTask($task);
                $manager->persist($history);
            }
        }

        $manager->flush();
    }
}