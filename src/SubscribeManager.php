<?php 

namespace DIExample;

use DIExample\Mailer;
use PDO;

class SubscribeManager {
  
	protected $pdos;
	protected $mailer;

  public function __construct(PDO $pdo, Mailer $mailer) {
		// Get list of subscribers from datasource.
		$this->pdos = $pdo;
		$this->mailer = $mailer;
  }

  public function notifySubscribers() {
		
		$query = "SELECT * FROM subscribers";
		$subscribers = $this->pdos->query($query);

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

		$this->mailer->sendMail($sender, $subscriber['email'], $subject, $message);
		}
	}
}