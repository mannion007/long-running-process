<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;

class PhoneNumberFinder
{
    private $eventPublisher;

    public function __construct(EventPublisherInterface $eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
    }

    public function findPhoneNumbers(array $phoneNumbers) : void
    {
        $matches = [];
        foreach ($phoneNumbers as $phoneNumber) {
            if (substr($phoneNumber, 0, 5) === '01474') {
                $matches[] = $phoneNumber;
            }
        }
        $this->eventPublisher->publish(new PhoneNumbersMatchedEvent($matches));
    }
}
