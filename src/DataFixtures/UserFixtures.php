<?php

namespace App\DataFixtures;

use App\Entity\Jpo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class JpoFixtures extends  Fixture
{
    public function load(ObjectManager $manager): void
    {
       $jpo = new Jpo();
       $jpo->setLieu('paris');
       $jpo->setPlaces(5);
       $jpo->setCreatedAt(new \DateTimeImmutable());
       $jpo->setUpdatedAt(new \DateTimeImmutable());

       $manager->persist($jpo);


        $jpo2 = new Jpo();
        $jpo2->setLieu('douala');
        $jpo2->setPlaces(5);
        $jpo2->setCreatedAt(new \DateTimeImmutable());
        $jpo2->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($jpo2);

        $manager->flush();
    }
}