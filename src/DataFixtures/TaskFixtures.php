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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TaskFixtures extends Fixture
{

    /**
     * Seeder 
     *
     * @var Generator
     */
    private Generator $faker;

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker = Factory::create("fr_FR");
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $board = new Board();
            $board->setTitle($faker->sentence(3))
                  ->setStatus($faker->randomElement(['todo', 'in_progress', 'done']))
                  ->setCreatedAt($faker->dateTimeThisMonth())
                  ->setUpdatedAt($faker->dateTimeThisMonth());

            $manager->persist($board);

            $step = new Step();
            $step->setTitle($faker->sentence())
                 ->setPosition($i)
                 ->setStatus($faker->randomElement(['todo', 'in_progress', 'done']))
                 ->setCreatedAt($faker->dateTimeThisMonth())
                 ->setUpdatedAt($faker->dateTimeThisMonth());

            $manager->persist($step);

            

            for ($j = 0; $j < 5; $j++) {
                $task = new Task();
                $task->setTitle($faker->sentence())
                     ->setStatus($faker->randomElement(['todo', 'in_progress', 'done']))
                     ->setCreatedAt($faker->dateTimeThisMonth())
                     ->setUpdatedAt($faker->dateTimeThisMonth())
                     ->setStep($step);


                $manager->persist($task);

                $history = new TaskHistory();
                $history->setEvent($faker->sentence())
                        ->setEventDate($faker->dateTimeThisMonth())
                        ->setCreatedAt($faker->dateTimeThisMonth())
                        ->setTask($task);

                $manager->persist($history);
            }
        }

        $manager->flush();
    }
}