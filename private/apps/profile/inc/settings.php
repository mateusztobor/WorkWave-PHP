<?php
	Flight::route('/ustawienia-konta', function(){
		require  __DIR__.'/class/settings.class.php';
		$controller = new settings();
		$controller->view();
	});