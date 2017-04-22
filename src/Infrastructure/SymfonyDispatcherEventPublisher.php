<?php

namespace Mannion007\LongRunningProcess\Infrastructure;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SymfonyDispatcherEventPublisher implements EventPublisherInterface
{
    private $dispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->dispatcher = $eventDispatcher;
    }

    public function publish(EventInterface $event) : void
    {
        $this->dispatcher->dispatch($event->getEventName(), $event);
    }
}
