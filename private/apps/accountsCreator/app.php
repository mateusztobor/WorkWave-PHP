<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b') && Flight::isAuthorized('r')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'accountsCreator.php';
	}