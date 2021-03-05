<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Специализированный B2B портал для специалистов канцелярского рынка. База данных производителей и поставщиков канцелярских, офисных и бумажно-беловых товаров, периодических изданий с канцелярской тематикой.");
$APPLICATION->SetPageProperty("title", "Сегмент - первый канцелярский портал");
$APPLICATION->SetTitle("Главная");

$newsFeedOnMain_settingsList = array(
	0 => array( 'iBlock__id' => IBLOCK_ID_NEWS_COMPANY, 	'iBlock__limit' => '3', 'csstag'=> 'newscomptag' ), // Новости компании.
	1 => array( 'iBlock__id' => IBLOCK_ID_STOCK, 			'iBlock__limit' => '1', 'csstag'=> 'livetag' ), 	// Акции.
	2 => array( 'iBlock__id' => IBLOCK_ID_NEWS_INDUSTRY, 	'iBlock__limit' => '2', 'csstag'=> 'newstag' ), 	// Новости отрасли.
	3 => array( 'iBlock__id' => IBLOCK_ID_ANALYTICS, 		'iBlock__limit' => '2', 'csstag'=> 'newstag' ), 	// Аналитика.
	4 => array( 'iBlock__id' => IBLOCK_ID_LIFE_INDUSTRY, 	'iBlock__limit' => '2', 'csstag'=> 'newstag' ), 	// Жизнь отрасли.
	5 => array( 'iBlock__id' => IBLOCK_ID_VIEWPOINT, 		'iBlock__limit' => '2', 'csstag'=> 'livetag' ), 	// Точка зрения.
	6 => array( 'iBlock__id' => IBLOCK_ID_EVENTS, 			'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // События.
	7 => array( 'iBlock__id' => IBLOCK_ID_PRODUCTS_REVIEW, 	'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // Товарные обзоры.
	8 => array( 'iBlock__id' => IBLOCK_ID_BRANDS, 			'iBlock__limit' => '2', 'csstag'=> 'newscomptag' ), // Бренды. 
); 

// ratingCalc();
$hostingPage = 90; // 0 - главная страница.
$bannersArray = array();

$arSelect = Array('ID', "PROPERTY_companyId", 'PROPERTY_type', "PROPERTY_htmlCode", 'PROPERTY_displayingArea', 'PROPERTY_flash', 'PREVIEW_PICTURE', 'DETAIL_PICTURE');
$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_hostingPage' => $hostingPage, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, array(), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	if (!empty($arFields["PROPERTY_FLASH_VALUE"]))
		$file['src'] = CFile::GetPath($arFields["PROPERTY_FLASH_VALUE"]);
	else
		$file['src'] = '';

	if (!empty($arFields["DETAIL_PICTURE"]))
		$fileDet = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=>310, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$fileDet['src'] = '';

	$arFields['filesrc'] = $file['src'];
	$arFields['fileDetSrc'] = $fileDet['src'];
	$bannersArray[$arFields['PROPERTY_DISPLAYINGAREA_ENUM_ID']] = $arFields;
	// pre($arFields);
}
?><div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12 content-margin">	
					<div class="block-shadow mainsliderblock">
						<?
						// Актуальное сегодня.
						$GLOBALS['arrFilter'] = array("!PROPERTY_TOINDEX" => false, 'PROPERTY_actualToday_VALUE' => '1');
						$APPLICATION->IncludeComponent("bitrix:news.index", "actualTodayOnMain", Array(
							"IBLOCKS" => array(	// Код информационного блока
									0 => "1",
									1 => "2",
									2 => "4",
									3 => "5",
									4 => "8",
									5 => "9",
									6 => "10",
									7 => "14",
									8 => "15",
									9 => "17",
								),
								"NEWS_COUNT" => "2",	// Количество новостей в каждом блоке
								"IBLOCK_SORT_BY" => "ID",	// Поле для сортировки информационных блоков
								"IBLOCK_SORT_ORDER" => "ASC",	// Направление для сортировки информационных блоков
								"SORT_BY1" => "ID",	// Поле для первой сортировки новостей
								"SORT_ORDER1" => "RAND",	// Направление для первой сортировки новостей
								"FIELD_CODE" => array(	// Поля
									0 => "DATE_CREATE",
									1 => "",
								),
								"PROPERTY_CODE" => array(	// Свойства
									0 => "",
									1 => "TOINDEX",
									2 => "actualToday",
									3 => "DATE_CREATE",
								),
								"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
								"IBLOCK_URL" => "",	// URL, ведущий на страницу с содержимым раздела
								"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
								"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
								"CACHE_TYPE" => "A",	// Тип кеширования
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"COMPONENT_TEMPLATE" => "actualTodayOnMain",
								"IBLOCK_TYPE" => "khayr",	// Тип информационных блоков
								"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
								"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
							),
							false
						);
						?>
					</div>
				</div>
				<!-- // Новое на сайте (отображается на мобильной версии) -->
				<div class="col-xs-12 content-margin visible-xs">
					<div class="block-default newsblock mainblock block-shadow ">
						<div class="news-block-title clearfix">
							<div class="floatleft newstext">
								<a href='/recentpublications/' class=''>Новое на сайте</a>
							</div>
							<div class="floatright newsselect">
								<span style="padding: 0px 5px;">Показать</span>
								<select class="selectpicker selectboxbtn newsblockbtn" id='newOnSite'>
									<option value='9999'>всё</option>
									<option value='<? echo IBLOCK_ID_NEWS_COMPANY; ?>'>все новости компании</option>
									<option value='<? echo IBLOCK_ID_NEWS_INDUSTRY; ?>'>все новости отрасли</option>
									<option value='<? echo IBLOCK_ID_LIFE_INDUSTRY; ?>'>всю жизнь отрасли</option>
								</select>
							</div>
						</div>
						<div class="news-block-scroll segmentscroll" id='scrollBlock2'>
						<?
							$GLOBALS['arrFilter'] = array("!PROPERTY_TOINDEX" => false);
							// Список ID инфоблоков для вывода
							
							$APPLICATION->IncludeFile('/tpl/include_area/comp_newsFeedOnMain.php', Array( "newsFeed_settingsList" => $newsFeedOnMain_settingsList )); ?>
						</div>
					</div>
				</div>
				
				<div class="col-sm-6 col-xs-6 cell-12-xs content-margin double-banners">
					<div id='<? echo $bannersArray[DA_MAIN_1]['ID']; ?>' class='bannerClick'>
<?
						if ('html' == $bannersArray[DA_MAIN_1]['PROPERTY_TYPE_VALUE']) {
							echo $bannersArray[DA_MAIN_1]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
						} else {
							if (empty($bannersArray[DA_MAIN_1]['filesrc'])) { ?>
								<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_1]['fileDetSrc']; ?>");'>
								</div>
<?
							} else {
								$ext = substr(strrchr($bannersArray[DA_MAIN_1]['filesrc'], '.'), 1);
								if ('swf' == $ext) {
?>
								<div class="infoblock mainBanner">
									<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_1]['filesrc']; ?>" width="310" height="80">
										<param name="move" value="<? echo $bannersArray[DA_MAIN_1]['filesrc']; ?>">
									</object>
								</div>
<?								}
								else {
?>
									<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_1]['filesrc']; ?>");'>
									</div>
									<?
								}
							}
						}

						if (isset($bannersArray[DA_MAIN_1]['ID']))
						{
							// viewsinc($bannersArray[DA_MAIN_1]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_1]['PROPERTY_COMPANYID_VALUE']);
						}
		?>
					</div>
				</div>
				<div class="col-sm-6 col-xs-6 cell-12-xs content-margin double-banners">
					<div id='<? echo $bannersArray[DA_MAIN_2]['ID']; ?>' class='bannerClick'>
		<?
						if ('html' == $bannersArray[DA_MAIN_2]['PROPERTY_TYPE_VALUE']) {
							echo $bannersArray[DA_MAIN_2]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
						} else {
							if (empty($bannersArray[DA_MAIN_2]['filesrc'])) { ?>
								<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_2]['fileDetSrc']; ?>");'>
								</div>
<?								
							} else {
								$ext = substr(strrchr($bannersArray[DA_MAIN_2]['filesrc'], '.'), 1);
								if ('swf' == $ext) {
?>
									<div class="infoblock mainBanner">
										<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_2]['filesrc']; ?>" width="310" height="80">
											<param name="move" value="<? echo $bannersArray[DA_MAIN_2]['filesrc']; ?>">
										</object>
									</div>
<?								}
								else {
?>
									<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_2]['filesrc']; ?>");'>
									</div>
									<?
								}
							}
						}

						if (isset($bannersArray[DA_MAIN_2]['ID']))
						{
							// viewsinc($bannersArray[DA_MAIN_2]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_2]['PROPERTY_COMPANYID_VALUE']);
						}
			?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs">
			<div class="block-default newblock mainblock block-shadow">
				<div class="block-title titleline-thik">
					<i class="icon-icons_main-07"></i><a class="notitlestyle" href="/productnews/">Новинки</a>
				</div>
