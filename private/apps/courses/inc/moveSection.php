<?php
	Flight::route('/ajax/moveCourseSection/@position:[0-9]+/@section_id:[0-9]+', function($position,$section_id) {
		$ok = false;
		if($position==1 || $position==0) {
			$section=Flight::db()->get('courses_sections', ['id', 'course_id', 'section_order'], ['id'=>$section_id]);
			if($section) {
				if(Flight::db()->has('courses', ['id'=>$section['course_id'], 'admin'=>Flight::user('id')])) {
					$max = Flight::db()->max('courses_sections', 'section_order', ['course_id'=>$section['course_id']]);
					//up
					if($position && $section['section_order'] != 1) {
						$newPosition = $section['section_order']-1;
						if(Flight::db()->update('courses_sections', ['section_order'=>$section['section_order']], [
							'course_id'=>$section['course_id'],
							'section_order'=>$newPosition
						]))
							if(Flight::db()->update('courses_sections', ['section_order'=>$newPosition], [
								'id'=>$section['id']
							]))
								$ok=true;
					}
					//down
					elseif(!$position && $section['section_order'] != $max && $max>1) {
						$newPosition = $section['section_order']+1;
						if(Flight::db()->update('courses_sections', ['section_order'=>$section['section_order']], [
							'course_id'=>$section['course_id'],
							'section_order'=>$newPosition
						]))
							if(Flight::db()->update('courses_sections', ['section_order'=>$newPosition], [
								'id'=>$section['id']
							]))
								$ok=true;
					}
				}
			}
		}
		echo json_encode(['success'=>$ok],JSON_UNESCAPED_SLASHES);
	});