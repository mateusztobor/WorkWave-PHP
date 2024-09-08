<?php
	Flight::map('currentUserRequestGroup', function($group) {
		return Flight::db()->has('groups_requests', ['group_id'=>$group, 'user_id'=>Flight::user('id')]);
	});