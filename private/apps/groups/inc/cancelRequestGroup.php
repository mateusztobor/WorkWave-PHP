<?php
	Flight::route('/ajax/cancelRequestGroup/@id:[0-9]+', function($id) {
		$data = ['success'=>false];
		if(Flight::db()->has('groups_requests', ['group_id'=>$id, 'user_id'=>Flight::user('id')])) {
			$delete = Flight::db()->delete('groups_requests', ['group_id'=>$id, 'user_id'=>Flight::user('id')]);
			$data = ['success'=>$delete];
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});