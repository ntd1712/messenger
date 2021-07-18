<?php

namespace Chaos\Support\Messenger;

use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class LaravelEventDispatcherAdapter.
 *
 * <code>
 * $dispatcher = new LaravelEventDispatcherAdapter(app('events'));
 * $container['dispatcher'] = $dispatcher;
 * </code>
 *
 * @author t(-.-t) <ntd1712@mail.com>
 */
class LaravelEventDispatcherAdapter implements EventDispatcherInterface
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Constructor.
     *
     * @param Dispatcher $dispatcher The Dispatcher instance.
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     *
     * @param string|object $event The object to process.
     * @param mixed $payload Optional.
     *
     * @return null|array
     */
    public function dispatch($event, $payload = [])
    {
        if ($event instanceof EventInterface) {
            $payload = $event->getArguments();
            $event = $event->getName();
        }

        return $this->dispatcher->dispatch($event, $payload);
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

        foreach ($subscriber::getSubscribedEvents() as $eventName => $arguments) {
            $this->dispatcher->listen($eventName, $arguments['listener'] . '@' . $arguments['method']);
        }
    }
}
