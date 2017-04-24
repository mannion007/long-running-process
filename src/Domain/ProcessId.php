<?php

namespace Mannion007\LongRunningProcess\Domain;

use Ramsey\Uuid\Uuid;

class ProcessId
{
    private $processId;

    private function __construct(string $processId)
    {
        $this->processId = $processId;
    }

    public static function generate()
    {
        return new self(Uuid::uuid4()->toString());
    }

    public static function fromExisting(string $existing)
    {
        return new self($existing);
    }

    public function doesNotEqual(ProcessId $other)
    {
        return !$this->equals($other);
    }

    public function equals(ProcessId $other)
    {
        return $this->processId === (string)$other;
    }

    public function __toString()
    {
        return $this->processId;
    }
}
