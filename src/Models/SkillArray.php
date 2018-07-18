<?php

namespace SigniflyAssignment\Models;


class SkillArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return Skill::class;
    }
}