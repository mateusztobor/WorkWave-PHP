<?php
	Flight::route('/delegateCourseAdmin/@course:[0-9]+/@user:[0-9]+', function($course_id,$user_id) {
		$ok=false;
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			$user = Flight::db()->get('users', ['roles'], ['id'=>$user_id]);
			if($user) {
				if(in_array('t', explode(',',$user['roles'])))
					$ok = Flight::db()->update('courses', ['admin'=>$user_id], ['id'=>$course_id]);
			}
		}
		Flight::redirect($ok ? '/szkolenia' : '/szkolenia/szkolenie-'.$course_id.'/uczestnicy');
	});