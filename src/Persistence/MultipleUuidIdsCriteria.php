<?php

namespace SigniflyAssignment\Persistence;


use SigniflyAssignment\Models\UuidArray;

class MultipleUuidIdsCriteria implements CriteriaInterface
{
    /**
     * @var UuidArray
     */
    private $uuids;

    public function __construct(UuidArray $uuids)
    {
        $this->uuids = $uuids;
    }
}