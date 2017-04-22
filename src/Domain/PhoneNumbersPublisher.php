<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;

class PhoneNumbersPublisher
{
    private $phoneNumberProvider;
    private $eventPublisher;

    public function __construct(
        PhoneNumberProviderInterface $phoneNumberProvider,
        EventPublisherInterface $eventPublisher
    ) {
        $this->phoneNumberProvider = $phoneNumberProvider;
        $this->eventPublisher = $eventPublisher;
    }

    public function listAllPhoneNumbers() : void
    {
        $phoneNumbers = $this->phoneNumberProvider->getPhoneNumbers();
        if (count($phoneNumbers) == 0) {
            throw new \Exception('There are no phone numbers to publish');
        }
        $this->eventPublisher->publish(new AllPhoneNumbersListedEvent($phoneNumbers));
    }
}
