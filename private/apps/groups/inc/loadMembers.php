<?php
	Flight::route('/ajax/loadGroupMembers/@group_id:[0-9]+', function($group_id) {
		$group = Flight::db()->get('groups', ['admin'], ['id'=>$group_id]);
		if($group) {
			$member = Flight::db()->get('groups_users', ['moderator'], ['group_id'=>$group_id, 'user_id'=>Flight::user('id')]);
			if($member) {
				if(isset(Flight::request()->query->page)) {
					if(Flight::request()->query->page == (int)Flight::request()->query->page) {
						$resultsOnPage = 5;
						$page = (Flight::request()->query->page - 1)*$resultsOnPage;
						if(isset(Flight::request()->query->query)) {
							$query = htmlspecialchars(Flight::request()->query->query);
							$users = Flight::db()->query("
								SELECT users.id, users.first_name, users.second_name, users.roles, groups_users.moderator
								FROM groups_users
								INNER JOIN users ON groups_users.user_id = users.id
								WHERE groups_users.group_id = ".$group_id."
								AND (
									users.first_name LIKE '%".$query."%'
									OR users.second_name LIKE '%".$query."%'
									OR CONCAT(users.first_name, ' ', users.second_name) LIKE '%".$query."%'
								)
								LIMIT ".$page.",".$resultsOnPage.";
							")->fetchAll();
						} else {
							
							$users = Flight::db()->select('groups_users', ['[<]users'=>['user_id'=>'id']], [
								'users.id',
								'users.first_name',
								'users.second_name',
								'users.roles',
								'groups_users.moderator'
							], [
								'groups_users.group_id'=>$group_id,
								'ORDER' => ['groups_users.moderator' => 'DESC'],
								'LIMIT' => [$page, $resultsOnPage]
							]);
						}
						if($users)
							foreach($users as $user)
								Flight::render('group_members_profile', [
									'user' => $user,
									'banned'=>in_array('b', explode(',',$user['roles'])),
									'moderator'=>$member['moderator'],
									'admin'=>Flight::user('id') == $group['admin'],
									'group_admin'=>$group['admin']
								]);
					}
				}
			}
		}
	});