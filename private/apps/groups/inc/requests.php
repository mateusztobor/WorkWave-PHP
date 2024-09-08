<?php
	Flight::route('/grupa-@id:[0-9]+/prosby', function($id){
		$redirect=false;
		$group = Flight::db()->get('groups', ['id', 'name', 'public', 'admin'], ['id'=>$id]);
		if($group) {
			if(!$group['public']) {
				$moderator = Flight::db()->has('groups_users', ['group_id'=>$id, 'user_id'=>Flight::user('id'), 'moderator'=>1]);
				if($moderator || $group['admin'] == Flight::user['id']) {
					Flight::render('main', [
						'group'=>$group,
						'tpl'=>'group_requests',
					]);
				} else
					$redirect=true;
			} else
				$redirect=true;
		} else
			$redirect=true;
		if($redirect)
			Flight::redirect('/grupa-'.$id);
	});