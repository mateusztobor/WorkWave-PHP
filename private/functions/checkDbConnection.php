<?php
	Flight::map('checkDbConnection', function($db) {
		if(isset($db['host']) && isset($db['db']) && isset($db['user']) && isset($db['pass']) && isset($db['port'])) { 
			try {
				$conn = new PDO("mysql:host=".$db['host'].":".$db['port'].";dbname=".$db['db']."", $db['user'], $db['pass']);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return true;
			} catch(PDOException $e) {
				return false;
			}
		}
	});