## Problem Statement:

**Subscriptions Notifications App:**
Create a PHP app that reads subscriber list from a database and sends them a
notification.

The Project history follows is as follows. Each step is represented by the corresponding v-tag in git i.e. 1 is v1, 2 is v2 and so on.

1. **Procedural code:**
    1. send_mail() function sends mail to senders
2. **Object-oriented code:**
    1. Create a Mailer class to send mail**
        1. Create constructor to initialize smtp, host and port details
        2. Move the logging logic in send_mail to sendMail() method of Mailer class
    2. Move mailer class to src folder for psr-4 standardizing
        1. Add autoloading code in composer.json
        2. Create src/Mailer.php and move the Mailer class to it
        3. Initialize and use Mailer class in app.php
    3. Create SubscriberManager class:
        1. Initialize PDO in constructor
        2. Keep the application logic in notifySubsriber() method
        3. Application logic: get subscriber and call Mailer->sendMail()
3. **Move config to config.php:**
    1. Create config.php and Move mailer config and DSN to configuration
    2. Require config.php in app.php
    3. Pass config to objects
    4. Remove config from SubscriberManager
    - **_Challenges:_**
        - **_SubscriberManager needs to know the implementation details of Mailer_**
    - **_Can't mock test SubscriberManager_**
    - **_This is where the concept of DI comes in_**
4. Use constructor DI**
    1. Move Instantiation of PDO and Mailer from SubscriberManager.php to app.php and pass both to sendMail() method.
    2. This allows SubscriberManager to no more be concerned with the instantiation logic of Mailer.
    3. Can be unit tested by passing mock PDO & Mailer objects to constructor.
5. **Switch to method DI**
    1. Move $mailer & $pdo injection from constructor to method
    2. Remove constructor and protected $mailer and $pdo from SubscriberManager
6. **Switch back to constructor DI**
    - **_Talk about services and service container._**
7. **Use pimple container:**
    1. Use composer to add pimple/pimple to project: https://packagist.org/packages/pimple/pimple
    2. Add PDO, Mailer & SubscriberManager services to container. (Syntax from above link)
    3. Add config to container in config.php and use them in app.php for service instantiation
8. **Move services to a separate file:**
    1. Move all services to service.php and include it in app.php
9. **Extra: Add a Notifier interface**
