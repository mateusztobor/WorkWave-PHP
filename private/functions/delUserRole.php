<?php
	Flight::map('delUserRole', function($user,$role) {
		if(Flight::user('id') != $user && $user != 1) {
			$roles = Flight::db()->get('users', ['roles'], ['id'=>$user]);
			if($roles) {
				$roles = explode(',',$roles['roles']);
				if(in_array($role,$roles)) {
					$roles = array_diff($roles, [$role]);
					$roles = array_filter($roles);
					$roles = implode(',',$roles);
					return Flight::db()->update('users', ['roles'=>$roles], ['id'=>$user]);
				}
				return false;
			}
		}
		return false;
	});