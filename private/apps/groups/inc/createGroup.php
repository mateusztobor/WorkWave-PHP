<?php
	Flight::route('/createGroup', function() {
		$ok=0;
		if(isset(Flight::request()->data->groupName) && isset(Flight::request()->data->groupPublic)) {
			if(mb_strlen(Flight::request()->data->groupName) > 0 && mb_strlen(Flight::request()->data->groupName) <= 50) {
				if(Flight::request()->data->groupPublic == 0 || Flight::request()->data->groupPublic == 1) {
					Flight::requireFunction('addUserToGroup');
					Flight::db()->insert('groups', [
						'name'=>htmlspecialchars(Flight::request()->data->groupName),
						'public'=>Flight::request()->data->groupPublic,
						'admin'=>Flight::user('id')
					]);
					$newGroup = Flight::db()->id();
					Flight::addUserToGroup(Flight::user('id'), $newGroup);
					Flight::db()->update('groups_users', ['moderator'=>1], ['group_id'=>$newGroup, 'user_id'=>Flight::user('id')]);
					$ok=1;
				}
			}
		}
		Flight::redirect($ok ? '/grupa-'.$newGroup : '/grupy');
		unset($newGroup);
	});