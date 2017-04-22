<?php

namespace Mannion007\LongRunningProcess\Application;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mannion007\LongRunningProcess\Domain\PhoneNumbersPublisher;

class CountPhoneNumbersCommand extends Command
{
    private $phoneNumbersPublisher;

    public function __construct(PhoneNumbersPublisher $phoneNumbersPublisher)
    {
        parent::__construct();
        $this->phoneNumbersPublisher = $phoneNumbersPublisher;
    }

    protected function configure()
    {
        $this->setName('app:count-phone-numbers');
        $this->setDescription('Counts phone numbers with the 01474 area code within a given list');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->phoneNumbersPublisher->listAllPhoneNumbers();
    }
}
