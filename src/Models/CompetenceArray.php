<?php

namespace SigniflyAssignment\Models;


class CompetenceArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return Competence::class;
    }
}