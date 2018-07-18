<?php
namespace SigniflyAssignment\Models;

use Ramsey\Uuid\Uuid;

class Project
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CompetenceArray
     */
    private $needed_competences;

    /**
     * Project constructor.
     * @param Uuid $id
     * @param string $name
     * @param SkillArray $required_skills
     */
    public function __construct(Uuid $id, string $name, CompetenceArray $needed_competences)
    {
        $this->id = $id;
        $this->name = $name;
        $this->needed_competences = $needed_competences;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return CompetenceArray
     */
    public function getNeededCompetences(): CompetenceArray
    {
        return $this->needed_competences;
    }

}