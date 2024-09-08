<?php
	Flight::map('getTpl', function($tpl) {
		$tpl = dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.$tpl.'.tpl';
		if(file_exists($tpl))
			return file_get_contents($tpl);
		return null;
	});