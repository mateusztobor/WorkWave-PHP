<?php
	Flight::route('/ajax/publicNewPost', function(){
		$data = ['success'=>false];
		if(isset(Flight::request()->data->content) && isset(Flight::request()->data->group)) {
			if((int)Flight::request()->data->group == Flight::request()->data->group) {
				$perm=true;
				if(Flight::request()->data->group!=0) {
					if(!Flight::db()->has('groups_users', ['group_id'=>Flight::request()->data->group, 'user_id'=>Flight::user('id')]))
						$perm=false;
				}
				if($perm) {
					if(mb_strlen(Flight::request()->data->content) > 0 && mb_strlen(Flight::request()->data->content) <= 500) {
						Flight::request()->data->content = strip_tags(Flight::request()->data->content);
						Flight::request()->data->content = htmlspecialchars(Flight::request()->data->content);
						$insert = Flight::db()->insert('posts', [
							'content'=>Flight::request()->data->content,
							'group_id' => (Flight::request()->data->group != '0') ? Flight::request()->data->group : null,
							'user_id'=>Flight::user('id')
						]);
						
						if($insert) {
							$id=Flight::db()->id();
							$from = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.Flight::user('id').'.webp';
							if(file_exists($from)) {
								$to = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$id.'.webp';
								rename($from, $to);
							}
							$url = Flight::getConfig('url').'/'.(Flight::request()->data->group != 0 ? 'grupa-'.Flight::request()->data->group : '').'#newPost';
							$data = ['success'=>true, 'url'=>$url];
							Flight::msg_add('info bg-gradient my-4" id="newPost', 'Wpis został opublikowany.');
						}
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});