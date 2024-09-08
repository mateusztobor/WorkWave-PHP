<?php
	Flight::route('/moje-szkolenia/szkolenie-@id', function($id){
		$noPerm=false;
		if(Flight::db()->has('courses_users', ['course_id'=>$id, 'user_id'=>Flight::user('id')])) {
			$course = Flight::db()->get('courses', ['name', 'admin'], ['id'=>$id]);
			if($course) {
				Flight::requireFunction('getUserName');
				Flight::render('main', [
					'tpl'=>'course',
					'course_id'=>$id,
					'course_name'=>$course['name'],
					'course_admin_id'=>$course['admin'],
					'course_admin_name'=>Flight::getUserName($course['admin'])
				]);
			} else
				$noPerm=true;
		} else
			$noPerm=true;
		
		if($noPerm)
			Flight::render('main', ['tpl'=>'course_404']);
	});