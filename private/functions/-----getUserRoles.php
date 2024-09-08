<?php
	Flight::map('getUserRoles', function($user) {
		$roles = Flight::db()->get('users', ['roles'], ['id'=>$user]);
		return ($roles ? $roles : [])
	});