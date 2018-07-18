<?php
namespace SigniflyAssignment\Service;

use InvalidArgumentException;
use Math_Combinatorics;
use SigniflyAssignment\Models\Project;
use SigniflyAssignment\Models\ProjectTeam;
use SigniflyAssignment\Models\ProjectTeamArray;
use SigniflyAssignment\Models\Signiflyer;
use SigniflyAssignment\Models\SigniflyerArray;

class ProjectTeamComposer
{
    /** @var Project */
    private $project;

    /** @var int */
    private $team_size;

    /** @var int */
    private $min_competence_coverage;

    /** @var int */
    private $max_team_suggestions;

    public function __construct(Project $project, int $team_size, int $min_competence_coverage, int $max_team_suggestions)
    {
        $this->project = $project;
        $this->team_size = $team_size;
        $this->min_competence_coverage = $min_competence_coverage;
        $this->max_team_suggestions = $max_team_suggestions;
    }

    /**
     * Here we do a brute force traversing of $available_signifliers until we have found $min_team_suggestions or the combinations are exhausted
     *
     * @param SigniflyerArray $available_signiflyers
     * @return ProjectTeamArray
     * @throws InvalidArgumentException if there are too few $available_signiflyers
     */
    public function findMatches(SigniflyerArray $available_signiflyers): ProjectTeamArray
    {
        if($available_signiflyers->count() < $this->team_size){
            throw new InvalidArgumentException('Number of available signiflyers('.$available_signiflyers->count().') is less than the required team size('.$this->team_size.')');
        }

        $combinatorics = new Math_Combinatorics();
        $input = range(0, $available_signiflyers->count()-1);
        $combinations = $combinatorics->combinations($input, $this->team_size);

        $teams = new ProjectTeamArray();

        $i=0;
        while($teams->count() < $this->max_team_suggestions && $i < count($combinations))
        {
            $signiflyer_combinations = $this->getSigniflyersFromIndexes($available_signiflyers, $combinations[$i]);

            $team = new ProjectTeam($this->project, $signiflyer_combinations);
            if($team->getTotalCompetenceCoverage() >= $this->min_competence_coverage){
                $teams->add($team);
            }
            $i++;
        }

        return $teams;
    }

    private function getSigniflyersFromIndexes(SigniflyerArray $signiflyers, array $indexes): SigniflyerArray
    {
        $generated_signiflyers = new SigniflyerArray();
        foreach ($indexes as $index){
            $generated_signiflyers->add($signiflyers->offsetGet($index));
        }
        return $generated_signiflyers;
    }
}