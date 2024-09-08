<?php
	Flight::route('/ajax/publicNewComment', function(){
		$data = ['success'=>false];
		if(isset(Flight::request()->data->content) && isset(Flight::request()->data->post)) {
			if(intval(Flight::request()->data->post) == Flight::request()->data->post) {
				Flight::request()->data->post=htmlspecialchars(Flight::request()->data->post);
				$post=Flight::db()->get('posts', ['group_id'], ['id'=>Flight::request()->data->post]);
				if($post) {
					if(Flight::db()->has('groups_users', ['user_id'=>Flight::user('id'), 'group_id'=>$post['group_id']]) || $post['group_id'] == 0) {
						if(mb_strlen(Flight::request()->data->content) > 0 && mb_strlen(Flight::request()->data->content) <= 500) {
							Flight::request()->data->content = strip_tags(Flight::request()->data->content);
							Flight::request()->data->content = htmlspecialchars(Flight::request()->data->content);
							$insert = Flight::db()->insert('posts_comments', [
								'content'=>Flight::request()->data->content,
								'post_id'=>Flight::request()->data->post,
								'user_id'=>Flight::user('id')
							]);
							$id=Flight::db()->id();
							if($insert) {
								$from = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'comments'.DIRECTORY_SEPARATOR.Flight::user('id').'.webp';
								if(file_exists($from)) {
									$to = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'comments'.DIRECTORY_SEPARATOR.$id.'.webp';
									rename($from, $to);
								}
								Flight::db()->update('posts', ['comments[+]'=>1, 'lastmod'=>date('Y.m.d H:i:s')], ['id'=>Flight::request()->data->post]);
								$data = ['success'=>true];
							}
						}
					}
				}
			}
		}
		if($data['success'])
			Flight::msg_add('info bg-gradient my-4" id="newComment"', 'Odpowiedź została opublikowana.');
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});