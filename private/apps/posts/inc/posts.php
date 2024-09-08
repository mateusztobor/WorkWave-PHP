<?php
	Flight::route('/', function(){
		require  __DIR__.'/class/posts.class.php';
		$controller = new posts();
		$controller->view();
	});