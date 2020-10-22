<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по тегу");
?>
<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin"> 
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/events.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/komments.php', array(), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin"> 
			<div class="row">
<?
	$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"searchTags", 
	array(
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "30",
		"TAGS_URL_SEARCH" => "/search/tagSearch.php",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"USE_SUGGEST" => "Y",
		"SHOW_RATING" => "Y",
		"PATH_TO_USER_PROFILE" => "",
		"AJAX_MODE" => "N",
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "N",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "Y",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "date",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "main",
			1 => "iblock_new",
			2 => "iblock_News",
			3 => "iblock_Stock",
			4 => "iblock_Events",
			5 => "iblock_brands",
			6 => "iblock_Catalog",
			7 => "iblock_Company",
			8 => "iblock_license",
			9 => "iblock_Analytics",
			10 => "iblock_Viewpoint",
			11 => "iblock_priceList",
			12 => "iblock_Defaulters",
			13 => "iblock_Videogallery",
			14 => "iblock_lifeIndustry",
			15 => "iblock_photogallery",
			16 => "iblock_productsReview",
		),
		"SHOW_WHERE" => "Y",
		"arrWHERE" => array(
			0 => "iblock_new",
			1 => "iblock_News",
			2 => "iblock_Stock",
			3 => "iblock_brands",
			4 => "iblock_Catalog",
			5 => "iblock_Viewpoint",
			6 => "iblock_Videogallery",
			7 => "iblock_photogallery",
		),
		"SHOW_WHEN" => "Y",
		"PAGE_RESULT_COUNT" => "50",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "custom",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "searchTags",
		"arrFILTER_iblock_News" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Catalog" => array(
			0 => "all",
		),
		"arrFILTER_main" => array(
		),
		"arrFILTER_iblock_Stock" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Events" => array(
			0 => "all",
		),
		"arrFILTER_iblock_brands" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Company" => array(
			0 => "all",
		),
		"arrFILTER_iblock_license" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Analytics" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Viewpoint" => array(
			0 => "all",
		),
		"arrFILTER_iblock_priceList" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Defaulters" => array(
			0 => "all",
		),
		"arrFILTER_iblock_Videogallery" => array(
			0 => "all",
		),
		"arrFILTER_iblock_lifeIndustry" => array(
			0 => "all",
		),
		"arrFILTER_iblock_photogallery" => array(
			0 => "all",
		),
		"arrFILTER_iblock_productsReview" => array(
			0 => "all",
		),
		"arrFILTER_iblock_new" => array(
			0 => "all",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
?>
			</div> <!-- end div class="row"> -->
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>