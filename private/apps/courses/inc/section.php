<?php
	Flight::route('/moje-szkolenia/szkolenie-@course_id/sekcja-@section_id:[0-9]+', function($course_id,$section_id){
		$noPerm=false;
		if(Flight::db()->has('courses_users', ['course_id'=>$course_id, 'user_id'=>Flight::user('id')])) {
			$course = Flight::db()->get('courses', ['id', 'name'], ['id'=>$course_id]);
			if($course) {
				$section = Flight::db()->get('courses_sections', ['title', 'content'], ['course_id'=>$course_id, 'id'=>$section_id]);
				if($section) {
					Flight::render('main', [
						'tpl'=>'course_section',
						'course'=>$course,
						'section_title'=>$section['title'],
						'section_content'=>htmlspecialchars_decode($section['content']),
					]);
				} else
					$noPerm=true;
			} else
				$noPerm=true;
		} else
			$noPerm=true;
		
		if($noPerm)
			Flight::render('main', ['tpl'=>'course_404']);
	});