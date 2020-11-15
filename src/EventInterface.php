<?php

namespace Chaos\Support\Messenger;

/**
 * Interface EventInterface.
 */
interface EventInterface
{
    /**
     * Gets event name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the event name.
     *
     * @param string $name Event name.
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Gets arguments passed to the event.
     *
     * @return array
     */
    public function getArguments();

    /**
     * Sets event arguments.
     *
     * @param array $arguments Event arguments.
     *
     * @return $this
     */
    public function setArguments(array $arguments);

    /**
     * Gets a single argument by name.
     *
     * @param string $name Argument name.
     * @param mixed $default Default value to return if argument does not exist.
     *
     * @return mixed
     */
    public function getArgument($name, $default = null);

    /**
     * Sets a single argument by name.
     *
     * @param string $name Argument name.
     * @param mixed $value Value.
     *
     * @return $this
     */
    public function setArgument($name, $value);

    /**
     * Determines whether the given argument name is present.
     *
     * @param string $name Argument name.
     *
     * @return bool
     */
    public function hasArgument($name);
}
