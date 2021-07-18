<?php

namespace Chaos\Support\Messenger;

use Laminas\EventManager\EventInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\LazyListenerAggregate;

/**
 * Class LaminasEventDispatcherAdapter.
 *
 * <code>
 * $dispatcher = new LaminasEventDispatcherAdapter(new EventManager());
 * $container['dispatcher'] = $dispatcher;
 * </code>
 *
 * @author t(-.-t) <ntd1712@mail.com>
 */
class LaminasEventDispatcherAdapter implements EventDispatcherInterface
{
    /**
     * @var EventManagerInterface
     */
    private $dispatcher;

    /**
     * Constructor.
     *
     * @param EventManagerInterface $dispatcher The EventManager instance.
     */
    public function __construct(EventManagerInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     *
     * @param string|object $event The object to process.
     * @param mixed $payload Optional.
     *
     * @return object
     */
    public function dispatch($event, $payload = [])
    {
        if ($event instanceof EventInterface) {
            return $this->dispatcher->triggerListeners($event);
        }

        return $this->dispatcher->trigger($event, null, $payload);
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed|\Psr\Container\ContainerInterface $container The Container instance.
     * @param string|EventSubscriberInterface $subscriber The subscriber.
     * @param array $env Additional environment/option variables.
     *
     * @return void
     */
    public function subscribe($container, $subscriber, array $env = [])
    {
        if (is_string($subscriber)) {
            $subscriber = $container->get($subscriber);
        }

        (new LazyListenerAggregate($subscriber::getSubscribedEvents(), $container, $env))
            ->attach($this->dispatcher);
    }
}
