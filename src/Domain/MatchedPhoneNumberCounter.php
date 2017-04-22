<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;

class MatchedPhoneNumberCounter
{
    private $eventPublisher;

    public function __construct(EventPublisherInterface $eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
    }

    public function countMatchedPhoneNumbers(array $matchedPhoneNumbers) : void
    {
        $count = count($matchedPhoneNumbers);
        $this->eventPublisher->publish(new MatchedPhoneNumbersCountedEvent($count));
    }
}
