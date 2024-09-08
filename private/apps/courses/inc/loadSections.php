<?php
	Flight::route('/ajax/loadCourseSections/@course_id:[0-9]+/@page:[0-9]+', function($course_id,$page) {
		if(Flight::db()->has('courses_users', ['course_id'=>$course_id, 'user_id'=>Flight::user('id')])) {
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
					Flight::render('courses_single_section', ['course_id'=>$course_id, 'section'=>$section, 'noTrainer'=>true]);
		}
	});