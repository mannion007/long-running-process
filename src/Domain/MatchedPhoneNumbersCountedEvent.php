<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\Event\EventInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class MatchedPhoneNumbersCountedEvent extends GenericEvent implements EventInterface
{
    const EVENT_NAME = 'matched_phone_numbers_counted';

    private $count;
    private $occurredAt;

    public function __construct(int $count, \DateTimeInterface $occurredAt = null)
    {
        parent::__construct(self::EVENT_NAME);
        $this->count = $count;
        $this->occurredAt = is_null($occurredAt) ? new \DateTime() : $occurredAt;
    }

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getPayload(): array
    {
        return ['count' => $this->count];
    }

    public function getOccurredAt(): \DateTimeInterface
    {
        return $this->occurredAt;
    }

    public static function fromPayload(array $payload)
    {
        return new self($payload['count']);
    }
}
