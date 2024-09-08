<?php
	Flight::map('checkUserRole', function($user,$q) {
		$roles = Flight::db()->get('users', ['roles'], ['id'=>$user]);
		return $roles ? ((in_array('a',explode(',',$roles['roles'])) && $q!='b') || in_array($q,explode(',',$roles['roles']))) : false;
	});