<?php

namespace Mannion007\LongRunningProcess\Domain;

interface PhoneNumberProviderInterface
{
    public function getPhoneNumbers() : array;
}
