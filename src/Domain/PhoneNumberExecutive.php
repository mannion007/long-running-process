<?php

namespace Mannion007\LongRunningProcess\Domain;

use Mannion007\Interfaces\EventPublisher\EventPublisherInterface;

class PhoneNumberExecutive
{
    private $phoneNumberProvider;
    private $searchResultLogger;
    private $eventPublisher;

    /** @var ProcessId */
    private $processId;

    private $matchedPhoneNumbersCount;
    private $allPhoneNumbersCount;

    public function __construct(
        PhoneNumberProviderInterface $phoneNumberProvider,
        SearchResultLoggerInterface $searchResultLogger,
        EventPublisherInterface $eventPublisher
    ) {
        $this->phoneNumberProvider = $phoneNumberProvider;
        $this->searchResultLogger = $searchResultLogger;
        $this->eventPublisher = $eventPublisher;
    }

    public function searchPhoneNumbers()
    {
        $phoneNumbers = $this->phoneNumberProvider->getPhoneNumbers();
        if (count($phoneNumbers) == 0) {
            throw new \Exception('There are no phone numbers to search');
        }

        $this->processId = ProcessId::generate();
        $this->eventPublisher->publish(new AllPhoneNumbersListedEvent($this->processId, $phoneNumbers));
    }

    public function matchedPhoneNumbersCounted(string $processId, int $matchedCount)
    {
        if ($this->processId->isNot(ProcessId::fromExisting($processId))) {
            throw new \Exception('Event is from another process');
        }
        $this->matchedPhoneNumbersCount = $matchedCount;
        if ($this->isComplete()) {
            $this->release();
        }
    }

    public function allPhoneNumbersCounted(string $processId, int $totalCount)
    {
        if ($this->processId->isNot(ProcessId::fromExisting($processId))) {
            throw new \Exception('Event is from another process');
        }
        $this->allPhoneNumbersCount = $totalCount;
        if ($this->isComplete()) {
            $this->release();
        }
    }

    private function isComplete() : bool
    {
        return $this->matchedPhoneNumbersCount !== null && $this->allPhoneNumbersCount !== null;
    }

    private function release() : void
    {
        $this->searchResultLogger->log($this->matchedPhoneNumbersCount, $this->allPhoneNumbersCount, new \DateTime());
    }
}
