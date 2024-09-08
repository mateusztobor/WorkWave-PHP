<?php
	Flight::route('/ajax/courseMemberDecision/@course_id:[0-9]+/@user_id:[0-9]+/@decision:[0-9]+', function($course_id,$user_id,$decision) {
		$success=false;
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			if(Flight::db()->has('users', ['id'=>$user_id])) {
				if($decision == 1 || $decision == 0) {
					
					if($decision) {
						if(!Flight::db()->has('courses_users', ['course_id'=>$course_id, 'user_id'=>$user_id]))
							$success=Flight::db()->insert('courses_users', ['course_id'=>$course_id, 'user_id'=>$user_id]);
					} else {
						if(Flight::db()->has('courses_users', ['course_id'=>$course_id, 'user_id'=>$user_id])) {
							Flight::db()->delete('courses_users', ['course_id'=>$course_id, 'user_id'=>$user_id]);
							$success=true;
						}
					}
				}
			}
		}
		echo json_encode(['success'=>$success],JSON_UNESCAPED_SLASHES);
	});