<?php
	Flight::route('/wpis-@post_id:[0-9]+', function($post_id){
		require  __DIR__.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'post.class.php';
		$controller = new post($post_id);
		$controller->view();
	});