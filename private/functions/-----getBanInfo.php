<?php
	Flight::map('getBanInfo', function($user) {
		return Flight::db()->get('bans', ['reason', 'expire'], ['user_id'=>$user]);
	});