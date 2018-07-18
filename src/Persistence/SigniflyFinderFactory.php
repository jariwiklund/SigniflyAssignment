<?php

namespace SigniflyAssignment\Persistence;


class SigniflyFinderFactory
{

    public static function build(): FinderInterface
    {
        return new StaticSigniflyFinder();
    }
}