<?php
	Flight::map('checkImage', function($path){
		$path = str_replace(array('/',"\\"), DIRECTORY_SEPARATOR, $path);
		if(file_exists(dirname(__DIR__, 2).$path)) return true;
		return false;
	});