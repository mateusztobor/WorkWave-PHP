<?php
	Flight::route('/uzytkownik-@user_id:[0-9]+', function($user_id){
		Flight::requireFunction('checkUserRole');
		require  __DIR__.'/class/profile.class.php';
		$controller = new profile($user_id);
		$controller->view();
	});