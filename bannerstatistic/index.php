<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статистика баннера");
?>

<div class="container-fluid">

<?

$arSelect = Array('ID', 'PROPERTY_companyId', 'DETAIL_PICTURE');
	$filter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_type' => 129, "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $filter, false, array(), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();

		$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"bannersStatistics", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/banners/edit/#ELEMENT_CODE#/",
		"ELEMENT_ID" => $arFields["ID"],
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "SHOW_COUNTER",
			6 => "ACTIVE",
			7 => "",
		),
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "banners",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "displayingArea",
			1 => "link",
			2 => "hostingPage",
			3 => "type",
			4 => "SHOW_COUNTER",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "bannersStatistics",
		"COMPANY_ID" => $arFields["PROPERTY_COMPANYID_VALUE"]
	),
	false
);
	}
?>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>