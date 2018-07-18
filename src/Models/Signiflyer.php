<?php

namespace SigniflyAssignment\Models;


use Ramsey\Uuid\Uuid;

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
    public function __construct(Uuid $id, string $name, string $email, string $phone, string $background_story, CompetenceArray $competences)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->background_story = $background_story;
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

}