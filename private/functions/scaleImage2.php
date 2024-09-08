<?php
	Flight::map('scaleImage2', function($sourceImage, $finalWidth = 1920, $finalHeight = 1280) {
		$sourceWidth = imagesx($sourceImage);
		$sourceHeight = imagesy($sourceImage);
		$targetWidth = intval($finalWidth);
		$targetHeight = intval($finalHeight);
		$targetImage = imagecreatetruecolor($targetWidth, $targetHeight);
		imagecopyresampled(
			$targetImage,
			$sourceImage,
			0,
			0,
			0,
			0,
			$targetWidth,
			$targetHeight,
			$sourceWidth,
			$sourceHeight
		);
		return $targetImage;
	});