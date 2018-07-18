<?php

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Controllers\ProjectController;

class ControllerTest extends TestCase
{
    public function test_can_call_index()
    {
        $controller = new ProjectController();
        $request = new Request('GET', '/projects');
        $response = $controller->handleRequest($request);
        $json = json_decode($response->getContent());
        $this->assertCount(1, $json);
        $this->assertEquals('Test project', $json[0]->name);
    }

    public function test_can_call_show()
    {
        $controller = new ProjectController();
        $request = new Request('GET', '/projects/'.Uuid::uuid4()->toString());
        $response = $controller->handleRequest($request);
        $json = json_decode($response->getContent());
        $this->assertEquals('Test project', $json->name);
    }

    public function test_can_call_generateTeamSuggestions()
    {
        $controller = new ProjectController();
        $json = [
            'team_size' => 2,
            'min_competence_coverage' => 0.75,
            'max_team_suggestions' => 2,
            'signiflyer_ids' => [
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString()
            ]
        ];
        $request = new Request('POST', '/projects/'.Uuid::uuid4()->toString().'/team-suggestions', [], json_encode($json));
        $response = $controller->handleRequest($request);
        $json = json_decode($response->getContent());
        $this->assertCount(2, $json);
        $this->assertCount(2, $json[0]->team_members);
        $this->assertCount(2, $json[1]->team_members);
    }
}