<?php

namespace Chaos\Support\Messenger;

use Psr\EventDispatcher\EventDispatcherInterface as BaseEventDispatcherInterface;

/**
 * Interface EventDispatcherInterface.
 */
interface EventDispatcherInterface extends BaseEventDispatcherInterface
{
    /**
     * Registers events with the dispatcher.
     *
     * @param \Psr\Container\ContainerInterface $container The Container instance.
     * @param string|object $observer The observer.
     *
     * @return void
     */
    public function subscribe($container, $observer);
}
