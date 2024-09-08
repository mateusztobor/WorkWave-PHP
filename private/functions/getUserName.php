<?php
	Flight::map('getUserName', function($id) {
		$user = Flight::db()->get('users', ['first_name', 'second_name'], ['id'=>$id]);
		if($user)
			return $user['first_name'].' '.$user['second_name'];
		return null;
	});