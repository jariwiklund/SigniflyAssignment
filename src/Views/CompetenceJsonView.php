<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\Competence;

class CompetenceJsonView implements JsonSerializable
{
    /**
     * @var Competence
     */
    private $competence;

    public function __construct(Competence $competence)
    {
        $this->competence = $competence;
    }

    public function jsonSerialize()
    {
        return [
            'competence_level' => (string) $this->competence->getCompetenceLevel(),
            'skill' => new SkillJsonView($this->competence->getSkill())
        ];
    }
}