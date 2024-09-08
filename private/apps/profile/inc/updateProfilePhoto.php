<?php
	Flight::route('/ajax/updateProfilePhoto', function() {
		$data = array('success' => false);
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
							Flight::requireFunction('scaleImage2');
							$load = Flight::scaleImage2($load, 1024, 1024);
							$dir = dirname(__DIR__, 4).DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.Flight::user('id').'.webp';
							if(imagewebp($load, $dir, 70))
								$data = array('success' => true);
						}
					}
				}
			}
		}
		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});