<?
// Новинки.
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"novelty", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SITE_DIR#/productnews/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "new",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "showLogo",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_inTheTop",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "novelty"
	),
	false
);
/*
$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"topOnMain", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "5",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Catalog",
		"LINE_ELEMENT_COUNT" => "5",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"OFFERS_LIMIT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "rub",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "SECTION",
		"COMPONENT_TEMPLATE" => "topOnMain",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"MESS_BTN_COMPARE" => "Сравнить",
		"TEST_FILD" => "test_data",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"COMPATIBLE_MODE" => "Y"
	),
	false
);
*/
?>
				<div class="text-center buttonblock">
					<a class="btn btn-blue" href="/productnews/">Все новинки<i class="icon-icons_main-10"></i></a>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs">
			<div class="row">
				<div class="col-xs-12 content-margin">
					<div class="block-default hitsblock block-shadow">
						<div class="block-title titleline-thik">
							<i class="icon-icons_main-06"></i><a class="notitlestyle" href="/hits/">Хиты</a>
						</div>
						<div class="hitsbxslider">
<?
// Хиты.
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"hitsOnMain", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:3:209\",\"DATA\":{\"logic\":\"Equal\",\"value\":54}}]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "RAND",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "rub",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'4','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "brand",
			1 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "hitsOnMain",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N"
	),
	false
);

