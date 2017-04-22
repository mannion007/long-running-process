<?php

namespace Mannion007\LongRunningProcess\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mannion007\LongRunningProcess\Domain\PhoneNumberExecutive;

class CountPhoneNumbersCommand extends Command
{
    private $phoneNumberExecutive;

    public function __construct(PhoneNumberExecutive $phoneNumberExecutive)
    {
        parent::__construct();
        $this->phoneNumberExecutive = $phoneNumberExecutive;
    }

    protected function configure()
    {
        $this->setName('app:count-phone-numbers');
        $this->setDescription('Counts phone numbers with the 01474 area code within a given list');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->phoneNumberExecutive->searchPhoneNumbers();
    }
}
