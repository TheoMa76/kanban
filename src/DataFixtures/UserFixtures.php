<?php

namespace App\DataFixtures;

use App\Entity\Identity;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
     /**
     * Seeder 
     *
     * @var Generator
     */
    private Generator $faker;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct( UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create("fr_FR");
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        $identityTable = [];
        for($i = 0; $i < 10; $i++){
            $identity = new Identity();
            $identity->setName($this->faker->name);
            $identity->setFirstName($this->faker->firstName);
            $identity->setBirthDate($this->faker->dateTimeBetween('-50 years', '-18 years'));
            $identity->setEmail($this->faker->email);
            $identity->setPhone($this->faker->phoneNumber);
            $identity->setStatus('on');
            $identity->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
            $identity->setUpdatedAt($this->faker->dateTimeBetween($identity->getCreatedAt(), 'now'));
            $identityTable[] = $identity;
            $manager->persist($identity);
        }
        $userTable = [];
        
        for ($i = 0; $i < 10; $i++) {
            $password = $this->faker->password;
            $index = $this->faker->numberBetween(0, count($identityTable) - 1);
            $user = new User();
            $user->setUuid($this->faker->uuid);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setUsername($this->faker->username . "@" . $password );
            $user->setRoles($this->faker->randomElement([['ROLE_USER'], ['ROLE_ADMIN'], ['ROLE_USER', 'ROLE_ADMIN']]));
            $user->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
            $user->setUpdatedAt($this->faker->dateTimeBetween($user->getCreatedAt(), 'now'));
            $user->setIdentity($identityTable[$index]);
            array_splice($identityTable, $index,1);
            $user->setStatus('on');
            $manager->persist($user);

            $userTable[] = $user;
        }

        $teamTable = [];
        for ($i = 0; $i < 10; $i++) {
            $index = $this->faker->numberBetween(0, count($userTable) - 1);
            $team = new Team();
            $team->setName($this->faker->name);
            $team->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
            $team->setUpdatedAt($this->faker->dateTimeBetween($team->getCreatedAt(), 'now'));
            $team->addUser($userTable[$index]);
            array_splice($userTable, $index,1);
            $team->setStatus('on');
           
            $manager->persist($team);
            $teamTable[] = $team;
        }

        $manager->flush();
    }
}
