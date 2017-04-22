<?php

namespace Mannion007\LongRunningProcess\Domain;

class AllPhoneNumbersCounter
{
    public function countTotalPhoneNumbers($phoneNumbers) : int
    {
        $totalCount = count($phoneNumbers);
        return $totalCount;
    }
}
