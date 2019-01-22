<?php

use DIExample\SubscribeManager;
use DIExample\Mailer;

$container['pdo'] = function ($container) {
    return new PDO($container['dsn']);
  };
  
  $container['mailer'] = function ($container) {
    return new Mailer($container);
  };
  
  $container['subscribemanager'] = function ($container) {
    return new SubscribeManager($container['pdo'], $container['mailer']);
  };