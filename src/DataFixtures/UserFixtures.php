<?php

namespace App\DataFixtures;

use App\Entity\Jpo;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends  Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {

    }

    public function load(ObjectManager $manager): void
    {


       $user1 = new User();
       $user1->setEmail("user1@gmail.com");
       $user1->setFirstname("passy");
       $user1->setLastname("same");
       $user1->setPoints(0);
       $user1->setPassword('$2y$13$wKu7lN0ngYEE56BviAUtM.FzWUAicewxaXQY.VBd4QdE2Id56CT/2');
       $user1->setCreatedAt(new \DateTimeImmutable());
       $user1->setUpdatedAt(new \DateTimeImmutable());

       $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("user2@gmail.com");
        $user2->setFirstname("user");
        $user2->setRoles(['ROLE_GOLD']);
        $user2->setLastname("jean paulos");
        $user2->setPoints(0);
        $user2->setPassword('$2y$13$wKu7lN0ngYEE56BviAUtM.FzWUAicewxaXQY.VBd4QdE2Id56CT/2');

        $user2->setCreatedAt(new \DateTimeImmutable());
        $user2->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user_1', $user1);
        $this->addReference('user_2', $user2);
    }
}