<?php
	$curl = curl_init();

	if ($curl) {
		curl_setopt($curl, CURLOPT_URL, 'http://auction');
		$output  = curl_exec($curl);
		curl_close($curl);
	}