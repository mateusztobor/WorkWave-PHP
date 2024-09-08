<?php
	Flight::route('/ajax/admin/setPerm/@user:[0-9]+/@what:[0-9]+/@set:[0-9]+', function($user,$what,$set){
		$data = ['success'=>false];
		if($set == 0 || $set == 1) {
			$role = false;
			if($what == 1)
				$role = 'm';
			elseif($what == 2)
				$role = 't';
			elseif($what == 3)
				$role = 'r';
			elseif($what == 4)
				$role = 'a';
			if($role != false) {
				if($set) {
					Flight::requireFunction('addUserRole');
					$data = ['success' => Flight::addUserRole($user, $role)];
				} else {
					Flight::requireFunction('delUserRole');
					$data = ['success' => Flight::delUserRole($user, $role)];
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});