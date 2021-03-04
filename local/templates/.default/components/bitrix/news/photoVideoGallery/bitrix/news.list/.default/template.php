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
?>

<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft"> 
<?
 
	if($arParams["DISPLAY_TOP_PAGER"])
		echo $arResult["NAV_STRING"] . '<br />';
	
	$detailUrl = $arParams['SECTION_URL'];

	$url = curPageURL();
	$parseUrl = parse_url($url);

	if (isset($parseUrl['query']) && !empty($parseUrl['query']))
	{
		$detailUrl .= '?' . $parseUrl['query'];
	}
?>
	</nav> 
</div>

	<div class="row">
<?
foreach($arResult["ITEMS"] as $arItem)
{
	//pre($arItem);
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	$file['src'] = EMPTY_IMAGE_PATH;

	if ($arItem["PREVIEW_PICTURE"]["SRC"])
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>475, 'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
	{
		$arSelect = array("PREVIEW_PICTURE");
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arItem['PROPERTIES']['companyId']['VALUE'], "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
		if ($ob = $res->GetNextElement())
			$arFields = $ob->GetFields();

		$fileNum = $arFields['PREVIEW_PICTURE'];

		if ($fileNum)
			$file = CFile::ResizeImageGet($fileNum, array('width'=>475, 'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}

	$msgCounter = isset($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

	$page = $APPLICATION->GetCurPage();

	switch ($page)
	{
		case '/videogallery/':
		{
			$categoryName = 'Видеоальбом';
			break;
		}

		case '/photogallery/':
		{
			$categoryName = 'Фотоальбом';
			break;
		}
	}
?>
		<div class="col-xs-6 cell-12-xs content-margin">
			<div class="block-default block-default-images innerphotoblock photogall block-shadow">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="centerimg" style="background-image: url('<? echo $file['src']; ?>');">
						<div class="firmblock"><? echo $categoryName; ?> компании <? echo strip_tags($arItem['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']); ?></div>
					</div>
					<div class="bottomtext">
						<div class="infotvc">
							<span class="infotime"><? echo $arItem["DATE_CREATE"]; ?></span>
							<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($arItem['ID']); ?></span>
							<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
						</div>
						<div class="titleblock"><? echo $arItem['~NAME']; ?></div>
					</div>
				</a>
			</div>
		</div>
<?} // end foreach($arResult["ITEMS"] as $arItem)
?>
	</div>
	<div class="paginationblock clearfix">
		<nav aria-label="Page navigation" class="floatleft">
	<?
		if($arParams["DISPLAY_BOTTOM_PAGER"])
			echo $arResult["NAV_STRING"];
	?>
		</nav>
		<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
	</div>





<?
/*

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
