<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Console\Application;

require_once(__DIR__ . '/../vendor/autoload.php');

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Config'));
$loader->load('container.yml');

/** @var Mannion007\LongRunningProcess\Domain\PhoneNumberProviderInterface $provider */
$provider = $container->get('phone_number_provider');

$provider->addPhoneNumber('01474334062');
$provider->addPhoneNumber('01474334063');
$provider->addPhoneNumber('01474334064');
$provider->addPhoneNumber('01474334065');
$provider->addPhoneNumber('01474334065');

/** @var EventDispatcher $eventDispatcher */
$eventDispatcher = $container->get('event_dispatcher');
$eventDispatcher->addListener(
    \Mannion007\LongRunningProcess\Domain\AllPhoneNumbersListedEvent::EVENT_NAME,
    [$container->get('all_phone_numbers_listed_listener'), 'handle']
);
$eventDispatcher->addListener(
    \Mannion007\LongRunningProcess\Domain\PhoneNumbersMatchedEvent::EVENT_NAME,
    [$container->get('phone_numbers_matched_listener'), 'handle']
);
$eventDispatcher->addListener(
    \Mannion007\LongRunningProcess\Domain\MatchedPhoneNumbersCountedEvent::EVENT_NAME,
    [$container->get('matched_phone_numbers_counted_listener'), 'handle']
);

$console = new Application();

$taggedCommands = $container->findTaggedServiceIds('console.command');
foreach ($taggedCommands as $id => $tags) {
    $console->add($container->get($id));
}

$console->run();
