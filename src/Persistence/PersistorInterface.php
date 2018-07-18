<?php

namespace SigniflyAssignment\Persistence;


interface PersistorInterface
{
    public function persist($model);
}