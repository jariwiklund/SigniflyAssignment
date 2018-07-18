<?php

namespace SigniflyAssignment\Models;


use Ramsey\Uuid\Uuid;

class UuidArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return Uuid::class;
    }

    public static function fromStrings(array $strings)
    {
        $uuid_array = new UuidArray();
        foreach ($strings as $string){
            $uuid_array->add(Uuid::fromString($string));
        }
        return $uuid_array;
    }
}