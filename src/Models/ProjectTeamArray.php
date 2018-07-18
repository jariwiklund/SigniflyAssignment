<?php

namespace SigniflyAssignment\Models;


class ProjectTeamArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return ProjectTeam::class;
    }
}