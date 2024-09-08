<?php
	Flight::route('/ajax/loadMessages', function() {
		if(isset(Flight::request()->query->page)) {
			if(Flight::request()->query->page == (int)Flight::request()->query->page) {
				$resultsOnPage = 10;
				$offset = (Flight::request()->query->page - 1)*$resultsOnPage;
				if(isset(Flight::request()->query->query)) {
					$query = htmlspecialchars(Flight::request()->query->query);
					$users = Flight::db()->query("
						SELECT id, CONCAT(first_name, ' ', second_name) as name FROM users 
						WHERE first_name LIKE '%".$query."%' 
						OR second_name LIKE '%".$query."%' 
						OR CONCAT(first_name, ' ', second_name) LIKE '%".$query."%'
						LIMIT $resultsOnPage OFFSET $offset;
					")->fetchAll();
					
					if($users)
						foreach($users as $user) 
							Flight::render('messages_single_user', ['user' => $user]);
				} else {
					$messages = Flight::db()->query("
						SELECT * FROM messages 
						WHERE (sender = ".Flight::user('id')." OR recipient = ".Flight::user('id').")
						AND id IN (
							SELECT MAX(id) FROM messages 
							WHERE sender = ".Flight::user('id')." OR recipient = ".Flight::user('id')."
							GROUP BY 
								CASE
									WHEN sender = ".Flight::user('id')." THEN recipient
									ELSE sender
								END
						)
						ORDER BY id DESC
						LIMIT $resultsOnPage OFFSET $offset;
					")->fetchAll();
					
					if($messages) {
						Flight::requireFunction('getUserName');
						Flight::requireFunction('shortString');
						foreach($messages as $mess) {
							$lastYourMessage=($mess['sender'] == Flight::user('id'));
							if($lastYourMessage) 
								$user = ['id'=>$mess['recipient'], 'name'=>Flight::getUserName($mess['recipient'])];
							else
								$user = ['id'=>$mess['sender'], 'name'=>Flight::getUserName($mess['sender'])];
							Flight::render('messages_single_user', [
								'user'=>$user,
								'message'=>Flight::shortString($mess['content'], 32),
								'lastYourMessage'=>$lastYourMessage,
								'time'=>$mess['time'],
								'is_read' => $mess['is_read']
							]);
						}
					}
				}
			}
		}
	});