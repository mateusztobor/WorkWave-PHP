<?php
	Flight::route('/ajax/updateGroupDesc/@group_id:[0-9]+', function($group_id){
		$data = ['success'=>false];
		if(isset(Flight::request()->data->content)) {
			if(mb_strlen(Flight::request()->data->content) <= 500) {
				$update = Flight::db()->update(
					'groups',
					['description'=>htmlspecialchars(Flight::request()->data->content)],
					['id'=>$group_id, 'admin'=>Flight::user('id')]
				);
				$data = ['success'=>$update];
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});