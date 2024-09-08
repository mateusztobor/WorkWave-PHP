<?php
	Flight::map('formatDateTime2', function($date){
		return date('d.m.Y H:i',strtotime($date));
	});