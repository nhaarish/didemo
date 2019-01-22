<?php 

namespace DIExample;

class Mailer {
	protected $hostname;
	protected $smtp_user;
	protected $smtp_password;
	protected $smtp_port;

	public function __construct($config) {
		$this->hostname = $config['hostname'];
		$this->smtp_user = $config['smtp_user'];
		$this->smtp_password = $config['smtp_password'];
		$this->smtp_port = $config['smtp_port'];
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
	
	public function sendMail($sender, $recipient, $subject, $body){
		$logPath = __DIR__.'/../logs/emails.log';
		$logLines = array();
		$logLines[] = sprintf(
			'[%s][%s:%s@%s:%s][From: %s][To: %s][Subject: %s]',
			date('Y-m-d H:i:s'),
			$this->hostname,
			$this->smtp_user,
			$this->smtp_password,
			$this->smtp_port,
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

}