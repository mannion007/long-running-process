<?php

namespace Mannion007\LongRunningProcess\Domain;

class PhoneNumberFinder
{
    public function findPhoneNumbers(AreaCode $targetAreaCode, array $phoneNumbers) : array
    {
        $matches = [];
        foreach ($phoneNumbers as $phoneNumber) {
            if (AreaCode::fromExisting(substr($phoneNumber, 0, 5))->equals($targetAreaCode)) {
                $matches[] = $phoneNumber;
            }
        }
        return $matches;
    }
}
