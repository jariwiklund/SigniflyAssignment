<?php
namespace SigniflyAssignment\Models;


class CompetenceArray extends AbstractTypedArray
{

    protected function getType(): string
    {
        return Competence::class;
    }

    /**
     * @param Competence $competence
     */
    public function add($competence)
    {
        $this->validateType($competence);
        $this->offsetSet($competence->getSkill()->getId()->toString(), $competence);
    }

    /**
     * @param Skill $skill
     * @return ?Competence
     */
    public function getBySkill(Skill $skill)
    {
        if(!$this->offsetExists($skill->getId()->toString())){
            return null;
        }

        return $this->offsetGet($skill->getId()->toString());
    }
}