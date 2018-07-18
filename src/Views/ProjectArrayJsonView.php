<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\ProjectArray;

class ProjectArrayJsonView implements JsonSerializable
{

    /**
     * @var ProjectArray
     */
    private $projects;

    public function __construct(ProjectArray $projects)
    {
        $this->projects = $projects;
    }

    public function jsonSerialize()
    {
        $json = [];
        foreach ($this->projects as $project) {
            $json[] = new ProjectJsonView($project);
        }
        return $json;
    }
}