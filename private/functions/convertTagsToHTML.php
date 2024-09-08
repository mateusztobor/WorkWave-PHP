<?php
	Flight::map('convertTagsToHTML_url', function($text) {
		// Wyrażenie regularne do znalezienia adresów URL w tekście
		$pattern = '/(https?:\/\/[^\s]+)/';

		// Dodaj prefiks "http://" jeśli brakuje dla adresów bez "www" (np. onet.pl)
		$text = preg_replace('/(^|[^\/])([\w\-]+(\.[\w\-]+)+(\b|$))/im', '$1http://$2', $text);

		// Dodaj prefiks "http://" jeśli brakuje dla adresów z "www" (np. www.onet.pl)
		$text = preg_replace('/(^|[^\/])(www\.[\S]+(\b|$))/im', '$1http://$2', $text);

		// Znajdź i zastąp adresy URL tagami HTML, usuwając prefiksy "http://" i "https://"
		$textWithTags = preg_replace_callback($pattern, function($matches) {
			$url = $matches[0];
			$urlWithoutProtocol = preg_replace('/(https?:\/\/)/', '', $url);
			return '<a href="'.$url.'" rel="nofollow">'.$urlWithoutProtocol.'</a>';
		}, $text);

		return $textWithTags;
	});
Flight::map('convertTagsToHTML_text', function($text) {
    $linie = explode("<br>", $text);

    foreach ($linie as &$linia) {
        if (strpos($linia, '#') === 0)
            $linia = '<strong>' . substr($linia, 1) . '</strong>';
		elseif (strpos($linia, '_') === 0)
			$linia = '<span class="text-decoration-underline">' . substr($linia, 1) . '</span>';
    }

    return implode("<br>", $linie);
});

	Flight::map('convertTagsToHTML_newline', function($text) {
		return str_replace("\n", "<br>", $text);
	});
	Flight::map('convertTagsToHTML', function($text) {
		return Flight::convertTagsToHTML_url(
			Flight::convertTagsToHTML_text(
				Flight::convertTagsToHTML_newline(
					$text
				)
			)
		);
	});