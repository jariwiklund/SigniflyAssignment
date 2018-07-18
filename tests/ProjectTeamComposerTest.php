<?php

use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Models\Competence;
use SigniflyAssignment\Models\CompetenceArray;
use SigniflyAssignment\Models\CompetenceLevel;
use SigniflyAssignment\Models\Project;
use SigniflyAssignment\Models\ProjectTeam;
use SigniflyAssignment\Models\Signiflyer;
use SigniflyAssignment\Models\SigniflyerArray;
use SigniflyAssignment\Models\Skill;
use SigniflyAssignment\Service\ProjectTeamComposer;

class ProjectTeamComposerTest extends TestCase
{

    public function test_can_find_team_matches()
    {
        $phpSkill = new Skill(Uuid::uuid4(), 'Php');
        $laravelSkill = new Skill(Uuid::uuid4(), 'Laravel');
        $vueSkill = new Skill(Uuid::uuid4(), 'Vue');
        $uxDesignSkill = new Skill(Uuid::uuid4(), 'UX Design');
        $productManagementSkill = new Skill(Uuid::uuid4(), 'Product management');

        $needed_competences = CompetenceArray::fromArray( [
            new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
            new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
            new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
            new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE))
        ] );

        $project = new Project(
            Uuid::uuid4(),
            'Some generic project',
            $needed_competences
        );

        $jari = new Signiflyer(
            Uuid::uuid4(),
            'Jari Wiklund',
            'jari.wiklund@gmail.com',
            '+45 61 66 93 43',
            'Senior PHP developer',
            new Uri('https://scontent-arn2-1.xx.fbcdn.net/v/t31.0-1/c218.1.455.455/s320x320/52917_478793989024_6578172_o.jpg?_nc_cat=0&oh=9f528cbd022190074d8c21ca82ea83b9&oe=5BDF4A44'),
            CompetenceArray::fromArray([
                new Competence($phpSkill, new CompetenceLevel(CompetenceLevel::GURU)),
                new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::BASIC))
            ])
        );

        $michael = new Signiflyer(
            Uuid::uuid4(),
            'Michael Valentin',
            'mv@signifly.com',
            '+45 28 19 29 66',
            'MANAGING PARTNER & CONSULTANT',
            new Uri('https://signifly.com/images/mv_1511282520.jpg'),
            CompetenceArray::fromArray([
                new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::BASIC)),
                new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $alexander = new Signiflyer(
            Uuid::uuid4(),
            'Alexander Aagaard',
            'aa@signifly.com',
            '+45 28 96 57 69',
            'Developer',
            new Uri('https://signifly.com/images/aa_1492599327.jpg'),
            CompetenceArray::fromArray([
                new Competence($uxDesignSkill, new CompetenceLevel(CompetenceLevel::INTERMEDIATE)),
                new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $available_signiflyers = SigniflyerArray::fromArray([
            $jari, $michael, $alexander
        ]);

        $projectTeamComposer = new ProjectTeamComposer($project, 3, 0.75, 1);
        $teamSuggestions = $projectTeamComposer->findMatches($available_signiflyers);

        $this->assertEquals(1, $teamSuggestions->count());
        /** @var ProjectTeam $team */
        $team = $teamSuggestions[0];
        $this->assertLessThanOrEqual(1, $team->getTotalCompetenceCoverage());
        $this->assertGreaterThanOrEqual(0.75, $team->getTotalCompetenceCoverage());
    }

    public function test_will_only_find_relevant_teams()
    {
        $laravelSkill = new Skill(Uuid::uuid4(), 'Laravel');
        $vueSkill = new Skill(Uuid::uuid4(), 'Vue');
        $productManagementSkill = new Skill(Uuid::uuid4(), 'Product management');
        $fooSkill = new Skill(Uuid::uuid4(), 'Foo');
        $barSkill = new Skill(Uuid::uuid4(), 'Bar');

        $needed_competences = CompetenceArray::fromArray( [
            new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
            new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT)),
            new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
        ] );

        $project = new Project(
            Uuid::uuid4(),
            'Some generic project',
            $needed_competences
        );

        $jari = new Signiflyer(
            Uuid::uuid4(),
            'Jari Wiklund',
            'jari.wiklund@gmail.com',
            '+45 61 66 93 43',
            'Senior PHP developer',
            new Uri('https://scontent-arn2-1.xx.fbcdn.net/v/t31.0-1/c218.1.455.455/s320x320/52917_478793989024_6578172_o.jpg?_nc_cat=0&oh=9f528cbd022190074d8c21ca82ea83b9&oe=5BDF4A44'),
            CompetenceArray::fromArray([
                new Competence($laravelSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $michael = new Signiflyer(
            Uuid::uuid4(),
            'Michael Valentin',
            'mv@signifly.com',
            '+45 28 19 29 66',
            'MANAGING PARTNER & CONSULTANT',
            new Uri('https://signifly.com/images/mv_1511282520.jpg'),
            CompetenceArray::fromArray([
                new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $alexander = new Signiflyer(
            Uuid::uuid4(),
            'Alexander Aagaard',
            'aa@signifly.com',
            '+45 28 96 57 69',
            'Developer',
            new Uri('https://signifly.com/images/aa_1492599327.jpg'),
            CompetenceArray::fromArray([
                new Competence($vueSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $thore = new Signiflyer(
            Uuid::uuid4(),
            'Tore Heimann',
            'th@signifly.com',
            '+45 26 20 90 49',
            'TECHNICAL PROJECT MANAGER',
            new Uri('https://signifly.com/images/tore-heimann_1474202853.jpg'),
            CompetenceArray::fromArray([
                new Competence($productManagementSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $random_dude_1 = new Signiflyer(
            Uuid::uuid4(),
            'Random Dude',
            'foo@bar.baz',
            '',
            'Random',
            new Uri(''),
            CompetenceArray::fromArray([
                new Competence($fooSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $random_dude_2 = new Signiflyer(
            Uuid::uuid4(),
            'Random Dude',
            'foo@bar.baz',
            '',
            'Randim',
            new Uri(''),
            CompetenceArray::fromArray([
                new Competence($barSkill, new CompetenceLevel(CompetenceLevel::EXPERT))
            ])
        );

        $available_signiflyers = SigniflyerArray::fromArray([
            $jari, $michael, $alexander, $thore, $random_dude_1, $random_dude_2
        ]);

        $project_team_composer = new ProjectTeamComposer($project, 3, 1, 2);
        $team_suggestions = $project_team_composer->findMatches($available_signiflyers);

        $this->assertEquals(2, $team_suggestions->count());

        $thore_found = false;
        $alexander_found = false;

        /** @var ProjectTeam $team_suggestion */
        foreach ($team_suggestions as $team_suggestion){
            /** @var Signiflyer $team_member */
            foreach ($team_suggestion->getTeamMembers() as $team_member){
                $this->assertFalse($team_member->getId() === $random_dude_1->getId());
                $this->assertFalse($team_member->getId() === $random_dude_2->getId());
                if($team_member->getId() == $thore->getId()){
                    $thore_found = true;
                }
                if($team_member->getId() == $alexander->getId()){
                    $alexander_found = true;
                }
            }
        }

        $this->assertTrue($thore_found);
        $this->assertTrue($alexander_found);
    }
}