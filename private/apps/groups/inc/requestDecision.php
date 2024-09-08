<?php
	Flight::route('/ajax/groupRequestDecision/@group:[0-9]+/@user:[0-9]+/@decision:[0-9]+', function($group,$user,$decision) {
		$data = ['success'=>false];
		if($decision == 1 || $decision == 0) {
			$mod = Flight::db()->has('groups_users', ['group_id'=>$group, 'user_id'=>Flight::user('id'), 'moderator'=>1]);
			$admin = Flight::db()->has('groups', ['id'=>$group, 'admin'=>Flight::user('id')]);
			if($mod || $admin) {
				$err=false;
				if($decision==1) {
					Flight::requireFunction('addUserToGroup');
					$err = !Flight::addUserToGroup($user,$group);
				}
				if(!$err)
					Flight::db()->delete('groups_requests', ['group_id'=>$group, 'user_id'=>$user]);
				$data = ['success'=>!$err];
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});