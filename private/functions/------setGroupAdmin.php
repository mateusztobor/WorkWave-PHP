<?php
	Flight::map('setGroupAdmin', function($user,$group){
		Flight::db()->update('groups_users', ['admin'=>0], ['group_id'=>$group, 'admin'=>1]);
		Flight::db()->update('groups_users', ['admin'=>1], ['group_id'=>$group, 'user_id'=>$user]);
	});