/*
$GLOBALS['affFilter'] = array('PROPERTY_hit_VALUE' => 'Y');

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"hitsOnMain", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "affFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "hit",
			1 => "brand",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "hitsOnMain"
	),
	false
);
*/
?>
						</div>
						<div class="text-center">
							<a class="btn btn-blue" href="/hits/">Все хиты<i class="icon-icons_main-10"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 content-margin">
					<div id='<? echo $bannersArray[DA_MAIN_3]['ID']; ?>' class='bannerClick'>
<?
						if ('html' == $bannersArray[DA_MAIN_3]['PROPERTY_TYPE_VALUE']) {
							echo $bannersArray[DA_MAIN_3]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
						} else {
							if (empty($bannersArray[DA_MAIN_3]['filesrc'])) { ?>
								<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_3]['fileDetSrc']; ?>");'>
								</div>
<?								
							} else {
								$ext = substr(strrchr($bannersArray[DA_MAIN_3]['filesrc'], '.'), 1);
								if ('swf' == $ext) {
?>
									<div class="infoblock">
										<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_3]['filesrc']; ?>" width="310" height="80">
											<param name="move" value="<? echo $bannersArray[DA_MAIN_3]['filesrc']; ?>">
										</object>
									</div>
<?								}
								else {
?>
									<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_3]['filesrc']; ?>");'>
									</div>
<?
								}
							}
						}

						if (isset($bannersArray[DA_MAIN_3]['ID']))
						{
							// viewsinc($bannersArray[DA_MAIN_3]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_3]['PROPERTY_COMPANYID_VALUE']);
						}
