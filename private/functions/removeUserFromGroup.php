<?php
	Flight::map('removeUserFromGroup', function($user,$group){
		if(Flight::db()->has('groups_users', ['user_id'=>$user, 'group_id'=>$group]))
			if(Flight::db()->delete('groups_users', ['user_id'=>$user, 'group_id'=>$group)) {
				Flight::db()->update('groups', ["members[-]" => 1], ['id'=>$group]);
				return true;
			}
		return false;
	});