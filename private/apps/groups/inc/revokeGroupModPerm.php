<?php
	Flight::route('/ajax/revokeGroupModPerm/@group:[0-9]+/@user:[0-9]+', function($group,$user) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups', ['id'=>$group, 'admin'=>Flight::user('id')])) {
			$update = Flight::db()->update('groups_users', ['moderator'=>0], ['group_id'=>$group, 'user_id'=>$user]);
			$data = ['success'=>$update];
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});