<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;
use Mannion007\LongRunningProcess\Domain\AllPhoneNumbersCountedEvent;
use Mannion007\LongRunningProcess\Domain\AllPhoneNumbersCounter;

class CountAllPhoneNumbersListener implements EventListenerInterface
{
    private $allPhoneNumbersCounter;
    private $eventPublisher;

    public function __construct(
        AllPhoneNumbersCounter $allPhoneNumbersCounter,
        EventPublisherInterface $eventPublisher
    ) {
        $this->allPhoneNumbersCounter = $allPhoneNumbersCounter;
        $this->eventPublisher = $eventPublisher;
    }

    public function handle(EventInterface $event) : void
    {
        $totalCount = $this->allPhoneNumbersCounter->countTotalPhoneNumbers($event->getPhoneNumbers());
        $this->eventPublisher->publish(new AllPhoneNumbersCountedEvent($event->getProcessId(), $totalCount));
    }
}
