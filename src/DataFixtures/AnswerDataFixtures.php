<?php

namespace App\DataFixtures;

use App\Enum\Channel;
use App\Entity\Answer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnswerDataFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function getDependencies()
    {
        return [
            QuestionDataFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $question1 = $this->getReference(QuestionDataFixtures::QUESTION_1);
        $ans1 = new Answer();
        $ans1->setBody("ceci est la réponse à la question 1");
        $ans1->setChannel(Channel::faq);
        $ans1->setQuestion($question1);
        $manager->persist($ans1);
        
        $question2 = $this->getReference(QuestionDataFixtures::QUESTION_2);
        $ans2 = new Answer();
        $ans2->setBody("ceci est la réponse à la question 2");
        $ans2->setChannel(Channel::bot);
        $ans2->setQuestion($question2);
        $manager->persist($ans2);
        
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group2'];
    }
}
