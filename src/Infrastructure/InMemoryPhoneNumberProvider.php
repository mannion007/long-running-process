<?php

namespace Mannion007\LongRunningProcess\Infrastructure;

use Mannion007\LongRunningProcess\Domain\PhoneNumberProviderInterface;

class InMemoryPhoneNumberProvider implements PhoneNumberProviderInterface
{
    private $phoneNumbers = [];

    public function addPhoneNumber(string $phoneNumber) : void
    {
        $this->phoneNumbers[] = $phoneNumber;
    }

    public function getPhoneNumbers(): array
    {
        return $this->phoneNumbers;
    }
}
