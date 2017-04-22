<?php

namespace Mannion007\LongRunningProcess\Domain;

interface SearchResultLoggerInterface
{
    public function log(int $matchedCount, int $allCount, \DateTimeInterface $completedAt) : void;
}
