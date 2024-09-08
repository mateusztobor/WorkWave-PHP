<?php
	Flight::route('/ajax/updateProfileDesc', function(){
		$data = ['success'=>false];
		if(isset(Flight::request()->data->content)) {
			if(mb_strlen(Flight::request()->data->content) <= 500) {
				$update = Flight::db()->update(
					'users',
					['description'=>htmlspecialchars(Flight::request()->data->content)],
					['id'=>Flight::user('id')]
				);
				$data = ['success'=>$update];
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});