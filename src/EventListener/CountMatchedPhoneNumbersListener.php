<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\LongRunningProcess\Domain\MatchedPhoneNumberCounter;

class CountMatchedPhoneNumbersListener implements EventListenerInterface
{
    private $matchedPhoneNumberCounter;

    public function __construct(MatchedPhoneNumberCounter $matchedPhoneNumberCounter)
    {
        $this->matchedPhoneNumberCounter = $matchedPhoneNumberCounter;
    }

    public function handle(EventInterface $event) : void
    {
        $this->matchedPhoneNumberCounter->countMatchedPhoneNumbers($event->getPhoneNumbers());
    }
}
