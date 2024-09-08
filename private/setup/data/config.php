<?php
	Flight::setConfig('url','{url}');
	Flight::setConfig('timezone','Europe/Warsaw');
	Flight::setConfig('database',
		array(array(
			'type' => 'mysql',
			'host' => '{host}',
			'database' => '{db}',
			'username' => '{user}',
			'password' => '{pass}',
			'charset' => 'utf8mb4',
			'collation' => 'utf8mb4_bin',
			'port' => {port},
			'prefix' => '',
			'logging' => false,
			'error' => PDO::ERRMODE_SILENT,
			'option' => [
				PDO::ATTR_CASE => PDO::CASE_NATURAL
			],
			'command' => [
				'SET SQL_MODE=ANSI_QUOTES'
			]
	)));
	Flight::setConfig('debug', 0);
?>