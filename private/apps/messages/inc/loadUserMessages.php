<?php
	Flight::route('/ajax/loadUserMessages/@user_id:[0-9]+/@last_message:[0-9]+', function($user_id,$last_message) {
		if(Flight::db()->has('users', ['id'=>$user_id])) {
			$messages = Flight::db()->query("
				SELECT *
				FROM messages
				WHERE 
					((sender = ".Flight::user('id')." AND recipient = $user_id)
					OR (sender = $user_id AND recipient = ".Flight::user('id')."))
					AND id > $last_message
				ORDER BY id DESC
				LIMIT 10 OFFSET 0
			")->fetchAll();
			if($messages) {
				$messages = array_reverse($messages);
				Flight::requireFunction('convertTagsToHTML');
				Flight::requireFunction('formatDateTime2');
				foreach($messages as $mess) {
					if(!$mess['is_read'] && $mess['sender'] != Flight::user('id'))
						Flight::db()->update('messages', ['is_read'=>1], ['id'=>$mess['id']]);
					Flight::render('messages_'.($mess['sender'] == Flight::user('id') ? 'sender' : 'recipient').'_message', [
						'message_id'=>$mess['id'],
						'user_id'=>$mess['sender'],
						'message'=>$mess['content'],
						'time'=>$mess['time'],
						'is_read'=>$mess['is_read']
					]);
					
				}
			}
		}
	});