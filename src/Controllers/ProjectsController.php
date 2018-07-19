<?php
namespace SigniflyAssignment\Controllers;

use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Models\Project;
use SigniflyAssignment\Models\UuidArray;
use SigniflyAssignment\Persistence\MultipleUuidIdsCriteria;
use SigniflyAssignment\Persistence\NullCriteria;
use SigniflyAssignment\Persistence\ProjectFinderFactory;
use SigniflyAssignment\Persistence\SigniflyFinderFactory;
use SigniflyAssignment\Persistence\UuidIdCriteria;
use SigniflyAssignment\Service\ProjectTeamComposer;
use SigniflyAssignment\Utils\Util;
use SigniflyAssignment\Views\ProjectArrayJsonView;
use SigniflyAssignment\Views\ProjectJsonView;
use SigniflyAssignment\Views\ProjectTeamArrayJsonView;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController implements ControllerInterface
{

    /**
     * @todo: implement proper routing instead of hard-coding like this.
     * This will also enable us to come closer to richardson maturity level 4
     *
     * @param RequestInterface $request
     * @return Response
     */
    public function handleRequest(RequestInterface $request): Response
    {
        if($request->getMethod() === 'GET' && $request->getUri()->getPath() === '/projects'){
            return $this->index();
        }

        if($request->getMethod() === 'GET' && preg_match('/projects\/(' . Util::uuidRegexPattern() . ')/', $request->getUri()->getPath(), $matches)){
            $project = ProjectFinderFactory::build()->get(new UuidIdCriteria(Uuid::fromString($matches[1])));
            return $this->show($project);
        }

        if($request->getMethod() === 'POST' && preg_match('/projects\/(' . Util::uuidRegexPattern() . ')\/team-suggestions/', $request->getUri()->getPath(), $matches)){
            $project = ProjectFinderFactory::build()->get(new UuidIdCriteria(Uuid::fromString($matches[1])));
            //todo: implement validation of the json
            return $this->generateTeamSuggestions($project, json_decode((string) $request->getBody()));
        }
    }

    public function show(Project $project): Response
    {
        $view = new ProjectJsonView($project);
        return new Response(json_encode($view), 200, ['Content-Type' => 'text/json']);
    }

    /**
     * @todo handle the $json differently, probably through a GenerateTeamSuggestionsRequest class
     * This should also help with validation and richardson maturity level.
     *
     * @param Project $project
     * @param $json
     * @return Response
     */
    public function generateTeamSuggestions(Project $project, $json): Response
    {
        $project_team_composer = new ProjectTeamComposer($project, $json->team_size, $json->min_competence_coverage, $json->max_team_suggestions);
        $available_signiflyers = SigniflyFinderFactory::build()
            ->find(
                new MultipleUuidIdsCriteria(
                    UuidArray::fromStrings($json->signiflyer_ids)
                )
            );
        $team_suggestions = $project_team_composer->findMatches($available_signiflyers);

        $view = new ProjectTeamArrayJsonView($team_suggestions);
        return new Response(json_encode($view), 200, ['Content-Type' => 'text/json']);
    }

    public function index(): Response
    {
        $view = new ProjectArrayJsonView(ProjectFinderFactory::build()->find(new NullCriteria()));
        return new Response(json_encode($view), 200, ['Content-Type' => 'text/json']);
    }
}