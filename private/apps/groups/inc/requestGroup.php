<?php
	Flight::route('/ajax/requestGroup/@id:[0-9]+', function($id) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups', ['id'=>$id, 'public'=>0])) {
			if(!Flight::db()->has('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id')])) {
				if(!Flight::db()->has('group_requests', ['group_id'=>$id, 'user_id'=>Flight::user('id')])) {
					$insert = Flight::db()->insert('groups_requests', ['group_id'=>$id, 'user_id'=>Flight::user('id')]);
					$data = ['success'=>$insert];
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});