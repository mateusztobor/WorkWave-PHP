<?php
	Flight::route('/ajax/getGroupDesc/@group_id:[0-9]+', function($group_id){
		$get = Flight::db()->get('groups', ['description'], ['id'=>$group_id]);
		if($get) {
			Flight::requireFunction('convertTagsToHTML');
			echo !empty($get['description']) ? Flight::convertTagsToHTML($get['description']) : '';
			
		}
	});