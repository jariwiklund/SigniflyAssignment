<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\Skill;

class SkillJsonView implements JsonSerializable
{
    /**
     * @var Skill
     */
    private $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->skill->getId(),
            'name' => $this->skill->getName()
        ];
    }
}