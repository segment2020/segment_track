<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("События");
?>
<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('actualtoday', 'photogallery', 'videogallery', 'komments')), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>События</h1>
			<!-- <div class="eventstabs clearfix content-margin">
				<div class="title floatleft">Показать:</div>
				<div class="tab floatleft">	
					<a href="/events/" class="active">Все</a>
				</div>
				<div class="tab floatleft">	
					<a href="/events/futureevents/">Предстоящие</a>
				</div>
				<div class="tab floatleft">	
					<a href="/events/pastevents/">Прошедшие</a>
				</div>
			</div> -->
<?
// Предстоящие события.

	$GLOBALS['arrFilter'] = array('>=PROPERTY_dateEnd' => date('Y-m-d'));
	if (isset($_GET['companyId']) && !empty($_GET['companyId']))
		$GLOBALS['arrFilter'] = array('PROPERTY_companyId' => $_GET['companyId'], '>=PROPERTY_dateEnd' => date('Y-m-d'));

	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"futureEvents", 
	array(
		"COMPONENT_TEMPLATE" => "futureEvents",
		"IBLOCK_TYPE" => "Events",
		"IBLOCK_ID" => "14",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "PROPERTY_dateBegin",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "timeBegin",
			1 => "dateBegin",
			2 => "dateEnd",
			3 => "place",
			4 => "FORUM_MESSAGE_CNT",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/events/futureevents/#ELEMENT_CODE#/",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
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

			<?
			// Прошедшие события.

			$GLOBALS['arrFilter'] = array('<PROPERTY_dateEnd' => date('Y-m-d'));
			if (isset($_GET['companyId']) && !empty($_GET['companyId']))
				$GLOBALS['arrFilter'] = array('PROPERTY_companyId' => $_GET['companyId'], '<PROPERTY_dateEnd' => date('Y-m-d'));

			$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"pastEvents", 
	array(
		"COMPONENT_TEMPLATE" => "pastEvents",
		"IBLOCK_TYPE" => "Events",
		"IBLOCK_ID" => "14",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "PROPERTY_dateBegin",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "timeBegin",
			1 => "dateBegin",
			2 => "dateEnd",
			3 => "place",
			4 => "FORUM_MESSAGE_CNT",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/events/pastevents/#ELEMENT_CODE#/",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
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