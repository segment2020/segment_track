<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

// pre($arResult);
// pre($arParams);


$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_companyId");
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "CODE" => $arResult['VARIABLES']['ELEMENT_CODE']);
$resID = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect)->GetNext();
if ($resID['ID'] && $resID['IBLOCK_ID']) {
	viewsinc($resID['ID'], $resID['IBLOCK_ID'], $resID['PROPERTY_COMPANYID_VALUE']); 
}

?>

<?

$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'VIEWSCOUNT' => $resID['ID'] ? showviews($resID['ID']) : 0,
	),
	$component
);?>
<!--<p><a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></p>-->
<?if($arParams["USE_RATING"]=="Y" && $ElementID):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $ElementID,
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);?>
<?endif?>
<?if($arParams["USE_CATEGORIES"]=="Y" && $ElementID):
	global $arCategoryFilter;
	$obCache = new CPHPCache;
	$strCacheID = $componentPath.LANG.$arParams["IBLOCK_ID"].$ElementID.$arParams["CATEGORY_CODE"];
	if(($tzOffset = CTimeZone::GetOffset()) <> 0)
		$strCacheID .= "_".$tzOffset;
	if($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
		$CACHE_TIME = 0;
	else
		$CACHE_TIME = $arParams["CACHE_TIME"];
	if($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath))
	{
		$rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE"=>"Y","CODE"=>$arParams["CATEGORY_CODE"]));
		$arCategoryFilter = array();
		while($arProperty = $rsProperties->Fetch())
		{
			if(is_array($arProperty["VALUE"]) && count($arProperty["VALUE"])>0)
			{
				foreach($arProperty["VALUE"] as $value)
					$arCategoryFilter[$value]=true;
			}
			elseif(!is_array($arProperty["VALUE"]) && strlen($arProperty["VALUE"])>0)
				$arCategoryFilter[$arProperty["VALUE"]]=true;
		}
		$obCache->EndDataCache($arCategoryFilter);
	}
	else
	{
		$arCategoryFilter = $obCache->GetVars();
	}
	if(count($arCategoryFilter)>0):
		$arCategoryFilter = array(
			"PROPERTY_".$arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
			"!"."ID" => $ElementID,
		);
		?>
		<hr /><h3><?=GetMessage("CATEGORIES")?></h3>
		<?foreach($arParams["CATEGORY_IBLOCK"] as $iblock_id):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				$arParams["CATEGORY_THEME_".$iblock_id],
				Array(
					"IBLOCK_ID" => $iblock_id,
					"NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],
					"SET_TITLE" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"FILTER_NAME" => "arCategoryFilter",
					"CACHE_FILTER" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
				),
				$component
			);?>
		<?endforeach?>
	<?endif?>
<?endif?>


<?
if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID) {
	$APPLICATION->IncludeComponent(
		"bitrix:forum.topic.reviews",
		"itemcomment",
		Array(
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
			"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
			"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
			"FORUM_ID" => $arParams["FORUM_ID"],
			"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
			"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
			"DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
			"ELEMENT_ID" => $ElementID,
			"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"FILES_COUNT" => "5",
			"PAGE_NAVIGATION_TEMPLATE" => "custom",
			"PAGE_NAVIGATION_WINDOW" => "5",
		),
		$component
	);
}
?>



<?
$categoryArray = $elemArray = array();

if (IBLOCK_ID_ANALYTICS == $arParams['IBLOCK_ID'])
	$propId = PROPERTY_ID_ADD_MATERIAL_IN_ANALYTICS;
elseif (IBLOCK_ID_LIFE_INDUSTRY == $arParams['IBLOCK_ID'])
	$propId = PROPERTY_ID_ADD_MATERIAL_IN_LIFE_INDUSTRY;

$res = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $ElementID, array(), array('ID' => $propId));
while ($elProps = $res->Fetch())
{
	array_push($elemArray, $elProps['VALUE']);
	$iBlockId = CIBlockElement::GetIBlockByID($elProps['VALUE']);
	array_push($categoryArray, $iBlockId);		
}

$count = count($categoryArray);
for ($i = 0; $i < $count; ++$i)
{
	if (empty($categoryArray[$i]) || empty($elemArray[$i]))
		continue;

	$arSelect = Array("NAME", 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'PROPERTY_companyId');
	$arFilter = Array("IBLOCK_ID" => $categoryArray[$i], "ACTIVE"=>"Y", "ID" => $elemArray[$i]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect)->GetNext();

	$arSelect = Array("NAME");
	$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_COMPANY, "ACTIVE"=>"Y", "ID" => $res['PROPERTY_COMPANYID_VALUE']);
	$company = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect)->GetNext();

	if (!empty($res["PREVIEW_PICTURE"])) {
		$file = CFile::ResizeImageGet($res["PREVIEW_PICTURE"], array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_EXACT, true);
	} else {
		$file['src'] = '';
	}
?>
	<a href="<? echo $res['DETAIL_PAGE_URL']; ?>">
		<div class="block-default block-shadow content-margin readmoarblock">
			<div class="block-title clearfix"><span>Читайте также</span></div>
			<div class="clearfix">
				<div class="floatleft">
					<img src="<? echo $file['src']; ?>">
				</div>
				<div class="readmoartext">
					<div class="readmoarfirm"><? echo $company['NAME']; ?></div>
					<div class="readmoartitle"><? echo $res['NAME']; ?></div>
					<div class="readmoardescr">
						<? echo $res['PREVIEW_TEXT']; ?>
					</div>
				</div>
			</div>
		</div>	
	</a>
<?
}
?>