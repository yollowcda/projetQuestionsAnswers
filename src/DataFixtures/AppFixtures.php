<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Answer;
use DateTimeImmutable;
use App\Entity\Question;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        QuestionFactory::createMany(20);

        QuestionFactory::new()
            ->unpublished()
            ->many(5)
            ->create()
        ;

        AnswerFactory::createMany(100, function(){
            return [
                'question' => QuestionFactory::random(),
            ];
        });
        $manager->flush();
    }
}
