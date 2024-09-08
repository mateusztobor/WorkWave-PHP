<?php
	Flight::route('/addCourseSection/@course_id:[0-9]+', function($course_id) {
		$ok=0;
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			$order = Flight::db()->max('courses_sections', 'section_order', ['course_id'=>$course_id]);
			$insert = Flight::db()->insert('courses_sections', [
				'course_id'=>$course_id,
				'title'=>'Nowa sekcja',
				'content'=>'',
				'section_order' => $order ? $order+1 : 1
			]);
			$newSection = Flight::db()->id();
			if($insert)
				$ok=1;
			unset($insert);
		}
		Flight::redirect($ok ? '/szkolenia/szkolenie-'.$course_id.'/sekcja-'.$newSection : '/szkolenia/szkolenie-'.$course_id);
		unset($newSection);
	});