<?php

namespace Mannion007\LongRunningProcess\Domain;

class PhoneNumberFinder
{
    public function findPhoneNumbers(array $phoneNumbers) : array
    {
        $matches = [];
        foreach ($phoneNumbers as $phoneNumber) {
            if (substr($phoneNumber, 0, 5) === '01474') {
                $matches[] = $phoneNumber;
            }
        }
        return $matches;
    }
}
