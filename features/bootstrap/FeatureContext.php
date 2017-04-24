<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $baseDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";

    private $container;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($this->container, new \Symfony\Component\Config\FileLocator($this->baseDir . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Config'));
        $loader->load('container_test.yml');

        /** @var \Symfony\Component\EventDispatcher\EventDispatcher $eventDispatcher */
        $eventDispatcher = $this->container->get('event_dispatcher');
        $eventDispatcher->addListener(
            \Mannion007\LongRunningProcess\Domain\AllPhoneNumbersListedEvent::EVENT_NAME,
            [$this->container->get('find_phone_numbers_listener'), 'handle']
        );
        $eventDispatcher->addListener(
            \Mannion007\LongRunningProcess\Domain\AllPhoneNumbersListedEvent::EVENT_NAME,
            [$this->container->get('count_all_phone_numbers_listener'), 'handle']
        );
        $eventDispatcher->addListener(
            \Mannion007\LongRunningProcess\Domain\PhoneNumbersMatchedEvent::EVENT_NAME,
            [$this->container->get('count_matched_phone_numbers_listener'), 'handle']
        );
        $eventDispatcher->addListener(
            \Mannion007\LongRunningProcess\Domain\MatchedPhoneNumbersCountedEvent::EVENT_NAME,
            [$this->container->get('complete_matched_phone_numbers_counted_listener'), 'handle']
        );
        $eventDispatcher->addListener(
            \Mannion007\LongRunningProcess\Domain\AllPhoneNumbersCountedEvent::EVENT_NAME,
            [$this->container->get('complete_all_phone_numbers_counted_listener'), 'handle']
        );
    }

    /**
     * @Given I have the list of customers with phone numbers:
     */
    public function iHaveTheListOfCustomersWithPhoneNumbers(TableNode $tableNode)
    {
        $phoneNumberProvider = $this->container->get('phone_number_provider');
        foreach ($tableNode->getIterator() as $row) {
            $phoneNumberProvider->addPhoneNumber($row['phone_number']);
        }
    }

    /**
     * @When I count occurrences of the :areaCode area code
     */
    public function iCountOccurrencesOfTheAreaCode(string $areaCode)
    {
        $command = $this->container->get("console_command.count_phone_numbers");
        $input = new Symfony\Component\Console\Input\ArrayInput(['area_code' => $areaCode]);
        $output = new \Symfony\Component\Console\Output\BufferedOutput();
        $command->run($input, $output);
    }

    /**
     * @Then The log should contain :expected
     */
    public function iShouldGet(string $expected)
    {
        $searchResultLogger = $this->container->get('search_result_logger');
        $actual = $searchResultLogger->getLogged();
        if (false === strpos($actual, $expected)) {
            throw new \Exception(sprintf('The log does not contain %s', $expected));
        }
    }
}
