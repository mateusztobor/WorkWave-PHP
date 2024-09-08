<?php
	Flight::map('deleteSectionDir', function($section_id){
		$dir = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR . $section_id;
		if(is_dir($dir)) {
			$files = glob($dir.DIRECTORY_SEPARATOR.'*'); 
			foreach($files as $file) {
				if(is_file($file))
					unlink($file);
			}
			rmdir($dir);
		}
	});