<? 
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/events/futureevents/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/events/futureevents/index.php",
	),
	array(
		"CONDITION" => "#^/users/(.*).html(.*)#",
		"RULE" => "/users/index.php?USER_ID=\\1",
		"ID" => "",
		"PATH" => "",
	),
	array(
		"CONDITION" => "#^/events/pastevents/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/events/pastevents/index.php",
	),
	array(
		"CONDITION" => "#^/productsreviews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/productsreviews/index.php",
	),
	array(
		"CONDITION" => "#^/productnews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/productnews/index.php",
	),
	array(
		"CONDITION" => "#^/videogallery/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/photovideo/videogallery/index.php",
	),
	array(
		"CONDITION" => "#^/lifeIndustry/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/lifeIndustry/index.php",
	),
	array(
		"CONDITION" => "#^/industrynews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/industrynews/index.php",
	),
	array(
		"CONDITION" => "#^/photogallery/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/photovideo/photogallery/index.php",
	),
	array(
		"CONDITION" => "#^/catalogspdf/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/catalogspdf/index.php",
	),
	array(
		"CONDITION" => "#^/companynews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/companynews/index.php",
	),
	array(
		"CONDITION" => "#^/defaulters/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/defaulters/index.php",
	),
	array(
		"CONDITION" => "#^/analytics/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/analytics/index.php",
	),
	array(
		"CONDITION" => "#^/viewpoint/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/viewpoint/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/company/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/company/index.php",
	),
	array(
		"CONDITION" => "#^/license/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/license/index.php",
	),
	array(
		"CONDITION" => "#^/brands/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/brands/index.php",
	),
	array(
		"CONDITION" => "#^/stock/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/stock/index.php",
	), 
);

?>