<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\Signiflyer;

class SigniflyerJsonView implements JsonSerializable
{

    /**
     * @var Signiflyer
     */
    private $signiflyer;

    public function __construct(Signiflyer $signiflyer)
    {
        $this->signiflyer = $signiflyer;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->signiflyer->getId(),
            'name' => $this->signiflyer->getName(),
            'email' => $this->signiflyer->getEmail(),
            'phone' => $this->signiflyer->getPhone(),
            'background_story' => $this->signiflyer->getBackgroundStory(),
            'competences' => new CompetenceArrayJsonView($this->signiflyer->getCompetences())
        ];
    }
}