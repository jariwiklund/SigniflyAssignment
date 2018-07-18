<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\Project;

class ProjectJsonView implements JsonSerializable
{
    /**
     * @var Project
     */
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }
    public function jsonSerialize()
    {
        return [
            'id' => $this->project->getId()->toString(),
            'name' => $this->project->getName()
        ];
    }
}