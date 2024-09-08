<?php	
	Flight::map('unreadMessages', function(){
		return Flight::db()->has('messages', ['recipient'=>Flight::user('id'), 'is_read'=>0]);
	});