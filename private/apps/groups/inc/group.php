<?php
	Flight::route('/grupa-@group_id:[0-9]+', function($group_id){
		require  __DIR__.'/class/group.class.php';
		$controller = new group($group_id);
		$controller->view();
	});