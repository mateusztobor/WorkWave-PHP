<?php
	Flight::route('/createCourse', function() {
		$ok=0;
		if(isset(Flight::request()->data->name) && isset(Flight::request()->data->name)) {
			if(mb_strlen(Flight::request()->data->name) > 0 && mb_strlen(Flight::request()->data->name) <= 50) {
				Flight::db()->insert('courses', [
					'name'=>htmlspecialchars(Flight::request()->data->name),
					'admin'=>Flight::user('id')
				]);
				$newGroup = Flight::db()->id();
				$ok=1;
			}
		}
		Flight::redirect($ok ? '/szkolenia/szkolenie-'.$newGroup : '/szkolenia');
		unset($newGroup);
	});