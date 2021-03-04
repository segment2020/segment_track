<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$newsFeedOnMain_settingsList = array( 
	0 => array( 'iBlock__id' => IBLOCK_ID_NEWS_COMPANY, 	'iBlock__limit' => '3', 'csstag'=> 'newscomptag' ), // Новости компании.
	1 => array( 'iBlock__id' => IBLOCK_ID_STOCK, 			'iBlock__limit' => '1', 'csstag'=> 'livetag' ), // Акции.
	2 => array( 'iBlock__id' => IBLOCK_ID_NEWS_INDUSTRY, 	'iBlock__limit' => '2', 'csstag'=> 'newstag' ), // Новости отрасли.
	3 => array( 'iBlock__id' => IBLOCK_ID_ANALYTICS, 		'iBlock__limit' => '2', 'csstag'=> 'newstag' ), // Аналитика.
	4 => array( 'iBlock__id' => IBLOCK_ID_LIFE_INDUSTRY, 	'iBlock__limit' => '2', 'csstag'=> 'newstag' ), // Жизнь отрасли.
	5 => array( 'iBlock__id' => IBLOCK_ID_VIEWPOINT, 		'iBlock__limit' => '2', 'csstag'=> 'livetag' ), // Точка зрения.
	6 => array( 'iBlock__id' => IBLOCK_ID_EVENTS, 			'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // События.
	7 => array( 'iBlock__id' => IBLOCK_ID_PRODUCTS_REVIEW, 	'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // Товарные обзоры.
	8 => array( 'iBlock__id' => IBLOCK_ID_BRANDS, 			'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // Бренды. 
); 

if (isset($_POST['blockId']) && !empty($_POST['blockId']))
// if (true)
{ 
	if ('9999' == $_POST['blockId']) // Всё.
	{
		$newsFeedOnMain_ajaxSettingsList = $newsFeedOnMain_settingsList;  
	}
	else
	{ 
		for ($i = 0; $i <= count($newsFeedOnMain_settingsList); $i++) 
			if ($newsFeedOnMain_settingsList[$i]["iBlock__id"] == $blockId)
				$newsFeedOnMain_ajaxSettingsList = Array( 0 => $newsFeedOnMain_settingsList[$i]);
		$newsFeedOnMain_ajaxSettingsList[0]["iBlock__limit"] = '15'; 
	}
 
	/* здесь основной движ */
	$APPLICATION->IncludeFile('/tpl/include_area/comp_newsFeedOnMain.php', Array( "newsFeed_settingsList" => $newsFeedOnMain_ajaxSettingsList )); 

 
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");