<?php
	Flight::route('/ajax/updateCourseSectionName/@section_id:[0-9]+', function($section_id) {
		$data = ['success'=>false];
		$section=Flight::db()->get('courses_sections', ['course_id'], ['id'=>$section_id]);
		if($section) {
			if(Flight::db()->has('courses', ['id'=>$section['course_id'], 'admin'=>Flight::user('id')])) {
				if(isset(Flight::request()->data->name)) {
					if(mb_strlen(Flight::request()->data->name) > 0 && mb_strlen(Flight::request()->data->name) <= 128) {
						$update = Flight::db()->update('courses_sections', [
							'title'=>htmlspecialchars(Flight::request()->data->name)
						], [
							'id'=>$section_id
						]);
						$data = ['success'=>$update];
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});