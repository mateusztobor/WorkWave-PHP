<?php
	Flight::route('/szkolenia/szkolenie-@id/uczestnicy', function($id){
		$noPerm=false;
		if(Flight::db()->has('courses', ['id'=>$id, 'admin'=>Flight::user('id')])) {
			$course = Flight::db()->get('courses', ['name'], ['id'=>$id]);
			if($course) {
				Flight::requireFunction('getUserName');
				Flight::render('main', [
					'tpl'=>'course_members',
					'course_id'=>$id,
					'course_name'=>$course['name']
				]);
			} else
				$noPerm=true;
		} else
			$noPerm=true;
		
		if($noPerm)
			Flight::render('main', ['tpl'=>'course_404']);
	});