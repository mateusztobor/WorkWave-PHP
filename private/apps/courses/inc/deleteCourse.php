<?php
	Flight::route('/deleteCourse/@course_id:[0-9]+', function($course_id) {
		$ok = 0;
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			$ok=1;
			$sections = Flight::db()->select('courses_sections', ['id'], ['course_id'=>$course_id]);
			if($sections) {
				Flight::requireFunction('deleteSectionDir');
				foreach($sections as $section) 
					Flight::deleteSectionDir($section['id']);
			}
			Flight::db()->delete('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')]);
		}
		Flight::redirect($ok ? '/szkolenia' : '/szkolenia/szkolenie-'.$course_id);
	});