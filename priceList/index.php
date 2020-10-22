<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прайс листы");
?>

	<div class="container-fluid">
		<div class="row row-flex">
			<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
				<div class="row">
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>					
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/defaulters.php', array(), array());?>
				</div>
			</div>
			<div class="col-sm-9 col-xs-12 content-margin">
<? 
$elemNum = 10;
if (isset($_POST['elemNum']) && !empty($_POST['elemNum']))
	$elemNum = $_POST['elemNum'];

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"priceList", 
	array(
		"COMPONENT_TEMPLATE" => "priceList",
		"IBLOCK_TYPE" => "priceList",
		"IBLOCK_ID" => "16",
		"NEWS_COUNT" => $elemNum,
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "file",
			2 => "companyID",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
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
		"INCLUDE_SUBSECTIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
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
		"MESSAGE_404" => ""
	),
	false
);?>
			</div>			
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>