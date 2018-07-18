<?php

namespace SigniflyAssignment\Models;


class SigniflyerArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return Signiflyer::class;
    }
}