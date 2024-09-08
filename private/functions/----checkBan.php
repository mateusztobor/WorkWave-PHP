<?php
	Flight::map('checkBan', function($user) {
		return Flight::db()->has('bans', ['user_id'=>$user]);
	});