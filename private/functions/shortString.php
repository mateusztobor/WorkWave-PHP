<?php
	Flight::map('shortString', function($string,$maxLength) {
		return mb_strlen($string) > $maxLength ? substr($string,0,$maxLength)."..." : $string;
	});