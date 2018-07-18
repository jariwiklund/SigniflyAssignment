<?php

namespace SigniflyAssignment\Models;


class Competence
{
    /**
     * @var Skill
     */
    private $skill;

    /**
     * @var CompetenceLevel
     */
    private $competence_level;

    /**
     * Competence constructor.
     * @param Skill $skill
     * @param CompetenceLevel $competence_level
     */
    public function __construct(Skill $skill, CompetenceLevel $competence_level)
    {
        $this->skill = $skill;
        $this->competence_level = $competence_level;
    }

    /**
     * @return Skill
     */
    public function getSkill(): Skill
    {
        return $this->skill;
    }

    /**
     * @return CompetenceLevel
     */
    public function getCompetenceLevel(): CompetenceLevel
    {
        return $this->competence_level;
    }
}