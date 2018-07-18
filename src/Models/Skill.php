<?php
namespace SigniflyAssignment\Models;

use Ramsey\Uuid\Uuid;

class Skill
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var String
     */
    private $name;

    /**
     * @param Uuid $id
     * @param String $name
     */
    public function __construct(Uuid $id, String $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

}