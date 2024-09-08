<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'search.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadResults.php';
	}