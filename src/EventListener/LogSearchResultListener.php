<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\LongRunningProcess\Domain\PhoneNumberExecutive;

class LogSearchResultListener implements EventListenerInterface
{
    private $phoneNumberExecutive;

    public function __construct(PhoneNumberExecutive $phoneNumberExecutive)
    {
        $this->phoneNumberExecutive = $phoneNumberExecutive;
    }

    public function handle(EventInterface $event) : void
    {
        $this->phoneNumberExecutive->logResult($event->getCount());
    }
}
