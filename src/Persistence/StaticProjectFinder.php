<?php

namespace SigniflyAssignment\Persistence;


use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Models\Competence;
use SigniflyAssignment\Models\CompetenceArray;
use SigniflyAssignment\Models\CompetenceLevel;
use SigniflyAssignment\Models\Project;
use SigniflyAssignment\Models\ProjectArray;
use SigniflyAssignment\Models\Skill;
use Traversable;

class StaticProjectFinder implements FinderInterface
{

    public function find(CriteriaInterface $criteria): Traversable
    {
        return ProjectArray::fromArray([
            $this->get(new NullCriteria())
        ]);
    }

    public function get(CriteriaInterface $criteria)
    {
        $laravelSkill = new Skill(Uuid::fromString('b7ea05bc-da69-43a3-a6ed-f76adfa7fed6'), 'Laravel');
        $vueSkill = new Skill(Uuid::fromString('aac85cd1-47c0-45c7-ba0d-69535910011a'), 'Vue');
        $productManagementSkill = new Skill(Uuid::fromString('1e99036f-04d5-47bf-a69a-491982bc4f07'), 'Product management');

        return new Project(
            Uuid::uuid4(),
            'Test project',
            CompetenceArray::fromArray([
                new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
                new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
                new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );
    }
}