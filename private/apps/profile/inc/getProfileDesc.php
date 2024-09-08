<?php
	Flight::route('/ajax/getProfileDesc', function(){
		$get = Flight::db()->get('users', ['description'], ['id'=>Flight::user('id')]);
		if($get) {
			Flight::requireFunction('convertTagsToHTML');
			echo Flight::convertTagsToHTML($get['description']);
			
		}
	});