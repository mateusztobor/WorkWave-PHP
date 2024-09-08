<?php
	Flight::route('/ajax/joinGroup/@id:[0-9]+', function($id) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups', ['id'=>$id, 'public'=>1])) {
			if(!Flight::db()->has('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id')])) {
				$insert = Flight::db()->insert('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id')]);
				Flight::db()->update('groups', ['members[+]'=>1], ['id'=>$id]);
				$data = ['success'=>$insert];
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});