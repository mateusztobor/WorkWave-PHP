<?php
	Flight::map('howTimeAgo', function($date){
		$seconds_ago = (time() - strtotime($date));

		if ($seconds_ago >= 31536000) {
			$years = intval($seconds_ago / 31536000);
			if($years == 1)
				return 'Rok temu';
			elseif($years >= 2 && $years <= 4)
				return $years.' lata temu';
			else
				return $years.' lat temu';
		} elseif ($seconds_ago >= 2419200) {
			$months = intval($seconds_ago / 2419200);
			if($months == 1)
				return 'Miesiąc temu';
			elseif($months >= 2 && $months <= 4) 
				return $months.' miesiące temu';
			else
				return $months.' miesięcy temu';
		} elseif ($seconds_ago >= 86400) {
			$days = intval($seconds_ago / 86400);
			if($days == 1)
				return 'Wczoraj';
			else
				return  $days.' dni temu';
		} elseif ($seconds_ago >= 3600) {
			$hours = intval($seconds_ago / 3600);
			if($hours == 1)
				return 'godzinę temu';
			elseif($hours >= 2 && $hours <= 4)
				return $hours.' godziny temu';
			else
				return  $hours.' godzin temu';
		} elseif ($seconds_ago >= 60) {
			$minutes = intval($seconds_ago / 60);
			if($minutes == 1)
				return 'minutę temu';
			elseif($minutes >= 2 && $minutes <= 4)
				return $minutes.' minuty temu';
			else
				return $minutes.' minut temu';
		} else {
			echo "Przed chwilą";
		}
	});