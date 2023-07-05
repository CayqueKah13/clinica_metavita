<?php

namespace Source\Support;

use \Source\Core\Config;
use \Source\Core\Database;
use \Source\Core\Helper;
use \Source\Core\Dates;

class Mailer {

	static function addEmailToQueue($to, $subject, $body) {
    $database = new Database();
		$now = Dates::now();
		$query = "INSERT INTO mail_queue (to_email, subject, body, created_at) VALUES ('".$to."', '".$subject."', '".$body."', '".$now."');";
		$database->query($query);

		Mailer::sendEmailQueue();
	}



	static function sendEmailQueue() {
		$database = new Database();
		$query = "SELECT id, subject, to_email, body FROM mail_queue WHERE sent_at IS NULL;";
		$results = $database->select($query);
		foreach ($results as $key => $value) {
			$toEmail = $value['to_email'];
			$subject = $value['subject'];
			$body = $value['body'];
			$success = Mailer::sendEmail($toEmail, $subject, $body);
			if ($success) {
				$id = $value['id'];
				$now = Dates::now();
				$fromEmail = Config::MAILER_OPTION_SENDER_EMAIL;
				$fromName = Config::MAILER_OPTION_SENDER_NAME;
				$query = "UPDATE mail_queue SET sent_at='".$now."', from_email='".$fromEmail."', from_name='".$fromName."' WHERE id=".$id." LIMIT 1;";
				$database->query($query);
			}
		}
	}



	static function sendEmail($to, $subject, $body) {
		$API_KEY = Config::MAILER_SENDGRID_KEY;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.sendgrid.com/v3/mail/send");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer '.$API_KEY));

		$info = [
		  'personalizations' => [
		    ['to' => [
		      ['email' => $to]
		    ]]
		  ],
		  'from' => [
		    'email' => Config::MAILER_OPTION_SENDER_EMAIL
		  ],
		  'subject' => $subject,
		  'content' => [
		    [
		      'type' => 'text/html',
		      'value' => $body
		    ]
		  ]
		];

		$payload = json_encode($info);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

		$server_output = curl_exec($ch);
		curl_close ($ch);

		$str = Helper::safeString($server_output);
		// var_dump($str);
		// exit;
		if ($str == "") {
			return true;
    } else {
			return false;
    }

	}


}




?>
