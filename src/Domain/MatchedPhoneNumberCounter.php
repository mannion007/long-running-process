<?php

namespace Mannion007\LongRunningProcess\Domain;

class MatchedPhoneNumberCounter
{
    public function countMatchedPhoneNumbers(array $matchedPhoneNumbers) : int
    {
        return count($matchedPhoneNumbers);
    }
}
