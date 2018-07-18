<?php

namespace SigniflyAssignment\Models;
use InvalidArgumentException;

/**
 * @todo update php to use SplEnum
 * Class CompetenceLevel
 * @package SigniflyAssignment\Models
 */
class CompetenceLevel
{
    const BASIC = 1;
    const INTERMEDIATE = 2;
    const EXPERT = 3;
    const GURU = 4;

    /** @var int */
    private $level;

    /**
     * CompetenceLevel constructor.
     * @param int $level
     * @throws InvalidArgumentException
     */
    public function __construct(int $level)
    {
        if($level < CompetenceLevel::BASIC || $level > CompetenceLevel::GURU){
            throw new InvalidArgumentException('Invalid competence level');
        }

        $this->level = $level;
    }

    public function getCoveragePercentage(CompetenceLevel $competenceLevel): float
    {
        return $this->level / $competenceLevel->level;
    }
}