?>
					</div>
				</div>
			</div>
		</div>

		<!-- // Новое на сайте. (Отображается на десктоп) -->
		<div class="col-sm-6 col-xs-12 content-margin hidden-xs">
			<div class="block-default newsblock mainblock block-shadow ">
				<div class="news-block-title clearfix">
					<div class="floatleft newstext">
						<a href='/recentpublications/' class=''>Новое на сайте</a>
					</div>
					<div class="floatright newsselect">
						<span style="padding: 0px 5px;">Показать</span>
						<select class="selectpicker selectboxbtn newsblockbtn" id='newOnSite'>
							<option value='9999'>всё</option>
							<option value='<? echo IBLOCK_ID_NEWS_COMPANY; ?>'>все новости компании</option>
							<option value='<? echo IBLOCK_ID_NEWS_INDUSTRY; ?>'>все новости отрасли</option>
							<option value='<? echo IBLOCK_ID_LIFE_INDUSTRY; ?>'>всю жизнь отрасли</option>
						</select>
					</div>
				</div>
				<div class="news-block-scroll segmentscroll" id='scrollBlock1'>
				<?
					$GLOBALS['arrFilter'] = array("!PROPERTY_TOINDEX" => false);
					$APPLICATION->IncludeFile('/tpl/include_area/comp_newsFeedOnMain.php', Array( "newsFeed_settingsList" => $newsFeedOnMain_settingsList )); ?>
				</div>
			</div> <!-- end div class="block-default newsblock mainblock block-shadow"> -->
		</div> <!-- end div class="col-sm-6 col-xs-12 content-margin"> -->  
		
		<div class="col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12 content-margin">
					<div class="block-default block-default-images goodsrewsblock block-shadow">
						<?
						// Товарные обзоры
						$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"productsReviewOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "productsReviewOnMain",
		"IBLOCK_TYPE" => "productsReview",
		"IBLOCK_ID" => "15",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FORUM_MESSAGE_CNT",
			2 => "companyId",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/productsreviews/#ELEMENT_CODE#/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
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
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товарные обзоры",
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
                
                <!-- // Акции - замена на события -->
				<div class="col-xs-12 content-margin">
					<div class="block-default eventsblock mainblock block-shadow">
			
                    <?

$GLOBALS['arrFilterEvents'] = array('>=PROPERTY_dateEnd' => date('Y-m-d'));
if (isset($_GET['companyId']) && !empty($_GET['companyId']))
    $GLOBALS['arrFilterEvents'] = array('PROPERTY_companyId' => $_GET['companyId'], '>=PROPERTY_dateEnd' => date('Y-m-d'));

            // События.
            $APPLICATION->IncludeComponent(
"bitrix:news.list", 
"eventsOnMain", 
array(
    "COMPONENT_TEMPLATE" => "eventsOnMain",
    "IBLOCK_TYPE" => "Events",
    "IBLOCK_ID" => "14",
    "NEWS_COUNT" => "4",
    "SORT_BY1" => "PROPERTY_dateBegin",
    "SORT_ORDER1" => "ASC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "arrFilterEvents",
    "FIELD_CODE" => array(
        0 => "CODE",
        1 => "",
    ),
    "PROPERTY_CODE" => array(
        0 => "dateBegin",
        1 => "FORUM_MESSAGE_CNT",
        2 => "",
    ),
    "CHECK_DATES" => "Y",
    "DETAIL_URL" => "/events/#ELEMENT_CODE#/",
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
    "STRICT_SECTION_CHECK" => "N",
    "COMPOSITE_FRAME_MODE" => "A",
    "COMPOSITE_FRAME_TYPE" => "AUTO"
),
false
);
            ?>
					</div> <!-- end div class="block-default stocksblock mainblock block-shadow"> -->
				</div>
				<div class="col-xs-12 content-margin">
					<div class="block-default catalogblock mainblock block-shadow">
<?
// Каталоги.
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"catalogsPdfOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "catalogsPdfOnMain",
		"IBLOCK_TYPE" => "catalogsPdf",
		"IBLOCK_ID" => "22",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilterBrandsOnMain",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "country",
			1 => "FORUM_MESSAGE_CNT",
			2 => "companyId",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/catalogspdf/#ELEMENT_CODE#/",
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
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Каталоги",
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
				<div class="col-xs-12 content-margin">
					<div class="block-default brandblock mainblock block-shadow">
<?
						// Бренды
						$count = CIBlockElement::GetList(
							array(),
							array('IBLOCK_ID' => IBLOCK_ID_BRANDS, 'PROPERTY_paidOption_VALUE' => '1'),
							array(),
							false,
							array('ID', 'NAME')
							); 

						if ($count >= 2)
						{
							global $arrFilterBrandsOnMain;
							$arrFilterBrandsOnMain['PROPERTY_paidOption_VALUE'] = '1';
						}

						$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"brands", 
	array(
		"COMPONENT_TEMPLATE" => "brands",
		"IBLOCK_TYPE" => "brands",
		"IBLOCK_ID" => "17",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "RAND",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilterBrandsOnMain",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "FORUM_MESSAGE_CNT",
			1 => "companyId",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/brands/#ELEMENT_CODE#/",
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
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Бренды",
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
		</div>
<?
		if (isset($bannersArray[DA_MAIN_4]['ID']) || isset($bannersArray[DA_MAIN_5]['ID']) || isset($bannersArray[DA_MAIN_6]['ID']) || isset($bannersArray[DA_MAIN_7]['ID']))
		{
?>
		<div class="col-xs-3 content-margin">
			<div id='<? echo $bannersArray[DA_MAIN_4]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_4]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_4]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_4]['filesrc'])) { ?>
						<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_4]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_4]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_4]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_4]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_4]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_4]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_4]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_4]['PROPERTY_COMPANYID_VALUE']);
				}
