<?php
	Flight::route('/uploads/uploadCourseImage/@section:[0-9]+', function($section_id) {
		$data = ['success' => false];
		$section = Flight::db()->get('courses_sections', ['course_id'], ['id'=>$section_id]);
		if($section) {
			if(Flight::db()->has('courses', ['admin'=>Flight::user('id'), 'id'=>$section['course_id']])) {
				if(isset(Flight::request()->files->imgFile)) {
					if(file_exists(Flight::request()->files->imgFile['tmp_name']) && is_uploaded_file(Flight::request()->files->imgFile['tmp_name'])) {
						if(Flight::request()->files->imgFile['error'] == 0) {
							$file = Flight::request()->files->imgFile;
							$file_ext = explode('.', $file['name']);
							$file_ext_count = count($file_ext);
							if($file_ext_count > 1) {
								$file_ext = $file_ext[$file_ext_count - 1];
								unset($file_ext_count);
								if(in_array($file_ext, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
									$load = file_get_contents($file['tmp_name']);
									$load = imagecreatefromstring($load);
									imagepalettetotruecolor($load);
									if($file_ext == "png") {
										imagealphablending($load, true);
										imagesavealpha($load, true);
									}
									Flight::requireFunction('scaleImage');
									$load = Flight::scaleImage($load);
									$name=time();
									$dir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR . $section_id;
									if(!is_dir($dir))
										mkdir($dir);
									$dir .= DIRECTORY_SEPARATOR . $name . '.webp';
									if(imagewebp($load, $dir, 70)) {
										$src = Flight::getConfig('url') . '/public/img/courses/'. $section_id .'/'.  $name;
										$data = [
											'success' => true,
											'message' => 'uploadSuccess',
											'file' => $src,
											'filename' => $name.'.webp'
										];
									}
								}
							}
						}
					}
				}
			}
		}
		
		

		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});