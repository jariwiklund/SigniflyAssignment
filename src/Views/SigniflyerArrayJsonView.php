<?php

namespace SigniflyAssignment\Views;


use JsonSerializable;
use SigniflyAssignment\Models\Signiflyer;
use SigniflyAssignment\Models\SigniflyerArray;

class SigniflyerArrayJsonView implements JsonSerializable
{

    /**
     * @var SigniflyerArray
     */
    private $signiflyers;

    public function __construct(SigniflyerArray $signiflyers)
    {
        $this->signiflyers = $signiflyers;
    }

    public function jsonSerialize()
    {
        $json = [];
        /** @var Signiflyer $signiflyer */
        foreach ($this->signiflyers as $signiflyer){
            $json[] = new SigniflyerJsonView($signiflyer);
        }
        return $json;
    }
}