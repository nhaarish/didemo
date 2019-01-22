<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

use DIExample\SubscribeManager;
use DIExample\Mailer;

$mailer = new Mailer($config);
$pdo = new \PDO($config['dsn']);

$subscriberManager = new SubscribeManager($pdo,$mailer);
$subscriberManager->notifySubscribers();
