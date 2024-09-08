<?php
	Flight::route('/ajax/loadCourseMembers/@course_id:[0-9]+', function($course_id) {
		if(Flight::db()->has('courses', ['id'=>$course_id, 'admin'=>Flight::user('id')])) {
			if(isset(Flight::request()->query->page)) {
				if(Flight::request()->query->page == (int)Flight::request()->query->page) {
					$resultsOnPage = 5;
					$page = (Flight::request()->query->page - 1)*$resultsOnPage;
					
					if(isset(Flight::request()->query->query)) {
						$query = htmlspecialchars(Flight::request()->query->query);
						$users = Flight::db()->query("
							SELECT id, first_name, second_name, roles
							FROM users
							WHERE 
								users.first_name LIKE '%".$query."%'
								OR users.second_name LIKE '%".$query."%'
								OR CONCAT(users.first_name, ' ', users.second_name) LIKE '%".$query."%'
							LIMIT ".$page.",".$resultsOnPage.";
						")->fetchAll();
					} else {
						$users = Flight::db()->select('courses_users', [
							'[>]users' => ['courses_users.user_id'=>'id']
						], [
							'users.id',
							'users.first_name',
							'users.second_name',
							'users.roles'
						], [
							'LIMIT'=>[$page, $resultsOnPage]
						]);
					}
					
					if($users)
						foreach($users as $user) {
							$roles = explode(',',$user['roles']);
							Flight::render('course_members_profile', [
								'course_id' => $course_id,
								'user' => $user,
								'isMember'=>Flight::db()->has('courses_users', ['user_id'=>$user['id'], 'course_id'=>$course_id]),
								'trainer'=>in_array('t', $roles),
								'banned'=>in_array('b', $roles)
							]);
							unset($roles);
						}
				}
			}
		}
	});