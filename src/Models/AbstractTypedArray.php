<?php
namespace SigniflyAssignment\Models;

use ArrayAccess;
use InvalidArgumentException;
use Iterator;
use Traversable;

abstract class AbstractTypedArray implements ArrayAccess, Iterator
{
    private $array = [];

    /**
     * @param array $objects
     * @return Traversable
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $objects): Traversable
    {
        $typed_array = new static();
        foreach ($objects as $object){
            $typed_array->add($object);
        }
        return $typed_array;
    }

    /**
     * @param $object
     * @throws InvalidArgumentException
     */
    public function add($object)
    {
        $this->validateType($object);
        $this->array[] = $object;
    }

    /**
     * @param $object
     * @throws InvalidArgumentException
     */
    private function validateType($object)
    {
        if(!is_object($object)){
            throw new InvalidArgumentException('Argument must be an object');
        }

        $type = $this->getType();
        if( !($object instanceof $type) ){
            throw new InvalidArgumentException('Argument must be of type '.$type);
        }
    }

    abstract protected function getType(): string;

    public function offsetExists ( $offset ): bool
    {
        return array_key_exists($offset, $this->array);
    }

    public function offsetGet ( $offset )
    {
        return $this->array[$offset];
    }

    public function offsetSet ( $offset, $value )
    {
        $this->array[$offset] = $value;
    }

    public function offsetUnset ( $offset )
    {
        unset($this->array[$offset]);
    }

    public function current()
    {
        return $this->array[$this->key()];
    }

    public function key()
    {
        return key($this->array);
    }

    public function next()
    {
        next($this->array);
    }

    public function rewind()
    {
        reset($this->array);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }
}
