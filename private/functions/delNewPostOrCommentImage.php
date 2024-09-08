<?php
	Flight::map('delNewPostOrCommentImage', function($what='post') {
		$file = dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.$what.'s'.DIRECTORY_SEPARATOR.Flight::user('id').'.webp';
		if(file_exists($file))
			return unlink($file);
		return false;
	});