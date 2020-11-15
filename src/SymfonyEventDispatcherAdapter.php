<?php

namespace Chaos\Support\Messenger;

use Symfony\Component\EventDispatcher\EventDispatcherInterface as SymfonyEventDispatcherInterface;

/**
 * Class SymfonyEventDispatcherAdapter.
 *
 * <code>
 * $dispatcher = new SymfonyEventDispatcherAdapter(new EventDispatcher());
 * $container['dispatcher'] = $dispatcher;
 * </code>
 *
 * @author t(-.-t) <ntd1712@mail.com>
 */
class SymfonyEventDispatcherAdapter implements EventDispatcherInterface
{
    /**
     * @var SymfonyEventDispatcherInterface
     */
    private $dispatcher;

    /**
     * Constructor.
     *
     * @param SymfonyEventDispatcherInterface $dispatcher The EventDispatcher instance.
     */
    public function __construct(SymfonyEventDispatcherInterface $dispatcher)
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
        return $this->dispatcher->dispatch($event);
    }

    /**
     * {@inheritDoc}
     *
     * @param \Psr\Container\ContainerInterface $container The Container instance.
     * @param string|EventSubscriberInterface $subscriber The subscriber.
     *
     * @return void
     */
    public function subscribe($container, $subscriber)
    {
        if (is_string($subscriber)) {
            $subscriber = $container->get($subscriber);
        }

        foreach ($subscriber::getSubscribedEvents() as $eventName => $arguments) { /* @var mixed $eventName */
            if (is_string($arguments)) {
                $this->dispatcher->addListener($eventName, [$subscriber, $arguments]);
            } elseif (isset($arguments[0])) {
                if (is_string($arguments[0])) {
                    $this->dispatcher->addListener(
                        $eventName,
                        [$subscriber, $arguments[0]],
                        isset($arguments[1]) ? $arguments[1] : 0
                    );
                } else {
                    foreach ($arguments as $listener) {
                        $this->dispatcher->addListener(
                            $eventName,
                            [$subscriber, $listener[0]],
                            isset($listener[1]) ? $listener[1] : 0
                        );
                    }
                }
            } elseif (isset($arguments['method'])) {
                $this->dispatcher->addListener(
                    $eventName,
                    [$subscriber, $arguments['method']],
                    isset($arguments['priority']) ? $arguments['priority'] : 0
                );
            }
        }
    }
}
