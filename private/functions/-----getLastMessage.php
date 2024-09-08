<?php
	Flight::map('getLastMessage', function($user) {
		$lastMessage = Flight::db()->query("
			SELECT *
			FROM messages
			WHERE (sender = ".Flight::user('id')." AND recipient = $user)
				OR (sender = $user AND recipient = ".Flight::user('id').")
			ORDER BY id DESC
			LIMIT 1
		")->fetch();
		if($lastMessage)
			return $lastMessage;
		else
			return false;
	});