<?php
	Flight::route('/grupy', function(){
		require  __DIR__.'/class/groups.class.php';
		$controller = new groups();
		$controller->view();
	});