<?php
	Flight::route('/ajax/updateCourseSectionContent/@section_id:[0-9]+', function($section_id) {
		$data = ['success'=>false];
		$section=Flight::db()->get('courses_sections', ['course_id'], ['id'=>$section_id]);
		if($section) {
			if(Flight::db()->has('courses', ['id'=>$section['course_id'], 'admin'=>Flight::user('id')])) {
				if(isset(Flight::request()->data->content)) {
					Flight::requireFunction('deleteNewLines');
					Flight::request()->data->content = htmlspecialchars(Flight::deleteNewLines(Flight::request()->data->content));
					$update = Flight::db()->update('courses_sections', [
						'content'=>Flight::request()->data->content
					], [
						'id'=>$section_id
					]);
					$data = ['success'=>$update];
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});