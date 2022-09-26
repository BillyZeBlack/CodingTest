<?php

namespace App\DataFixtures;

use App\Enum\Status;
use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuestionDataFixtures extends Fixture
{

    public const QUESTION_1 = "QUESTION_1";
    public const QUESTION_2 = "QUESTION_2";

    public function load(ObjectManager $manager): void
    {
        $q1 = new Question();
        $q1->setTitle("Question 1");
        $q1->setPromoted(false);
        $q1->setStatus(Status::published);
        $manager->persist($q1);
        

        $q2 = new Question();
        $q2->setTitle("Question 2");
        $q2->setPromoted(true);
        $q2->setStatus(Status::draft);

        $manager->flush();

        $this->addReference(self::QUESTION_1, $q1);
        $this->addReference(self::QUESTION_2, $q2);
    }
}
