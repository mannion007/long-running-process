<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;
use Mannion007\LongRunningProcess\Domain\MatchedPhoneNumberCounter;
use Mannion007\LongRunningProcess\Domain\MatchedPhoneNumbersCountedEvent;

class CountMatchedPhoneNumbersListener implements EventListenerInterface
{
    private $matchedPhoneNumberCounter;
    private $eventPublisher;

    public function __construct(
        MatchedPhoneNumberCounter $matchedPhoneNumberCounter,
        EventPublisherInterface $eventPublisher
    ) {
        $this->matchedPhoneNumberCounter = $matchedPhoneNumberCounter;
        $this->eventPublisher = $eventPublisher;
    }

    public function handle(EventInterface $event) : void
    {
        $matchedCount = $this->matchedPhoneNumberCounter->countMatchedPhoneNumbers($event->getPhoneNumbers());
        $this->eventPublisher->publish(new MatchedPhoneNumbersCountedEvent($event->getProcessId(), $matchedCount));
    }
}
