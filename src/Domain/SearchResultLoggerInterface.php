<?php

namespace Mannion007\LongRunningProcess\Domain;

interface SearchResultLoggerInterface
{
    public function log(int $resultCount, \DateTimeInterface $completedAt) : void;
}
