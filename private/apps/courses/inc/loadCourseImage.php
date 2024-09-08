<?php
	Flight::route('/public/img/courses/@section_id:[0-9]+/@image', function($section_id,$image) {
		$ok=true;
		$section=Flight::db()->get('courses_sections', ['course_id'], ['id'=>$section_id]);
		if($section) {
			if(
				Flight::db()->has('courses_users', ['course_id'=>$section['course_id'], 'user_id'=>Flight::user('id')]) ||
				Flight::db()->has('courses', ['id'=>$section['course_id'], 'admin'=>Flight::user('id')])
			) {
				$file = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'courses'.DIRECTORY_SEPARATOR.$section_id.DIRECTORY_SEPARATOR.$image.'.webp';
				if(!file_exists($file)) 
					$ok=false;
			} else
				$ok=false;
		} else
			$ok = false;
		
		if($ok) {
			header("Content-Type: image/webp");
			header("Content-Length: " . filesize($file));
			readfile($file);
		} else
			Flight::notFound();
	});