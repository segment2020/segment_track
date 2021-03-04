<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новинки компаний");
?>
<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1">
			<div class="row">
				<?	// Разделение на список и детальную...
					if (CSite::InDir('/companynews/index.php'))
						$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('actualtoday', 'defaulters', 'komments', 'photogallery')), array());
					else
						$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('actualtoday', 'defaulters', 'komments', 'top100')), array()); 
				?>
			</div>	
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
<?
// Новинки.
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"newsCustom", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.M.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "TAGS",
			1 => "SHOW_COUNTER",
			2 => "DATE_CREATE",
			3 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "companyId",
			1 => "newsSource",
			2 => "FORUM_MESSAGE_CNT",
			3 => "imgString",
			4 => "FORUM_TOPIC_ID",
			5 => "copmanyId",
			6 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "new",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "j M Y",
		"LIST_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "companyId",
			1 => "newsSource",
			2 => "FORUM_MESSAGE_CNT",
			3 => "imgString",
			4 => "FORUM_TOPIC_ID",
			5 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "custom",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_inTheTop",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "Y",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "newsCustom",
		"SEF_FOLDER" => "/productnews/",
		"MESSAGES_PER_PAGE" => "3",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "20",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"FILTER_NAME" => "companyfilter",
		"FILTER_FIELD_CODE" => array(
			0 => "TAGS",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);
?>

			</div>
		</div> <!-- end div class="row"> -->
	</div> <!-- end div class="container-fluid"> -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
