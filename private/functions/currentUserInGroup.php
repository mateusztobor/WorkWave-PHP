<?php
	Flight::map('currentUserInGroup', function($group) {
		return Flight::db()->has('groups_users', ['group_id'=>$group, 'user_id'=>Flight::user('id')]);
	});