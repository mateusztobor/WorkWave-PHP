<?php
	Flight::route('/uploads/avatars/@user_id:[0-9]+', function($user_id){
		$file = dirname(__DIR__, 4).DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.$user_id.'.webp';
		if(!file_exists($file)) 
			$file = dirname(__DIR__, 4).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'default-avatar-32.webp';
		header("Content-Type: image/webp");
		header("Content-Length: " . filesize($file));
		readfile($file);
	});