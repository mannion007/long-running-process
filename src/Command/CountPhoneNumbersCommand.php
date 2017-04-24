<?php

namespace Mannion007\LongRunningProcess\Command;

use Mannion007\LongRunningProcess\Domain\AreaCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
        $this->setDescription('Counts customers with phone numbers belonging to a given area code.');
        $this->addArgument('area_code', InputArgument::REQUIRED, 'The area code to search for.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $targetAreaCode = AreaCode::fromExisting($input->getArgument('area_code'));
        $this->phoneNumberExecutive->searchPhoneNumbers($targetAreaCode);
    }
}
