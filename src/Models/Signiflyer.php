<?php

namespace SigniflyAssignment\Models;


use Psr\Http\Message\UriInterface;
use Ramsey\Uuid\Uuid;
use SigniflyAssignment\Service\CompetenceCalculator;

class Signiflyer
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $background_story;

    /**
     * @var UriInterface
     */
    private $profile_image;

    /**
     * @var CompetenceArray
     */
    private $competences;

    /**
     * Signiflyer constructor.
     * @param Uuid $id
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $background_story
     * @param CompetenceArray $competences
     */
    public function __construct(Uuid $id, string $name, string $email, string $phone, string $background_story, UriInterface $profile_image, CompetenceArray $competences)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->background_story = $background_story;
        $this->profile_image = $profile_image;
        $this->competences = $competences;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getBackgroundStory(): string
    {
        return $this->background_story;
    }

    public function addCompetence(Competence $competence)
    {
        $this->competences->add($competence);
    }

    public function getCompetences()
    {
        return clone $this->competences;
    }

    public function getCompetenceCoverage(Competence $needed_competence): float
    {
        /** @var Competence $signiflyers_competence */
        $signiflyers_competence = $this->competences->getBySkill($needed_competence->getSkill());
        if($signiflyers_competence === null){
            return 0;
        }

        //If somebody's over-competent, just pretend that he fits right-on-the-money
        return min(
            1,
            $signiflyers_competence->getCompetenceLevel()->getCoveragePercentage($needed_competence->getCompetenceLevel())
        );
    }
}