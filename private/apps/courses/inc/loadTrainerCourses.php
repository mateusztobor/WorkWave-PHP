<?php
	Flight::route('/ajax/loadTrainerCourses', function() {
		if(isset(Flight::request()->query->page)) {
			if(Flight::request()->query->page == (int)Flight::request()->query->page) {
				$resultsOnPage = 5;
				$page = (Flight::request()->query->page - 1)*$resultsOnPage;
				$options['admin'] = Flight::user('id');
				$options['LIMIT'] = [$page, $resultsOnPage];
				if(isset(Flight::request()->query->query))
					$options['name[~]'] = htmlspecialchars(Flight::request()->query->query);
				$courses = Flight::db()->select('courses', ['id','name'], $options);
				if($courses)
					foreach($courses as $course)
						Flight::render('courses_single_course', ['course'=>$course]);
			}
		}
	});