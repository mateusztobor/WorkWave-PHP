<?php
	Flight::map('delNewCommentImage', function() {
		$file = dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'comments'.DIRECTORY_SEPARATOR.Flight::user('id').'.webp';
		if(file_exists($file))
			return unlink($file);
		return false;
	});