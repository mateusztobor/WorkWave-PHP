<?php
	Flight::route('/ajax/postFollow/@post_id:[0-9]+', function($post_id){
		$data = ['success'=>false];
		$post = Flight::db()->get('posts', ['group_id'], ['id'=>$post_id]);
		if($post) {
			$ok = true;
			if($post['group_id'] != 0) {
				if(Flight::db()->has('groups_users', ['group_id'=>$post['group_id'], 'user_id'=>Flight::user('id')]) != true)
					$ok = false;
			}
			if($ok) {
				if(Flight::db()->has('posts_follows', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id])) {
					$delete = Flight::db()->delete('posts_follows', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
					if($delete) {
						Flight::db()->update('posts', ["follows[-]" => 1], ['id'=>$post_id]);
						$follows = Flight::db()->get('posts', ['follows'], ['id'=>$post_id]);
						Flight::requireFunction('formatToShortNumber');
						$follows = Flight::formatToShortNumber($follows['follows']);
						$data = array('success'=>true, 'status'=>false, 'follows'=>$follows);
					}
				} else {
					$insert = Flight::db()->insert('posts_follows', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
					if($insert) {
						Flight::db()->update('posts', ["follows[+]" => 1], ['id'=>$post_id]);
						$follows = Flight::db()->get('posts', ['follows'], ['id'=>$post_id]);
						Flight::requireFunction('formatToShortNumber');
						$follows = Flight::formatToShortNumber($follows['follows']);
						$data = array('success'=>true, 'status'=>true, 'follows'=>$follows);
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});