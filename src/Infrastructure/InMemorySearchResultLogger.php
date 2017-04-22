<?php

namespace Mannion007\LongRunningProcess\Infrastructure;

use Mannion007\LongRunningProcess\Domain\SearchResultLoggerInterface;

class InMemorySearchResultLogger implements SearchResultLoggerInterface
{
    public $logged;

    public function log(int $matchedCount, int $allCount, \DateTimeInterface $completedAt) : void
    {
        $this->logged = sprintf(
            '%s of %s phone numbers matched on %s',
            $matchedCount,
            $allCount,
            date_format($completedAt, 'd-m-Y G:i:s')
        );
    }

    public function getLogged() : string
    {
        return $this->logged;
    }
}
