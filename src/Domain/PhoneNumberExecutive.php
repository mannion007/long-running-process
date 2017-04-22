<?php

namespace Mannion007\LongRunningProcess\Domain;

class PhoneNumberExecutive
{
    private $searchResultLogger;

    public function __construct(SearchResultLoggerInterface $searchResultLogger)
    {
        $this->searchResultLogger = $searchResultLogger;
    }

    public function logResult(int $resultCount) : void
    {
        $this->searchResultLogger->log($resultCount, new \DateTime());
    }
}
