<?php
	Flight::route('/grupa-@id:[0-9]+/czlonkowie', function($id){
		$redirect=false;
		$group = Flight::db()->get('groups', ['id', 'name', 'admin'], ['id'=>$id]);
		if($group) {
			$member = Flight::db()->get('groups_users', ['moderator'], ['group_id'=>$id, 'user_id'=>Flight::user('id')]);
			if($member) {
				Flight::render('main', [
					'mod'=>$member['moderator'],
					'admin'=>$group['admin'] == Flight::user('id'),
					'group'=>$group,
					'tpl'=>'group_members',
				]);
			} else
				$redirect=true;
		} else
			$redirect=true;
		if($redirect)
			Flight::redirect('/grupa-'.$id);
	});