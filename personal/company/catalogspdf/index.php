<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталоги PDF");
?>

<div class="container-fluid">
	<div class="row">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
    $currentUserId = $USER->GetID();
    $rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
    $arUser = $rsUser->Fetch();

	global $arrFilter;
	$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY']);

	// Каталоги.
	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"companyMaterialList", 
	array(
		"COMPONENT_TEMPLATE" => "companyMaterialList",
		"IBLOCK_TYPE" => "catalogsPdf",
		"IBLOCK_ID" => "22",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FORUM_MESSAGE_CNT",
			2 => "rejected",
			3 => "reasonRejection",
			4 => "file",
			5 => "",
		),
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "/personal/company/catalogspdf/edit/?elementId=#ELEMENT_ID#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => "custom",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DETAIL_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"LIST_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);
}
?>

	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>