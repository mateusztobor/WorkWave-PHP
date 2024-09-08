<?php
	Flight::map('getImage', function($path){
		$path = str_replace(array('/',"\\"), DIRECTORY_SEPARATOR, $path);
		if(file_exists(dirname(__DIR__, 2).$path)) return Flight::getConfig('url').$path;
		else return Flight::getConfig('url').'/public/img/nopicture.webp';
	});