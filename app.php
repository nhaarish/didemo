<?php

require __DIR__ . '/vendor/autoload.php';

// Get list of subscribers from datasource.
$dsn = 'sqlite:' . __DIR__ . '/data/database.sqlite';
$pdo = new PDO($dsn);
$query = 'SELECT * FROM subscribers';
$subscribers = $pdo->query($query);

// Sender and Subject of the mail.
$sender = 'subscriptions@example.com';
$subject = 'New Article alert for you!';

foreach ($subscribers as $subscriber) {
// Customized message of the mail.
  $message = sprintf(<<<EOF
Hello %s! A new article has been published in the domain you have subscribed for.
You can visit the link below to read the article below. To unsubscribe, browse to our website, login & click on unsubscribe button!.
EOF
  , $subscriber['name']);

  send_mail($sender, $subscriber['email'], $subject, $message);
}

/**
 * Sends mail to user.
 *
 * @param string $recipient
 *   Email of the recipient.
 * @param string $subject
 *   Subject of the mail.
 * @param string $body
 *   Body of the mail.
 *
 * @return void
 */
function send_mail($sender, $recipient, $subject, $body) {
  $hostname = 'smtp.blogtrottr.com';
  $smtp_user = 'smtpuser';
  $smtp_password = 'smtppass';
  $smtp_port = '465';
  // Log messages for demo in a log file.
  $logPath = __DIR__.'/logs/emails.log';
  $logLines = array();
  $logLines[] = sprintf(
      '[%s][%s:%s@%s:%s][From: %s][To: %s][Subject: %s]',
      date('Y-m-d H:i:s'),
      $hostname,
      $smtp_user,
      $smtp_password,
      $smtp_port,
      $sender,
      $recipient,
      $subject
  );
  $logLines[] = '---------------';
  $logLines[] = $body;
  $logLines[] = '---------------';

  $fh = fopen($logPath, 'a');
  fwrite($fh, implode("\n", $logLines)."\n");
}
