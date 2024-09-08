<?php
	Flight::route('/ajax/loadGroupRequests/@group_id:[0-9]+', function($group_id) {
		$group = Flight::db()->get('groups', ['public', 'admin'], ['id'=>$group_id]);
		if($group) {
			if(!$group['public']) {
				$moderator = Flight::db()->has('groups_users', ['group_id'=>$group_id, 'user_id'=>Flight::user('id'), 'moderator'=>1]);
				if($group['admin'] == Flight::user('id') || $moderator) {
					if(isset(Flight::request()->query->page)) {
						if(Flight::request()->query->page == (int)Flight::request()->query->page) {
							$resultsOnPage = 5;
							$page = (Flight::request()->query->page - 1)*$resultsOnPage;
							if(isset(Flight::request()->query->query)) {
								$query = htmlspecialchars(Flight::request()->query->query);
								$users = Flight::db()->query("
									SELECT users.id, users.first_name, users.second_name, users.roles
									FROM groups_requests
									INNER JOIN users ON groups_requests.user_id = users.id
									WHERE groups_requests.group_id = ".$group_id."
									AND (
										users.first_name LIKE '%".$query."%'
										OR users.second_name LIKE '%".$query."%'
										OR CONCAT(users.first_name, ' ', users.second_name) LIKE '%".$query."%'
									)
									LIMIT ".$page.",".$resultsOnPage.";
								");
							} else {
								
								$users = Flight::db()->select('groups_requests', ['[<]users'=>['user_id'=>'id']], [
									'users.id',
									'users.first_name',
									'users.second_name',
									'users.roles'
								], [
									'groups_requests.group_id'=>$group_id,
									'LIMIT' => [$page, $resultsOnPage]
								]);
							}
							if($users)
								foreach($users as $user) {
									Flight::render('group_requests_profile', [
										'user' => $user,
										'banned'=>in_array('b', explode(',',$user['roles']))
									]);
								}
						}
					}
				}
			}
		}
	});