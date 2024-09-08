<?php
	Flight::route('/ajax/updateCourseName/@course_id:[0-9]+', function($course_id) {
		$data = ['success'=>false];
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			if(isset(Flight::request()->data->name)) {
				if(mb_strlen(Flight::request()->data->name) > 0 && mb_strlen(Flight::request()->data->name) <= 128) {
					$update = Flight::db()->update('courses', [
						'name'=>htmlspecialchars(Flight::request()->data->name)
					], [
						'id'=>$course_id
					]);
					$data = ['success'=>$update];
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});