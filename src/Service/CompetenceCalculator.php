<?php
namespace SigniflyAssignment\Service;

use SigniflyAssignment\Models\Competence;
use SigniflyAssignment\Models\CompetenceArray;
use SigniflyAssignment\Models\Signiflyer;
use SigniflyAssignment\Models\SigniflyerArray;

class CompetenceCalculator
{
    /**
     * @var CompetenceArray
     */
    private $needed_competences;

    /**
     * CompetenceCalculator constructor.
     * @param CompetenceArray $competences
     */
    public function __construct(CompetenceArray $needed_competences)
    {
        $this->needed_competences= $needed_competences;
    }

    public function calculateTeamCompetenceCoverage(SigniflyerArray $team_members): float
    {

        if($this->needed_competences->count() === 0){
            return 1;
        }

        $coverage = 0;
        /** @var Competence $needed_competence */
        foreach ($this->needed_competences as $needed_competence)
        {
            $coverage += $this->getHigestCompetenceCoverageByTeam($team_members, $needed_competence);
        }

        return $coverage / $this->needed_competences->count();
    }

    private function getHigestCompetenceCoverageByTeam(SigniflyerArray $team_members, Competence $needed_competence)
    {
        $max_competence_coverage = 0;

        /** @var Signiflyer $team_member */
        foreach ($team_members as $team_member)
        {
            $members_competence_coverage = $team_member->getCompetenceCoverage($needed_competence);

            $max_competence_coverage = max(
                $members_competence_coverage,
                $max_competence_coverage
            );
        }

        return $max_competence_coverage;
    }
}