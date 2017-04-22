<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\LongRunningProcess\Domain\PhoneNumberFinder;

class AllPhoneNumbersListedListener implements EventListenerInterface
{
    private $phoneNumberFinder;

    public function __construct(PhoneNumberFinder $phoneNumberFinder)
    {
        $this->phoneNumberFinder = $phoneNumberFinder;
    }

    public function handle(EventInterface $event): void
    {
        $this->phoneNumberFinder->findPhoneNumbers($event->getPhoneNumbers());
    }
}
