<?php
	Flight::route('/banAccount/@user_id:[0-9]+', function($user_id) {
		$roles = Flight::db()->get('users', ['roles'], ['id'=>$user_id]);
		if($roles) {
			$allow = Flight::isAuthorized('a') || ((Flight::isAuthorized('m') || Flight::isAuthorized('r')) && (!in_array('a', $roles) && !in_array('m', $roles) && !in_array('r', $roles) && !in_array('t', $roles)));
			if($allow && $user_id != Flight::user('id') && $user_id != 1) {
				$roles=explode(',',$roles['roles']);
				if(in_array('b', $roles))
					$roles = array_diff($roles, ['b']);
				else
					$roles[] = 'b';
				$roles = array_filter($roles);
				$roles = implode(',',$roles);
				Flight::db()->update('users', ['roles'=>$roles], ['id'=>$user_id]);
				Flight::redirect('/uzytkownik-'.$user_id.'#p');
			} else
				Flight::notFound();
		} else
			Flight::notFound();
	});