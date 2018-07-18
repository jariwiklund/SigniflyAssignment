<?php

namespace SigniflyAssignment\Models;


use SigniflyAssignment\Service\CompetenceCalculator;

class ProjectTeam
{

    /**
     * @var Project
     */
    private $project;

    /**
     * @var SigniflyerArray
     */
    private $team_members;

    /**
     * @var float
     */
    private $total_competence_coverage = null;

    /**
     * ProjectTeam constructor.
     * @param Project $project
     * @param SigniflyerArray $team_members
     */
    public function __construct(Project $project, SigniflyerArray $team_members)
    {
        $this->project = $project;
        $this->team_members = $team_members;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @return float
     */
    public function getTotalCompetenceCoverage(): float
    {
        if($this->total_competence_coverage === null){
            $competence_calculator = new CompetenceCalculator($this->project->getNeededCompetences());
            $this->total_competence_coverage = $competence_calculator->calculateTeamCompetenceCoverage($this->team_members);
        }

        return $this->total_competence_coverage;
    }

    public function addTeamMember(Signiflyer $team_member)
    {
        $this->team_members->add($team_member);
        $this->total_competence_coverage = null;
    }

    public function getTeamMembers(): SigniflyerArray
    {
        return clone $this->team_members;
    }

}