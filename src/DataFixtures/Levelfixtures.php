<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Levelfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $level = new Level();
      $level->setName('bronze');
      $manager->persist($level);

      $level2 = new Level();
      $level2->setName('argent');
      $manager->persist($level2);

      $level3 = new Level();
      $level3->setName('or');
      $manager->persist($level3);

      $manager->flush();
    }
}