?>
			</div>
		</div>
		<div class="col-xs-3 content-margin">
			<div id='<? echo $bannersArray[DA_MAIN_5]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_5]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_5]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_5]['filesrc'])) { ?>
						<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_5]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_5]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_5]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_5]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_5]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_5]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_5]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_5]['PROPERTY_COMPANYID_VALUE']);
				}
?>
			</div>
		</div>
		<div class="col-xs-3 content-margin">
			<div id='<? echo $bannersArray[DA_MAIN_6]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_6]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_6]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_6]['filesrc'])) { ?>
						<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_6]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_6]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_6]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_6]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_6]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_6]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_6]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_6]['PROPERTY_COMPANYID_VALUE']);
				}
?>
			</div>
		</div>
		<div class="col-xs-3 content-margin">
			<div id='<? echo $bannersArray[DA_MAIN_7]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_7]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_7]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				}
				else {
					if (empty($bannersArray[DA_MAIN_7]['filesrc'])) { ?>
						<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_7]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_7]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_7]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_7]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[DA_MAIN_7]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_7]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_7]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_7]['PROPERTY_COMPANYID_VALUE']);
				}
?>
			</div>
		</div>
<?		} // end if (isset($bannersArray[DA_MAIN_4]['ID']) || isset($bannersArray[DA_MAIN_5]['ID']) || isset($bannersArray[DA_MAIN_6]['ID']) || isset($bannersArray[DA_MAIN_7]['ID']))
?>
		<div class="col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12 content-margin">
					<div class="block-default topblock block-shadow">
						<div class="block-title nobmarrgin clearfix">
							<a class="notitlestyle" href="/top100/">Топ 100</a><a class="floatright" href="/top100/">Весь топ-100<i class="icon-icons_main-10"></i></a>
						</div>
						<div class="row row-xs-flex">
							<?
							$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"top100OnMain", 
	array(
		"COMPONENT_TEMPLATE" => "top100OnMain",
		"IBLOCK_TYPE" => "Company",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "property_rating",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "property_rating",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "rating",
			1 => "FORUM_MESSAGE_CNT",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/company/#SECTION_CODE#/#ELEMENT_CODE#/",
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
				<div class="col-xs-12">
					<div class="row">
						<div class="col-sm-6 col-xs-12 content-margin">
							<div class="block-default block-default-images lifeblock mainblock block-shadow">
								<?	// Жизнь отрасли
								$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"analyticsOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "analyticsOnMain",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "9",
		"NEWS_COUNT" => "1",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FORUM_MESSAGE_CNT",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/lifeIndustry/#ELEMENT_CODE#/",
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
		"ACTIVE_DATE_FORMAT" => "j M Y",
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
						<div class="col-sm-6 col-xs-12 content-margin">
							<div class="block-default block-default-images lifeblock mainblock block-shadow">
								<?	// Аналитика
								$APPLICATION->IncludeComponent(
									"bitrix:news.list", 
									"analyticsOnMain", 
									array(
										"COMPONENT_TEMPLATE" => "analyticsOnMain",
										"IBLOCK_TYPE" => "-",
										"IBLOCK_ID" => "8",
										"NEWS_COUNT" => "1",
										"SORT_BY1" => "ACTIVE_FROM",
										"SORT_ORDER1" => "DESC",
										"SORT_BY2" => "SORT",
										"SORT_ORDER2" => "ASC",
										"FILTER_NAME" => "",
										"FIELD_CODE" => array(
											0 => "SHOW_COUNTER",
											1 => "DATE_CREATE",
											2 => "",
										),
										"PROPERTY_CODE" => array(
											0 => "",
											1 => "FORUM_MESSAGE_CNT",
											2 => "",
										),
										"CHECK_DATES" => "Y",
										"DETAIL_URL" => "/analytics/#ELEMENT_CODE#/",
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
										"ACTIVE_DATE_FORMAT" => "j M Y",
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
										"PAGER_TEMPLATE" => ".default",
										"DISPLAY_TOP_PAGER" => "N",
										"DISPLAY_BOTTOM_PAGER" => "Y",
										"PAGER_TITLE" => "Аналитика",
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
				</div>
				<div class="col-xs-12">
					<div class="row">
						<div class="col-sm-6 col-xs-12 content-margin double-banners">
							<div id='<? echo $bannersArray[DA_MAIN_8]['ID']; ?>' class='bannerClick'>
				<?
								if ('html' == $bannersArray[DA_MAIN_8]['PROPERTY_TYPE_VALUE']) {
									echo $bannersArray[DA_MAIN_8]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
								} else {
									if (empty($bannersArray[DA_MAIN_8]['filesrc'])) { ?>
										<div class="infoblock infoblock60" style='background-image: url("<? echo $bannersArray[DA_MAIN_8]['fileDetSrc']; ?>");'>
										</div>
				<?
									} else {
										$ext = substr(strrchr($bannersArray[DA_MAIN_8]['filesrc'], '.'), 1);
										if ('swf' == $ext) {
				?>
											<div class="infoblock infoblock60 mainBanner">
												<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_8]['filesrc']; ?>" width="310" height="80">
													<param name="move" value="<? echo $bannersArray[DA_MAIN_8]['filesrc']; ?>">
												</object>
											</div>
				<?						}
										else {
											?>
											<div class="infoblock infoblock60" style='background-image: url("<? echo $bannersArray[DA_MAIN_8]['filesrc']; ?>");'>
											</div>
											<?
										}
									}
								}

								if (isset($bannersArray[DA_MAIN_8]['ID']))
								{
									// viewsinc($bannersArray[DA_MAIN_8]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_8]['PROPERTY_COMPANYID_VALUE']);
								}
				?>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12 content-margin double-banners">
							<div id='<? echo $bannersArray[DA_MAIN_9]['ID']; ?>' class='bannerClick'>
				<?
								if ('html' == $bannersArray[DA_MAIN_9]['PROPERTY_TYPE_VALUE']) {
									echo $bannersArray[DA_MAIN_9]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
								} else {
									if (empty($bannersArray[DA_MAIN_9]['filesrc'])) { ?>
										<div class="infoblock infoblock60" style='background-image: url("<? echo $bannersArray[DA_MAIN_9]['fileDetSrc']; ?>");'>
										</div>
				<?
									} else {
										$ext = substr(strrchr($bannersArray[DA_MAIN_9]['filesrc'], '.'), 1);
										if ('swf' == $ext) {
				?>
											<div class="infoblock infoblock60 mainBanner">
												<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_9]['filesrc']; ?>" width="310" height="80">
													<param name="move" value="<? echo $bannersArray[DA_MAIN_9]['filesrc']; ?>">
												</object>
											</div>
				<?						}
										else {
											?>
											<div class="infoblock infoblock60" style='background-image: url("<? echo $bannersArray[DA_MAIN_9]['filesrc']; ?>");'>
											</div>
											<?
										}
									}
								}

								if (isset($bannersArray[DA_MAIN_9]['ID']))
								{
									// viewsinc($bannersArray[DA_MAIN_9]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_9]['PROPERTY_COMPANYID_VALUE']);
								}
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs">
			<div class="block-default content-margin compnewsblock main block-shadow">
<?	// Новости компаний 
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"newsListOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "newsListOnMain",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "PROPERTY_inTheTop",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "FORUM_MESSAGE_CNT",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "FORUM_MESSAGE_CNT",
			1 => "showLogo",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/companynews/#ELEMENT_CODE#/",
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
			1 => "FORUM_MESSAGE_CNT",
		),
		"LIST_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "FORUM_MESSAGE_CNT",
		),
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
			?>
			</div>
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs">
			<div class="block-default content-margin compnewsblock main block-shadow">
			<?
			// Новости отрасли
			$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"newsListOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "newsListOnMain",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FORUM_MESSAGE_CNT",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/industrynews/#ELEMENT_CODE#/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
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
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
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
        
        <!-- // События - замена на Акции -->
		<div class="col-sm-3 col-xs-6 cell-12-xs content-margin actionblock">
			<div class="block-default defaulterblock mainblock block-shadow">

 
			<?
						// Акции
						$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"stockOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "stockOnMain",
		"IBLOCK_TYPE" => "Stock",
		"IBLOCK_ID" => "4",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "PROPERTY_inTheTop",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "CREATED",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "FORUM_MESSAGE_CNT",
			1 => "companyId",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/stock/#ELEMENT_CODE#/",
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
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Акции",
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
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
                        ?>
                        
			</div>
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs content-margin">
			<div class="block-default defaulterblock mainblock block-shadow">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:news.list", 
						"defaultersOnMain", 
						array(
							"COMPONENT_TEMPLATE" => "defaultersOnMain",
							"IBLOCK_TYPE" => "-",
							"IBLOCK_ID" => "6",
							"NEWS_COUNT" => "2",
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
								1 => "FORUM_MESSAGE_CNT",
								2 => "",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "/defaulters/#ELEMENT_CODE#/",
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
							)
						),
						false
					);
					?>
			</div> <!-- end div class="block-default defaulterblock mainblock block-shadow"> -->
		</div>
		<div class="col-sm-3 col-xs-6 cell-12-xs content-margin">
			<div class="block-default opinionblock mainblock block-shadow text-center">
