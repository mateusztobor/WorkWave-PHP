<?php
	Flight::route('/ajax/leaveGroup/@id:[0-9]+', function($id) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id')])) {
			if(Flight::db()->has('groups', ['id'=>$id, 'admin'=>Flight::user('id')]))
				$delete = Flight::db()->delete('groups', ['id'=>$id]);
			else {
				$delete = Flight::db()->delete('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id')]);
				Flight::db()->update('groups', ['members[-]'=>1], ['id'=>$id]);
			}
			$data = ['success'=>$delete];
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});