<?php
	Flight::route('/wiadomosci/@user_id:[0-9]+', function($user_id){
		$user = Flight::db()->get('users', ['first_name', 'second_name'], ['id'=>$user_id]);
		if($user) {
			Flight::requireFunction('checkUserRole');
			Flight::render('main', [
				'user_id'=>$user_id,
				'user_name'=>$user['first_name'].' '.$user['second_name'],
				'tpl'=>'messages_box',
			]);
		} else 
			Flight::redirect('/wiadomosci');
	});