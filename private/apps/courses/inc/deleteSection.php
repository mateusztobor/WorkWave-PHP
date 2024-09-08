<?php
	Flight::route('/deleteCourseSection/@section_id:[0-9]+', function($section_id) {
		$ok = 0;
		$section=Flight::db()->get('courses_sections', ['course_id'], ['id'=>$section_id]);
		if($section) {
			if(Flight::db()->has('courses', ['id'=>$section['course_id'], 'admin'=>Flight::user('id')])) {
				Flight::requireFunction('deleteSectionDir');
				Flight::deleteSectionDir($section_id);
				$ok=1;
				Flight::db()->delete('courses_sections', ['id'=>$section_id]);
			}
		}
		Flight::redirect($ok ? '/szkolenia/szkolenie-'.$section['course_id'] : '/szkolenia/szkolenie-'.$section['course_id'].'/sekcja-'.$section_id);
	});