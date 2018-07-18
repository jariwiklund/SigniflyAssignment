<?php

namespace SigniflyAssignment\Persistence;


use Ramsey\Uuid\Uuid;

class UuidIdCriteria implements CriteriaInterface
{

    /**
     * @var Uuid
     */
    private $uuid;

    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }
}