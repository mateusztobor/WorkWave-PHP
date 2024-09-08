<?php
	Flight::map('addUserToGroup', function($user,$group){
		if(
			Flight::db()->has('groups', ['id'=>$group]) &&
			Flight::db()->has('users', ['id'=>$user]) &&
			!Flight::db()->has('groups_users', ['user_id'=>$user, 'group_id'=>$group])
		)
			if(Flight::db()->insert('groups_users', ['user_id'=>$user, 'group_id'=>$group])) {
				Flight::db()->update('groups', ["members[+]" => 1], ['id'=>$group]);
				return true;
			}
		return false;
	});