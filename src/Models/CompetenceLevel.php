<?php

namespace SigniflyAssignment\Models;


use SplEnum;

class CompetenceLevel extends SplEnum
{
    const __default = self::LEVEL_INCOMPETENT;

    const INCOMPETENT = 0;
    const BASIC = 1;
    const INTERMEDIATE = 2;
    const EXPERT = 3;
    const GURU = 4;
}