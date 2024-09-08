<?php
	Flight::map('deleteNewLines', function($text) {
		return str_replace("\n", "", $text);
	});