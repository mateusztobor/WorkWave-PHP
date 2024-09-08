<?php
	require dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'flight'.DIRECTORY_SEPARATOR.'Flight.php';
	if(file_exists(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'.installed')) {
		require __DIR__.DIRECTORY_SEPARATOR.'conf.core.php';
		error_reporting((Flight::getConfig('debug') ? E_ALL : 0));
		date_default_timezone_set(Flight::getConfig('timezone'));
		require __DIR__.DIRECTORY_SEPARATOR.'apps.core.php';
		require __DIR__.DIRECTORY_SEPARATOR.'ver.core.php';
		require __DIR__.DIRECTORY_SEPARATOR.'err.core.php';
		require __DIR__.DIRECTORY_SEPARATOR.'db.core.php';
		require __DIR__.DIRECTORY_SEPARATOR.'func.core.php';
		Flight::runApps();
		Flight::start();
		Flight::destroy();
	} else
		require __DIR__.DIRECTORY_SEPARATOR.'installer.core.php';