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

// pre($arParams);
// pre($arResult);
if ($arParams["DISPLAY_TOP_PAGER"])
	echo $arResult["NAV_STRING"];

$counter = 0;
foreach($arResult["ITEMS"] as $arItem) {
	++$counter;
	// pre($arItem);
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
// Подумать над стрелками вниз - вверх
//*********************************************************************//
	$rating = (!empty($arItem['PROPERTIES']['rating']['VALUE']))? round($arItem['PROPERTIES']['rating']['VALUE'], 1): 0;

	$class = '';
	if ($arItem['PROPERTIES']['placeInRating']['VALUE'] > $counter)
		$class = 'toptoup';
	elseif ($arItem['PROPERTIES']['placeInRating']['VALUE'] < $counter)
		$class = 'toptodown';

	if (empty($arItem['PROPERTIES']['dateUpdateRating']['VALUE']))
	{
		$property[PROPERTY_ID_DATE_UPDATE_RATING] = date('d.m.Y');
		// Установим новое значение для данного свойства данного элемента
		CIBlockElement::SetPropertyValuesEx($arItem['ID'], IBLOCK_ID_COMPANY, $property);
	}
	elseif (!empty($arItem['PROPERTIES']['dateUpdateRating']['VALUE']) && (date('d.m.Y') != $arItem['PROPERTIES']['dateUpdateRating']['VALUE']) )
	{
		$property[PROPERTY_ID_PLACE_IN_RATING] = $counter;
		$property[PROPERTY_ID_DATE_UPDATE_RATING] = date('d.m.Y');
		// Установим новое значение для данного свойства данного элемента
		CIBlockElement::SetPropertyValuesEx($arItem['ID'], IBLOCK_ID_COMPANY, $property);
	}
//*********************************************************************//

	if (1 == $counter) {
?>
		<div class="row">
<?	}

	if ($counter < 4) {
		if ($arItem["PREVIEW_PICTURE"]["SRC"])
			$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>310, 'height'=>160), BX_RESIZE_IMAGE_EXACT, true);
		else
			$file['src'] = '';		
?>
		<div class="col-sm-4 col-xs-12">
			<div class="block-default block-shadow content-margin top100head text-center">
				<a href="/top100/statistics/?companyId=<? echo $arItem['ID']; ?>">
					<div class="t100hup" style="background-image: url('<? echo $file['src']; ?>');"></div>
					<div class="t100hmid topplace<? echo $counter; ?>">
						<? echo $arItem['~NAME']; ?>
					</div>
					<div class="t100hbot">
						<div class="t100hbottitle">Рейтинг:</div>
						<div class="t100hbotnum"><? echo $rating; ?></div>
					</div>
				</a>
			</div>
		</div>
<?
	}

	if (3 == $counter) {
?>
		</div>
<?
	}

	if ($counter < 4)
		continue;

	if ($counter == 4) {
?>
		<div class="content-margin">
			<div class="panel panel-default">
				<table class="table table-striped table-hover table-bordered block-default block-shadow tableblock tablebold tableclick">
					<tbody>
<?	}
?>
						<tr class="redline"> 
							<td><? echo $counter; ?></td>
							<td>
								<a href="/top100/statistics/?companyId=<? echo $arItem['ID']; ?>"><? echo $arItem['~NAME']; ?></a>
								<div class="top100info floatright">Рейтинг: <span class="numper"><? echo $rating; ?></span><span class="<? echo $class; ?>"></span>
								</div>
							</td>
						</tr>
<?  
	if ($arParams['NEWS_COUNT'] == $counter) {	
?>
					</tbody>
				</table>
			</div>
		</div> <!-- end div class="content-margin"> -->
<?
	}
}

if ($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>




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
