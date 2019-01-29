<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ToDo;

Class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $todo = new ToDo();
            $todo->setTitle($i . '.- I have to do something...');
            $todo->setDone(false);

            $manager->persist($todo);
        }

        $manager->flush();
    }
}