<?
					// Мнение
					$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"viewpoint", 
	array(
		"COMPONENT_TEMPLATE" => "viewpoint",
		"IBLOCK_TYPE" => "Viewpoint",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "1",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "FORUM_MESSAGE_CNT",
			1 => "companyId",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/viewpoint/#ELEMENT_CODE#/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j M Y",
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
		<!-- Комментарии. -->
		<div class="col-sm-3 col-xs-6 cell-12-xs content-margin">
			<? $APPLICATION->IncludeFile('/tpl/include_area/comments.php', array(), array()); ?>
		</div>
<?
		if (isset($bannersArray[DA_MAIN_10]['ID']) || isset($bannersArray[DA_MAIN_11]['ID']) || isset($bannersArray[DA_MAIN_12]['ID']) || isset($bannersArray[DA_MAIN_13]['ID']))
		{
?>
			<div class="col-xs-3 content-margin">
				<div id='<? echo $bannersArray[DA_MAIN_10]['ID']; ?>' class='bannerClick'>
<?
					if ('html' == $bannersArray[DA_MAIN_10]['PROPERTY_TYPE_VALUE']) {
						echo $bannersArray[DA_MAIN_10]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
					} else {
						if (empty($bannersArray[DA_MAIN_10]['filesrc'])) { ?>
							<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_10]['fileDetSrc']; ?>");'>
							</div>
<?
						} else {
							$ext = substr(strrchr($bannersArray[DA_MAIN_10]['filesrc'], '.'), 1);
							if ('swf' == $ext) {
?>
								<div class="infoblock mainBanner">
									<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_10]['filesrc']; ?>" width="310" height="80">
										<param name="move" value="<? echo $bannersArray[DA_MAIN_10]['filesrc']; ?>">
									</object>
								</div>
<?							}
							else {
								?>
								<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_10]['filesrc']; ?>");'>
								</div>
							<?
							}
						}
					}

					if (isset($bannersArray[DA_MAIN_10]['ID']))
					{
						// viewsinc($bannersArray[DA_MAIN_10]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_10]['PROPERTY_COMPANYID_VALUE']);
					}
