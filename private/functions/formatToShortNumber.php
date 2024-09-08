<?php
	Flight::map('formatToShortNumber', function($input) {
		if($input >= 1000000)
			return number_format($input / 1000000, 1,',').' mln';
		elseif($input >= 1000) {
			return number_format($input / 1000, 1,',').' tys.';
		}
		else
			return $input;
	});