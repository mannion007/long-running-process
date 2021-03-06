<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\Event\EventInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class MatchedPhoneNumbersCountedEvent extends GenericEvent implements EventInterface
{
    const EVENT_NAME = 'matched_phone_numbers_counted';

    private $processId;
    private $count;
    private $occurredAt;

    public function __construct(string $id, int $count, \DateTimeInterface $occurredAt = null)
    {
        parent::__construct(self::EVENT_NAME);
        $this->processId = $id;
        $this->count = $count;
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

    public function getCount() : int
    {
        return $this->count;
    }

    public function getOccurredAt() : \DateTimeInterface
    {
        return $this->occurredAt;
    }

    public function getPayload() : array
    {
        return ['process_id' => $this->processId, 'count' => $this->count];
    }

    public static function fromPayload(array $payload) : MatchedPhoneNumbersCountedEvent
    {
        return new self($payload['process_id'], $payload['count']);
    }
}
