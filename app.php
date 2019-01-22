<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

use DIExample\SubscribeManager;

$subscriberManager = new SubscribeManager($config);
$subscriberManager->notifySubscribers();
