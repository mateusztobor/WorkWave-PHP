<?php
	Flight::route('/ajax/commentReaction/@comment_id:[0-9]+', function($comment_id){
		$data = ['success'=>false];
		$comment = Flight::db()->get('posts_comments', ['post_id'], ['id'=>$comment_id]);
		if($comment) {
			$post = Flight::db()->get('posts', ['group_id'], ['id'=>$comment['post_id']]);
			if($post) {
				$ok = true;
				if($post['group_id'] != 0) {
					if(Flight::db()->has('groups_users', ['group_id'=>$post['group_id'], 'user_id'=>Flight::user('id')]) != true)
						$ok = false;
				}
				if($ok) {
					if(Flight::db()->has('posts_comments_reactions', ['user_id'=>Flight::user('id'), 'comment_id'=>$comment_id])) {
						$delete = Flight::db()->delete('posts_comments_reactions', ['user_id'=>Flight::user('id'), 'comment_id'=>$comment_id]);
						if($delete) {
							Flight::db()->update('posts_comments', ["reactions[-]" => 1], ['id'=>$comment_id]);
							$reactions = Flight::db()->get('posts_comments', ['reactions'], ['id'=>$comment_id]);
							Flight::requireFunction('formatToShortNumber');
							$reactions = Flight::formatToShortNumber($reactions['reactions']);
							$data = array('success'=>true, 'status'=>false, 'reactions'=>$reactions);
						}
					} else {
						$insert = Flight::db()->insert('posts_comments_reactions', ['user_id'=>Flight::user('id'), 'comment_id'=>$comment_id]);
						if($insert) {
							Flight::db()->update('posts_comments', ["reactions[+]" => 1], ['id'=>$comment_id]);
							$reactions = Flight::db()->get('posts_comments', ['reactions'], ['id'=>$comment_id]);
							Flight::requireFunction('formatToShortNumber');
							$reactions = Flight::formatToShortNumber($reactions['reactions']);
							$data = array('success'=>true, 'status'=>true, 'reactions'=>$reactions);
						}
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});