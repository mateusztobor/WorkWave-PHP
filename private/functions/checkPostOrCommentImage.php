<?php
	Flight::map('checkPostOrCommentImage', function($post_id,$what='post') {
		return file_exists(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$what.'s'.DIRECTORY_SEPARATOR.$post_id.'.webp');
	});