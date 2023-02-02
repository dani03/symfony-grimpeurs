<?php

namespace App\DataFixtures;

use App\Entity\Jpo;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
class JpoFixtures extends  Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

       $jpo = new Jpo();
       $jpo->setLieu('paris');
       $jpo->setTitle("journee 1");
       $jpo->setPlaces(5);
       $jpo->setUser($this->getReference('user_1'));
       $jpo->setCreatedAt(new \DateTimeImmutable());
       $jpo->setUpdatedAt(new \DateTimeImmutable());
       $jpo->addUser($this->getReference('user_1'));

       $manager->persist($jpo);


        $jpo2 = new Jpo();
        $jpo2->setLieu('Marseille');
        $jpo2->setPlaces(5);
        $jpo2->setTitle("journee 2");
        $jpo2->setCreatedAt(new \DateTimeImmutable());
        $jpo2->setUpdatedAt(new \DateTimeImmutable());

        $jpo2->setUser($this->getReference('user_2'));
        $jpo2->addUser($this->getReference('user_2'));

        $manager->persist($jpo2);

        $manager->flush();
    }

    public function getOrder()
    {
        return [
            User::class,
        ];
    }
}