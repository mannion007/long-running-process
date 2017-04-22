<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\Event\EventInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class PhoneNumbersMatchedEvent extends GenericEvent implements EventInterface
{
    const EVENT_NAME = 'phone_numbers_matched';

    private $processId;
    private $phoneNumbers;
    private $occurredAt;

    public function __construct(string $processId, array $phoneNumbers, \DateTimeInterface $occurredAt = null)
    {
        parent::__construct(self::EVENT_NAME);
        $this->processId = $processId;
        $this->phoneNumbers = $phoneNumbers;
        $this->occurredAt = is_null($occurredAt) ? new \DateTime() : $occurredAt;
    }

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }

    public function getProcessId() : string
    {
        return $this->processId;
    }

    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    public function getPayload() : array
    {
        return ['process_id' => $this->processId, 'phone_numbers' => implode(',', $this->phoneNumbers)];
    }

    public function getOccurredAt() : \DateTimeInterface
    {
        return $this->occurredAt;
    }

    public static function fromPayload(array $payload) : PhoneNumbersMatchedEvent
    {
        return new self($payload['process_id'], explode(',', $payload['phone_numbers']));
    }
}
