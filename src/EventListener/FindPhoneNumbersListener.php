<?php

namespace Mannion007\LongRunningProcess\EventListener;

use Mannion007\Interfaces\Event\EventInterface;
use Mannion007\Interfaces\EventListener\EventListenerInterface;
use Mannion007\LongRunningProcess\Domain\AreaCode;
use Mannion007\LongRunningProcess\Domain\PhoneNumberFinder;
use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;
use Mannion007\LongRunningProcess\Domain\PhoneNumbersMatchedEvent;

class FindPhoneNumbersListener implements EventListenerInterface
{
    private $phoneNumberFinder;
    private $eventPublisher;

    public function __construct(
        PhoneNumberFinder $phoneNumberFinder,
        EventPublisherInterface $eventPublisher
    ) {
        $this->phoneNumberFinder = $phoneNumberFinder;
        $this->eventPublisher = $eventPublisher;
    }

    public function handle(EventInterface $event) : void
    {
        $matches = $this->phoneNumberFinder->findPhoneNumbers(
            AreaCode::fromExisting($event->getAreaCode()),
            $event->getPhoneNumbers()
        );
        $this->eventPublisher->publish(new PhoneNumbersMatchedEvent($event->getProcessId(), $matches));
    }
}
