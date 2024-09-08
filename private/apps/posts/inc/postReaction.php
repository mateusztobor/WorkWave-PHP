<?php
	Flight::route('/ajax/postReaction/@post_id:[0-9]+', function($post_id){
		$data = ['success'=>false];
		$post = Flight::db()->get('posts', ['group_id'], ['id'=>$post_id]);
		if($post) {
			$ok = true;
			if($post['group_id'] != 0) {
				if(Flight::db()->has('groups_users', ['group_id'=>$post['group_id'], 'user_id'=>Flight::user('id')]) != true)
					$ok = false;
			}
			if($ok) {
				if(Flight::db()->has('posts_reactions', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id])) {
					$delete = Flight::db()->delete('posts_reactions', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
					if($delete) {
						Flight::db()->update('posts', ["reactions[-]" => 1], ['id'=>$post_id]);
						$reactions = Flight::db()->get('posts', ['reactions'], ['id'=>$post_id]);
						Flight::requireFunction('formatToShortNumber');
						$reactions = Flight::formatToShortNumber($reactions['reactions']);
						$data = array('success'=>true, 'status'=>false, 'reactions'=>$reactions);
					}
				} else {
					$insert = Flight::db()->insert('posts_reactions', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
					if($insert) {
						Flight::db()->update('posts', ["reactions[+]" => 1], ['id'=>$post_id]);
						$reactions = Flight::db()->get('posts', ['reactions'], ['id'=>$post_id]);
						Flight::requireFunction('formatToShortNumber');
						$reactions = Flight::formatToShortNumber($reactions['reactions']);
						$data = array('success'=>true, 'status'=>true, 'reactions'=>$reactions);
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});