<?php
	Flight::route('/obserwowane', function(){
		require  __DIR__.'/class/follows.class.php';
		$controller = new follows();
		$controller->view();
	});