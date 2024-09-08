<?php
	Flight::route('/ajax/delegateGroupAdmin/@group:[0-9]+/@user:[0-9]+', function($group,$user) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups', ['id'=>$group, 'admin'=>Flight::user('id')]) && $user!=Flight::user('id')) {
			if(Flight::db()->has('groups_users', ['group_id'=>$group, 'user_id'=>$user])) {
				Flight::db()->update('groups_users', ['moderator'=>0], ['group_id'=>$group, 'user_id'=>Flight::user('id')]);
				Flight::db()->update('groups_users', ['moderator'=>1], ['group_id'=>$group, 'user_id'=>$user]);
				$update = Flight::db()->update('groups', ['admin'=>$user], ['id'=>$group]);
				$data = ['success'=>$update];
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});