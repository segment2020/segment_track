<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список лицензий");
?>

<div class="container-fluid">
		<div class="row">
			<div class="col-xs-3">
				<div class="row">
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/new-members.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>					
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>						
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/viewpoint.php', array(), array());?>				
				</div>					
			</div>
			<div class="col-xs-9 content-margin">
<?
global $arFilter;

if (isset($_GET['firstLetter']) && !empty($_GET['firstLetter']))
	$name = $_GET['firstLetter'];

if (isset($name) && !empty($name))
	$arFilter["NAME"] = $name . "%";

//pre($arFilter);

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"brandsList", 
	array(
		"COMPONENT_TEMPLATE" => "brandsList",
		"IBLOCK_TYPE" => "license",
		"IBLOCK_ID" => IBLOCK_ID_LICENSE,
		"NEWS_COUNT" => "500",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FORUM_MESSAGE_CNT",
			2 => "contactPerson",
			3 => "placeInRating",
			4 => "timeBegin",
			5 => "dateBegin",
			6 => "city",
			7 => "country",
			8 => "companyId",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/license/#SECTION_CODE#/#ELEMENT_CODE#/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
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
?>

			</div>
		</div>
	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>