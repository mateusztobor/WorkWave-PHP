<?php
	Flight::route('/ajax/sendMessage/@user_id:[0-9]+', function($user_id){
		$data = ['success'=>false];
		if(Flight::db()->has('users', ['id'=>$user_id])) {
			Flight::requireFunction('checkUserRole');
			if(!Flight::checkUserRole($user_id, 'b')) {
				if(isset(Flight::request()->data->content)) {
					if(mb_strlen(Flight::request()->data->content) > 0 && mb_strlen(Flight::request()->data->content) <= 256) {
						Flight::request()->data->content = strip_tags(Flight::request()->data->content);
						Flight::request()->data->content = htmlspecialchars(Flight::request()->data->content);
						$insert = Flight::db()->insert('messages', [
							'content'=>Flight::request()->data->content,
							'sender'=>Flight::user('id'),
							'recipient'=>$user_id
						]);
						$data = ['success'=>$insert];
						unset($insert);
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});