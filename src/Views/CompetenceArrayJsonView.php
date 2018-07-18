<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\CompetenceArray;

class CompetenceArrayJsonView implements JsonSerializable
{

    /**
     * @var CompetenceArray
     */
    private $competences;

    public function __construct(CompetenceArray $competences)
    {
        $this->competences = $competences;
    }

    public function jsonSerialize()
    {
        $json = [];
        foreach ($this->competences as $competence) {
            $json[] = new CompetenceJsonView($competence);
        }
        return $json;
    }
}