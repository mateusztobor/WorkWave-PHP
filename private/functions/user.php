<?php
	if(isset($_SESSION[Flight::getConfig('session_name')])) {
		$q = Flight::db()->select('users', ['users.first_name','users.second_name', 'users.email', 'users.roles'],['id'=>$_SESSION[Flight::getConfig('session_name')], 'LIMIT'=>1]);
		if($q) {
			$q=$q[0];
			$roles = explode(',',$q['roles']);
			$roles[] = 'logged';
			Flight::set(md5('system.user'), array(
				'id'=>$_SESSION[Flight::getConfig('session_name')],
				'first_name'=>$q['first_name'],
				'second_name'=>$q['second_name'],
				'email'=>$q['email'],
				'roles'=>$roles
			));
			unset($roles);
			unset($q);
		} else Flight::session_destroy();
	} else {
		Flight::set(md5('system.user'), array('roles'=>[]));
	}
	Flight::map('user', function($q=null){
		if(!is_null($q)) return Flight::get(md5('system.user'))[$q];
		return Flight::get(md5('system.user'));
	});