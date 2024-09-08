<?php
	Flight::route('/ajax/loadCourses', function() {
		if(isset(Flight::request()->query->page)) {
			if(Flight::request()->query->page == (int)Flight::request()->query->page) {
				$resultsOnPage = 5;
				$page = (Flight::request()->query->page - 1)*$resultsOnPage;
				$options['LIMIT'] = [$page, $resultsOnPage];
				$options['user_id'] = Flight::user('id');
				if(isset(Flight::request()->query->query))
					$options['courses.name[~]'] = htmlspecialchars(Flight::request()->query->query);
				$courses = Flight::db()->select('courses_users', ["[>]courses" => ["course_id" => "id"]], ['courses.id','courses.name'], $options);
				if($courses)
					foreach($courses as $course)
						Flight::render('courses_single_course', ['course'=>$course, 'noTrainer'=>true]);
			}
		}
	});