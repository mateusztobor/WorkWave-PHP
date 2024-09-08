<?php
	Flight::route('/szkolenia/szkolenie-@course_id/sekcja-@section_id:[0-9]+', function($course_id,$section_id){
		$noPerm=false;
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			$course = Flight::db()->get('courses', ['id', 'name'], ['id'=>$course_id]);
			if($course) {
				$section = Flight::db()->get('courses_sections', ['id', 'title', 'content'], ['course_id'=>$course_id, 'id'=>$section_id]);
				if($section) {
					Flight::requireFunction('getTpl');
					Flight::requireFunction('add2Head');
					Flight::add2Head(Flight::getTpl('editor_head'));
					Flight::render('main', [
						'tpl'=>'course_trainer_section',
						'course'=>$course,
						'section'=>$section
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