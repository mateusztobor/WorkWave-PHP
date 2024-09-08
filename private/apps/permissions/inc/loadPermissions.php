<?php
	Flight::route('/ajax/admin/loadPermissions', function() {
		if(isset(Flight::request()->query->page)) {
			if(Flight::request()->query->page == (int)Flight::request()->query->page) {
				$resultsOnPage = 5;
				$page = (Flight::request()->query->page - 1)*$resultsOnPage;
				if(isset(Flight::request()->query->query)) {
					$query = htmlspecialchars(Flight::request()->query->query);
					$users = Flight::db()->query("
						SELECT id,first_name,second_name,roles FROM users 
						WHERE first_name LIKE '%".$query."%' 
						OR second_name LIKE '%".$query."%' 
						OR CONCAT(first_name, ' ', second_name) LIKE '%".$query."%'
						LIMIT ".$page.",".$resultsOnPage.";
					")->fetchAll();
				} else {
					$users = Flight::db()->select('users', [
						'id',
						'first_name',
						'second_name',
						'roles'
					], [
						'AND' => [
							'roles[!]' => 'b',
							'roles[!]' => ""
						],
						'LIMIT' => [$page, $resultsOnPage]
					]);
				}
				if($users)
					foreach($users as $user) {
						if($user['roles'] != 'b') {
							$user['roles'] = explode(',',$user['roles']);
							Flight::render('permissions_profile', ['user' => $user, 'banned'=>in_array('b', $user['roles'])]);
						}
					}
			}
		}
	});