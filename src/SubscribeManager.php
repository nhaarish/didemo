<?php 

namespace DIExample;

use PDO;
use DIExample\Mailer;

class SubscribeManager {
  
	protected $pdos;
	protected $config;
	protected $mailer;

  public function __construct($config) {
		// Get list of subscribers from datasource.
		$this->config = $config;
		$this->pdos = new PDO($this->config['dsn']);
		$this->mailer =  new Mailer($this->config);
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