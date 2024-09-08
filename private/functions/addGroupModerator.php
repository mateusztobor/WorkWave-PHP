<?php
	Flight::map('addGroupModerator', function($user,$group){
		return Flight::db()->update('groups_users', ['moderator'=>1], ['group_id'=>$group, 'user_id'=>$user]);
	});