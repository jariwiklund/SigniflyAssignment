<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\ProjectTeam;

class ProjectTeamJsonView implements JsonSerializable
{

    /**
     * @var ProjectTeam
     */
    private $project_team;

    public function __construct(ProjectTeam $project_team)
    {
        $this->project_team = $project_team;
    }


    public function jsonSerialize()
    {
        return [
            'team_members' => new SigniflyerArrayJsonView( $this->project_team->getTeamMembers() ),
            'total_competence_coverage' => $this->project_team->getTotalCompetenceCoverage()
        ];
    }
}