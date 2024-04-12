<?php
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Step;
use App\Entity\Task;
use Faker\Generator;
use App\Entity\Board;
use App\Entity\TaskHistory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaskFixtures extends Fixture
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

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 5; $i++) {
            $board = new Board();
            $board->setTitle($this->faker->sentence(3))
                  ->setStatus($this->faker->randomElement(['todo', 'in_progress', 'done']))
                  ->setCreatedAt($this->faker->dateTimeThisMonth())
                  ->setUpdatedAt($this->faker->dateTimeThisMonth());

            $manager->persist($board);

            $step = new Step();
            $step->setTitle($this->faker->sentence())
                 ->setPosition($i)
                 ->setStatus($this->faker->randomElement(['todo', 'in_progress', 'done']))
                 ->setCreatedAt($this->faker->dateTimeThisMonth())
                 ->setUpdatedAt($this->faker->dateTimeThisMonth());

            $manager->persist($step);

            

            for ($j = 0; $j < 5; $j++) {
                $task = new Task();
                $task->setTitle($this->faker->sentence())
                     ->setStatus($this->faker->randomElement(['todo', 'in_progress', 'done']))
                     ->setCreatedAt($this->faker->dateTimeThisMonth())
                     ->setUpdatedAt($this->faker->dateTimeThisMonth())
                     ->setStep($step);


                $manager->persist($task);

                $history = new TaskHistory();
                $history->setEvent($this->faker->sentence())
                        ->setEventDate($this->faker->dateTimeThisMonth())
                        ->setCreatedAt($this->faker->dateTimeThisMonth())
                        ->setTask($task);

                $manager->persist($history);
            }
        }

        $manager->flush();
    }
}
