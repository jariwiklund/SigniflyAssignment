<?php

namespace SigniflyAssignment\Persistence;


use GuzzleHttp\Psr7\Uri;
use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Models\Competence;
use SigniflyAssignment\Models\CompetenceArray;
use SigniflyAssignment\Models\CompetenceLevel;
use SigniflyAssignment\Models\Signiflyer;
use SigniflyAssignment\Models\SigniflyerArray;
use SigniflyAssignment\Models\Skill;
use Traversable;

class StaticSigniflyFinder implements FinderInterface
{

    public function find(CriteriaInterface $criteria): Traversable
    {

        $laravelSkill = new Skill(Uuid::fromString('b7ea05bc-da69-43a3-a6ed-f76adfa7fed6'), 'Laravel');
        $vueSkill = new Skill(Uuid::fromString('aac85cd1-47c0-45c7-ba0d-69535910011a'), 'Vue');
        $productManagementSkill = new Skill(Uuid::fromString('1e99036f-04d5-47bf-a69a-491982bc4f07'), 'Product management');
        $phpSkill = new Skill(Uuid::fromString('b492630b-eea9-42b7-aab9-9eb113f02e06'), 'Php');
        $uxDesignSkill = new Skill(Uuid::fromString('2a9e6730-67a3-4eba-a9b1-80e7f2006919'), 'UX Design');

        return SigniflyerArray::fromArray([
            new Signiflyer(
                Uuid::uuid4(),
                'Jari Wiklund',
                'jari.wiklund@gmail.com',
                '+45 61 66 93 43',
                'Senior PHP developer',
                new Uri('https://scontent-arn2-1.xx.fbcdn.net/v/t31.0-1/c218.1.455.455/s320x320/52917_478793989024_6578172_o.jpg?_nc_cat=0&oh=9f528cbd022190074d8c21ca82ea83b9&oe=5BDF4A44'),
                CompetenceArray::fromArray([
                    new Competence($phpSkill, new CompetenceLevel(CompetenceLevel::GURU)),
                    new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                    new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::BASIC))
                ])
            ),
            new Signiflyer(
                Uuid::uuid4(),
                'Michael Valentin',
                'mv@signifly.com',
                '+45 28 19 29 66',
                'MANAGING PARTNER & CONSULTANT',
                new Uri('https://signifly.com/images/mv_1511282520.jpg'),
                CompetenceArray::fromArray([
                    new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                    new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::BASIC)),
                    new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
                ])
            ),
            new Signiflyer(
                Uuid::uuid4(),
                'Alexander Aagaard',
                'aa@signifly.com',
                '+45 28 96 57 69',
                'Developer',
                new Uri('https://signifly.com/images/aa_1492599327.jpg'),
                CompetenceArray::fromArray([
                    new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                    new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
                ])
            )
        ]);
    }

    /**
     * @param CriteriaInterface $criteria
     * @return mixed
     * @throws NothingFoundByCriteriaException
     */
    public function get(CriteriaInterface $criteria)
    {
        $phpSkill = new Skill(Uuid::fromString('b492630b-eea9-42b7-aab9-9eb113f02e06'), 'Php');
        $laravelSkill = new Skill(Uuid::fromString('b7ea05bc-da69-43a3-a6ed-f76adfa7fed6'), 'Laravel');
        $uxDesignSkill = new Skill(Uuid::fromString('2a9e6730-67a3-4eba-a9b1-80e7f2006919'), 'UX Design');

        return new Signiflyer(
            Uuid::uuid4(),
            'Jari Wiklund',
            'jari.wiklund@gmail.com',
            '+45 61 66 93 43',
            'Senior PHP developer',
            new Uri('https://scontent-arn2-1.xx.fbcdn.net/v/t31.0-1/c218.1.455.455/s320x320/52917_478793989024_6578172_o.jpg?_nc_cat=0&oh=9f528cbd022190074d8c21ca82ea83b9&oe=5BDF4A44'),
            CompetenceArray::fromArray([
                new Competence($phpSkill, new CompetenceLevel(CompetenceLevel::GURU)),
                new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::BASIC))
            ])
        );
    }
}