?>
				</div>
			</div>

			<div class="col-xs-3 content-margin">
				<div id='<? echo $bannersArray[DA_MAIN_11]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_11]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_11]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_11]['filesrc'])) { ?>
						<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_11]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_11]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_11]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_11]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_11]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_11]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_11]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_11]['PROPERTY_COMPANYID_VALUE']);
				}
?>
				</div>
			</div>
			<div class="col-xs-3 content-margin">
				<div id='<? echo $bannersArray[DA_MAIN_12]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_12]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_12]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_12]['filesrc'])) { ?>
						<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_12]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_12]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_12]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_12]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_12]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_12]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_12]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_12]['PROPERTY_COMPANYID_VALUE']);
				}
?>
				</div>
			</div>
			<div class="col-xs-3 content-margin">
				<div id='<? echo $bannersArray[DA_MAIN_13]['ID']; ?>' class='bannerClick'>
<?
				if ('html' == $bannersArray[DA_MAIN_13]['PROPERTY_TYPE_VALUE']) {
					echo $bannersArray[DA_MAIN_13]['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				} else {
					if (empty($bannersArray[DA_MAIN_13]['filesrc'])) { ?>
						<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_13]['fileDetSrc']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[DA_MAIN_13]['filesrc'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[DA_MAIN_13]['filesrc']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[DA_MAIN_13]['filesrc']; ?>">
								</object>
							</div>
<?						}
						else {
							?>
							<div class="infoblock" style='background-image: url("<? echo $bannersArray[DA_MAIN_13]['filesrc']; ?>");'>
							</div>
							<?
						}
					}
				}

				if (isset($bannersArray[DA_MAIN_13]['ID']))
				{
					// viewsinc($bannersArray[DA_MAIN_13]['ID'], IBLOCK_ID_BANNERS, $bannersArray[DA_MAIN_13]['PROPERTY_COMPANYID_VALUE']);
				}
