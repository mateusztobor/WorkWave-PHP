<?php
	Flight::map('scaleImage', function($sourceImage, $maxWidth = 1920, $maxHeight = 1280) {
		$sourceWidth = imagesx($sourceImage);
		$sourceHeight = imagesy($sourceImage);
		if ($sourceWidth > $maxWidth || $sourceHeight > $maxHeight) {
			$aspectRatio = $sourceWidth / $sourceHeight;
			$targetWidth = $maxWidth;
			$targetHeight = $maxHeight;
			if ($aspectRatio > 1)
				$targetHeight = $targetWidth / $aspectRatio;
			else
				$targetWidth = $targetHeight * $aspectRatio;
			$targetWidth = intval($targetWidth);
			$targetHeight = intval($targetHeight);
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
		}
		return $sourceImage;
	});