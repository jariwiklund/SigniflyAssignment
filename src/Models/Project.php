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
     * @var SkillArray
     */
    private $required_skills;

    /**
     * Project constructor.
     * @param Uuid $id
     * @param string $name
     * @param SkillArray $required_skills
     */
    public function __construct(Uuid $id, string $name, SkillArray $required_skills)
    {
        $this->id = $id;
        $this->name = $name;
        $this->required_skills = $required_skills;
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
     * @return SkillArray
     */
    public function getRequiredSkills(): SkillArray
    {
        return $this->required_skills;
    }

}