?>
				</div>
			</div>
<?		} // end if (isset($bannersArray[DA_MAIN_10]['ID']) || isset($bannersArray[DA_MAIN_11]['ID']) || isset($bannersArray[DA_MAIN_12]['ID']) || isset($bannersArray[DA_MAIN_13]['ID']))
?>
		<div class="col-sm-6 col-xs-12 content-margin">
			<div class="block-default block-default-images goodsrewsblock block-shadow">
<?
				// Фотоальбомы.
				$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"photoVideoGalleryOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "photoVideoGalleryOnMain",
		"IBLOCK_TYPE" => "photogallery",
		"IBLOCK_ID" => "11",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "captionText",
			2 => "FORUM_MESSAGE_CNT",
			3 => "companyId",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/photogallery/#ELEMENT_CODE#/",
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
		"ACTIVE_DATE_FORMAT" => "j M Y",
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
		<div class="col-sm-6 col-xs-12 content-margin">
			<div class="block-default block-default-images goodsrewsblock block-shadow">
			<?
				// Видеогалерея.
				$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"photoVideoGalleryOnMain", 
	array(
		"COMPONENT_TEMPLATE" => "photoVideoGalleryOnMain",
		"IBLOCK_TYPE" => "Videogallery",
		"IBLOCK_ID" => "12",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "FORUM_MESSAGE_CNT",
			1 => "companyId",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/videogallery/#ELEMENT_CODE#/",
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
		"ACTIVE_DATE_FORMAT" => "j M Y",
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
		<div class="col-sm-6 col-xs-12 content-margin">
		<?
			// Прайс-листы.
			$APPLICATION->IncludeComponent(
				"bitrix:news.list", 
				"priceListOnMain", 
				array(
					"COMPONENT_TEMPLATE" => "priceListOnMain",
					"IBLOCK_TYPE" => "priceList",
					"IBLOCK_ID" => "16",
					"NEWS_COUNT" => "3",
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
					"MESSAGE_404" => ""
				),
				false
			);
?>
		</div>
		<div class="col-sm-6 col-xs-12 content-margin">
			<div class="block-default interviewblock pricelistblock mainblock block-shadow">
				<div class="block-title clearfix">
					<a class="notitlestyle" href="/polls/">Опрос</a><a class="floatright" href="/polls/">Все опросы<i class="icon-icons_main-10"></i></a>
				</div>
				<div class="block-voiting-ajax">
					<?$APPLICATION->IncludeFile('/polls/votingcurrent.php', array(), array());?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
// Баннеры.
/*
	function checkFlash() {
		var isFlashEnabled = false; 
   // Проверка для всех браузеров, кроме IE 
   if (typeof(navigator.plugins)!=="undefined" 
       && typeof(navigator.plugins["Shockwave Flash"])=="object" 
   ) { 
      isFlashEnabled = true; 
   } else if (typeof (window.ActiveXObject) !==  "undefined") { 
      // Проверка для IE 
      try { 
         if (new ActiveXObject("ShockwaveFlash.ShockwaveFlash")) { 
            isFlashEnabled = true; 
         } 
      } catch(e) {}; 
   }; 
   return isFlashEnabled; 
		
		
		
		
		
		var flashinstalled = false;
		console.log(navigator.plugins);
		if (navigator.plugins) {
			if (navigator.plugins["Shockwave Flash"])
				flashinstalled = true;
			else if (navigator.plugins["Shockwave Flash 2.0"])
				flashinstalled = true;
		}
		else if (navigator.mimeTypes) {
			var x = navigator.mimeTypes['application/x-shockwave-flash'];
			if (x && x.enabledPlugin)
				flashinstalled = true;
		}

		return flashinstalled;
	}

	if (!checkFlash()) {
		$('.altBanner').removeClass('hide');
		$('.mainBanner').addClass('hide');
	}
	*/
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>