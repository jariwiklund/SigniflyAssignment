<?php

namespace SigniflyAssignment\Persistence;


class ProjectFinderFactory
{

    /**
     * @todo: implement a proper database finder probably through doctrine or eloquent
     * @return FinderInterface
     */
    public static function build(): FinderInterface
    {
        return new StaticProjectFinder();
    }
}