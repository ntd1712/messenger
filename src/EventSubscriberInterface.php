<?php

namespace Chaos\Support\Messenger;

/**
 * Interface EventSubscriberInterface.
 */
interface EventSubscriberInterface
{
    /**
     * Returns an array of events to which this class has subscribed.
     *
     * <code>
     * [
     *   'the-event-name' => [
     *     'listener' => 'some-class', // or static::class
     *     'method'   => 'onEventName',
     *     'event'    => 'the-event-name',
     *     'priority' => 1
     *   ],
     *   [...],
     * ]
     * </code>
     *
     * @return array
     */
    public static function getSubscribedEvents();
}
