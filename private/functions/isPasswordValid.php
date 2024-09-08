<?php
	Flight::map('isPasswordValid', function($password){
		return preg_match('/^(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $password) === 1;
	});