<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 

if (isset($_REQUEST['url']) && filter_var($_REQUEST['url'], FILTER_VALIDATE_URL)) {

	// Extract HTML using curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $_REQUEST['url']);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$data = curl_exec($ch);
	curl_close($ch);

	// Load HTML to DOM Object
	$dom = new DOMDocument();
	@$dom->loadHTML($data);

	// Parse DOM to get Title
	$nodes = $dom->getElementsByTagName('title');
	$title = $nodes->item(0)->nodeValue;

	// Parse DOM to get Meta Description
	$metas = $dom->getElementsByTagName('meta');
	$description = "";
	foreach ($metas as $meta) {
		if (strtolower($meta->getAttribute('name')) == 'description') {
			$description = $meta->getAttribute('content');
		}
	}

	// Parse DOM to get Images
	$image_urls = array();
	$images = $dom->getElementsByTagName('img');

	for ($i = 0; $i < $images->length; $i++) {
		$image = $images->item($i);
		$src = $image->getAttribute('src');

		if (filter_var($src, FILTER_VALIDATE_URL)) {
			$image_src[] = $src;
		}
	}

	header('Content-Type: application/json');

	$responseJson = ['success' => '1', 'meta' => ['title' => $title, 'description' => $description, 'image' =>  ['url' => $image_src]]];

	echo json_encode($responseJson);
} else {
	header('Content-Type: application/json');
	$responseJson = ['success' => '0', 'meta' => ['title' => '', 'description' => 'Ошибка загрузки ссылки.', 'image' =>  ['url' => '']]];
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
