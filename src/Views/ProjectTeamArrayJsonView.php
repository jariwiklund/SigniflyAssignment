<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\ProjectTeam;
use SigniflyAssignment\Models\ProjectTeamArray;

class ProjectTeamArrayJsonView implements JsonSerializable
{
    /**
     * @var ProjectTeamArray
     */
    private $project_team_array;

    public function __construct(ProjectTeamArray $project_team_array)
    {
        $this->project_team_array = $project_team_array;
    }


    public function jsonSerialize()
    {
        $json = [];
        /** @var ProjectTeam $project_team */
        foreach ($this->project_team_array as $project_team){
            $json[] = new ProjectTeamJsonView($project_team);
        }
        return $json;
    }
}