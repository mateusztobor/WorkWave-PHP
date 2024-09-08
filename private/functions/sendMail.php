<?php
	Flight::map('sendMail', function($message, $subject, $recipient) {
		if(filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
			$message = wordwrap($message, 70, "\r\n");
			$headers = 'From: noreply@'.$_SERVER['SERVER_NAME'];
			return mail($recipient, $subject, $message, $headers);
		}
		return false;
	});