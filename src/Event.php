<?php

namespace Chaos\Support\Messenger;

/**
 * Class Event.
 */
class Event implements EventInterface, \ArrayAccess, \IteratorAggregate
{
    /**
     * @var string Event name.
     */
    protected $name;

    /**
     * @var array Event arguments.
     */
    protected $arguments = [];

    /**
     * Constructor.
     *
     * @param string $name Event name.
     * @param array $arguments Event arguments.
     */
    public function __construct($name = null, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name Event name.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * {@inheritDoc}
     *
     * @param array $arguments Event arguments.
     *
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name Argument name.
     * @param mixed $default Default value to return if argument does not exist.
     *
     * @return mixed
     */
    public function getArgument($name, $default = null)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : $default;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name Argument name.
     * @param mixed $value Value.
     *
     * @return $this
     */
    public function setArgument($name, $value)
    {
        $this->arguments[$name] = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $name Argument name.
     *
     * @return bool
     */
    public function hasArgument($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    // <editor-fold defaultstate="collapsed" desc="ArrayAccess methods">

    /**
     * {@inheritDoc}
     *
     * @param string $offset An offset to check for.
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->hasArgument($offset);
    }

    /**
     * {@inheritDoc}
     *
     * @param string $offset The offset to retrieve.
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getArgument($offset);
    }

    /**
     * {@inheritDoc}
     *
     * @param string $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->setArgument($offset, $value);
    }

    /**
     * {@inheritDoc}
     *
     * @param string $offset The offset to unset.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->arguments[$offset]);
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="IteratorAggregate methods">

    /**
     * {@inheritDoc}
     *
     * @return \Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }

    // </editor-fold>
}
