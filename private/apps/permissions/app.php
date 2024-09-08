<?php
	if(Flight::isAuthorized('a')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'permissions.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadPermissions.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'setPerm.php';
	}