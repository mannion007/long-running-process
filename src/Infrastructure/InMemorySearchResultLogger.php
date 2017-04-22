<?php

namespace Mannion007\LongRunningProcess\Infrastructure;

use Mannion007\LongRunningProcess\Domain\SearchResultLoggerInterface;

class InMemorySearchResultLogger implements SearchResultLoggerInterface
{
    public $logged;

    public function log(int $resultCount, \DateTimeInterface $completedAt) : void
    {
        $this->logged = sprintf(
            '%s occurrences found. Completed at %s',
            $resultCount,
            date_format($completedAt, 'd-m-Y G:i:s')
        );
    }

    public function getLogged() : string
    {
        return $this->logged;
    }
}
