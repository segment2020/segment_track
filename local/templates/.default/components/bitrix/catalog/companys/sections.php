<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

?>


<h1>Участники рынка</h1>
	<div class="addfilterblock clearfix content-margin">
		<? if (!CSite::InGroup(array(ID_GROUP_COMPANY_STAFF)) && !CSite::InGroup(array(ID_GROUP_COMPANY_ADMIN))) { ?>
			<div class="addcompanyblock floatleft">
				<a href="/personal/companyadd/" class="btn btn-blue-full minbr"><span class="plus">+</span>Добавить свою компанию</a>
			</div>
		<? } ?>
		<div class="moarfilterblock floatright">
			<div class="btn btn-blue minbr"><i class="icon-icons_main-14"></i>Расширенный поиск</div>
		</div>					
	</div>
	<div class="block-default in block-shadow content-margin advancedsearchblock">
		<div class="block-title clearfix">Расширенный поиск</div>
		<form action='/company/list/' method='GET'>
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input1">Регион</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='regionsList' name='regionId'>
							<option value=''></option>
<?
							//выберем папки из информационного блока $blockId и раздела 0.
							$items = GetIBlockSectionList(IBLOCK_ID_CITY, 0, array("sort" => "asc"));
							while ($arItem = $items->GetNext())
								echo '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';
?>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group hide" id='areaListBlock'>
						<label class="control-label mainlabel" for="lk_input1">Область</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='areaList' name='areaId'>
						</select>	
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group hide" id='citiesListBlock'>
						<label class="control-label mainlabel" for="lk_input1">Город</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='citiesList' name='cityId'>
						</select>	
					</div>							
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input4">Название</label>
						<input type="text" class="form-control" id="lk_input4" value="" name='companyName'>
					</div>							
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input1">Тип компании</label>
						<select class="selectpicker selectboxbtn form-control minbr" name='typeCompanyId'>
						<option value=''>Bce</option>
<?
							//выберем папки из информационного блока $blockId и раздела 0.
							$items = GetIBlockSectionList(IBLOCK_ID_COMPANY, 0, array("sort" => "asc"));
							while ($arItem = $items->GetNext())
								echo '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';
?>
						</select>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input5">Зарубежный город</label>
						<input type="text" class="form-control" id="lk_input5" value="" name='cityName'>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input4">Описание</label>
						<input type="text" class="form-control" id="lk_input4" value="" name='description'>
					</div>
					<div class="seporator lksep"></div>
					<button class="btn btn-blue-full minbr">Найти</button>
				</div>
			</div>
		</form>
	</div>
	<div class="block-default block-shadow content-margin fliteralphabetblock clearfix show_rus">
		<div class="langselect btn-group floatleft" data-toggle="buttons">
		  <label class="btn btn-light-blue minbr active">
			<input type="radio" name="options" id="option1" value="show_rus" autocomplete="off" checked>Rus</label>
		  <label class="btn btn-light-blue minbr">
			<input type="radio" name="options" id="option2" value="show_eng" autocomplete="off">Eng</label>
		</div>
		<div class="fliteralphabetshowall floatright">
			<a href="/company/list/"><i class="icon-icons_main-05"></i>Показать все</a>
		</div>
		<div class="fliteralphabet">
			<div class="btn btn-light-blue minbr prewslid"><i class="icon-icons_main-09"></i></div>
			<div class="paginationbox">
				<? $APPLICATION->IncludeFile('/tpl/include_area/firstLetterFilter.php', array(), array()); ?>
			</div>
			<div class="btn btn-light-blue minbr nextslid"><i class="icon-icons_main-08"></i></div>
		</div>
	</div>
	<div class="block-default block-shadow content-margin companybase companybasered">
		<div class="companyico floatleft">
			<img src="/tpl/images/base_ico1.png">
		</div>
		<div class="companytext">
			<div class="companytitle"><a href="/company/list/">Общий список участников рынка</a></div>
			<div class="companydescr">Раздел включает в себя все зарегистрированные на портале Сегмент.Ру компании, то есть всех участников канцелярского рынка.</div>
		</div>
	</div>


<?
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
		"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
		"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
		"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
	),
	$component,
	array("HIDE_ICONS" => "Y")
);


if ($arParams["USE_COMPARE"] === "Y")
{
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
			"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_ccl",
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
			'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);
}

if ($arParams["SHOW_TOP_ELEMENTS"] !== "N")
{
	if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y')
	{
		$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
	}
	else
	{
		$basketAction = isset($arParams['TOP_ADD_TO_BASKET_ACTION']) ? $arParams['TOP_ADD_TO_BASKET_ACTION'] : '';
	}

	$APPLICATION->IncludeComponent(
		"bitrix:catalog.top",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
			"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
			"PROPERTY_CODE_MOBILE" => $arParams["TOP_PROPERTY_CODE_MOBILE"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
			"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["TOP_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => $arParams["TOP_OFFERS_LIMIT"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
			'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),

			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
			'PRODUCT_BLOCKS_ORDER' => $arParams['TOP_PRODUCT_BLOCKS_ORDER'],
			'PRODUCT_ROW_VARIANTS' => $arParams['TOP_PRODUCT_ROW_VARIANTS'],
			'ENLARGE_PRODUCT' => $arParams['TOP_ENLARGE_PRODUCT'],
			'ENLARGE_PROP' => isset($arParams['TOP_ENLARGE_PROP']) ? $arParams['TOP_ENLARGE_PROP'] : '',
			'SHOW_SLIDER' => $arParams['TOP_SHOW_SLIDER'],
			'SLIDER_INTERVAL' => isset($arParams['TOP_SLIDER_INTERVAL']) ? $arParams['TOP_SLIDER_INTERVAL'] : '',
			'SLIDER_PROGRESS' => isset($arParams['TOP_SLIDER_PROGRESS']) ? $arParams['TOP_SLIDER_PROGRESS'] : '',

			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
			'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],

			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : '')
		),
		$component
	);
	unset($basketAction);
}