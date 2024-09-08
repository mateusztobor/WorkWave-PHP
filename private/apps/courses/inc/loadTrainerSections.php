<?php
	Flight::route('/ajax/loadTrainerCourseSections/@course_id:[0-9]+/@page:[0-9]+', function($course_id,$page) {
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			$resultsOnPage = 3;
			$page = ($page-1)*$resultsOnPage;
			$sections = Flight::db()->select('courses_sections', [
				'id',
				'title'
			], [
				'course_id'=>$course_id,
				'ORDER'=>['section_order'=>'ASC'],
				'LIMIT'=>[$page, $resultsOnPage]
			]);
			if($sections)
				foreach($sections as $section)
					Flight::render('courses_trainer_single_section', ['course_id'=>$course_id, 'section'=>$section]);
		}
	});