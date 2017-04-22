<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\Event\EventInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class AllPhoneNumbersListedEvent extends GenericEvent implements EventInterface
{
    const EVENT_NAME = 'all_phone_numbers_listed';

    private $phoneNumbers;
    private $occurredAt;

    public function __construct(array $phoneNumbers, \DateTimeInterface $occurredAt = null)
    {
        parent::__construct(self::EVENT_NAME);
        $this->phoneNumbers = $phoneNumbers;
        $this->occurredAt = is_null($occurredAt) ? new \DateTime() : $occurredAt;
    }

    public function getEventName() : string
    {
        return self::EVENT_NAME;
    }
    
    public function getPhoneNumbers() : array
    {
        return $this->phoneNumbers;
    }

    public function getPayload() : array
    {
        return
            [
                'phone_numbers' => implode(',', $this->phoneNumbers)
            ];
    }

    public function getOccurredAt() : \DateTimeInterface
    {
        return $this->occurredAt;
    }

    public static function fromPayload(array $payload) : AllPhoneNumbersListedEvent
    {
        return new self(explode(',', $payload['phone_numbers']));
    }
}
