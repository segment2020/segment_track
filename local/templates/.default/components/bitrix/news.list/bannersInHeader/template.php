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
?>

<?
$params = array(DA_HEADER_LEFT, DA_HEADER_RIGHT);
$left = $right = $viewLeft = $viewRight = false;

foreach($arResult["ITEMS"] as $arItem) {
	if (true === $left && true === $right)
		break;
// pre($arItem);
	if (!empty($arItem['PROPERTIES']['flash']['VALUE']))
		$flashSrc = CFile::GetPath($arFields["PROPERTY_FLASH_VALUE"]);

	if (!empty($arItem["PREVIEW_PICTURE"]["SRC"]))
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>640, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$file['src'] = '';

	if ($params[0] == $arItem['PROPERTIES']['displayingArea']['VALUE_ENUM_ID'] && !$left)
	{
		$left = true;
		$viewLeft = true;
	}
	elseif ($params[1] == $arItem['PROPERTIES']['displayingArea']['VALUE_ENUM_ID'] && !$right && $left)
	{
		$right = true;
		$viewRight = true;
	}
	elseif ($params[1] == $arItem['PROPERTIES']['displayingArea']['VALUE_ENUM_ID'])
	{
		// Сохраним на всякий случай правый баннер, если не выведется в основном цикле.
		$tmpRightBanner = $arItem;
		$tmpRightBanner['fileSrc'] = $file['src'];
	}
// pre($tmpRightBanner);
	if (true === $viewLeft || true === $viewRight)
	{
		if ($viewLeft)
			$viewLeft = false;
		elseif ($viewRight)
			$viewRight = false;

		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

		viewsinc($arItem['ID'], IBLOCK_ID_BANNERS, $arItem['PROPERTIES']['companyId']['VALUE']);
?>
		<div class="col-xs-6">
			<div id='<? echo $arItem['ID']; ?>' class='bannerClick'>
				<? if (BANNER_TYPE_ORDINARY == $arItem['PROPERTIES']['type']['VALUE_ENUM_ID']) {
					if (!$flashSrc) { ?>
						<div class="infoblock-head" style='background-image: url("<? echo $file['src']; ?>");'>
						</div>
<?								
					} else {
?>
						<div class="infoblock-head">
							<object type="application/x-shockwave-flash" data="<? echo $flashSrc; ?>" width="230" height="60">
								<param name="move" value="<? echo $flashSrc; ?>">
							</object>
						</div>
<?					}
				} elseif (BANNER_TYPE_HTML == $arFields['PROPERTY_TYPE_VALUE']) {
					echo $arFields['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				}
?>
			</div>
		</div>
<?	}
} // end foreach($arResult["ITEMS"] as $arItem)


// Если вывелся только левый баннер.
if (true === $left && true !== $right)
{
	viewsinc($tmpRightBanner['ID'], IBLOCK_ID_BANNERS, $arItem['PROPERTIES']['companyId']['VALUE']);
?>
	<div class="col-xs-6">
		<div id='<? echo $tmpRightBanner['ID']; ?>' class='bannerClick'>
<?
			if (BANNER_TYPE_ORDINARY == $tmpRightBanner['PROPERTIES']['type']['VALUE_ENUM_ID']) { ?>
				<div class="infoblock-head"  style='background-image: url("<? echo $tmpRightBanner['fileSrc']; ?>");'>
				</div>
<?			} elseif (BANNER_TYPE_HTML == $tmpRightBanner['PROPERTIES']['type']['VALUE_ENUM_ID']) {
				echo $tmpRightBanner['PROPERTY_HTMLCODE_VALUE']['TEXT'];
			}
?>
		</div>
	</div>
<?	
}
elseif (true !== $left)
{
	// Не вывелся левый(его нет) - значит не вывелся и правый.
	// Выведем пустое место для левого баннера только если есть правый.
	if (isset($tmpRightBanner))
	{
		viewsinc($tmpRightBanner['ID'], IBLOCK_ID_BANNERS, $arItem['PROPERTIES']['companyId']['VALUE']);
?>
		<div class="col-xs-6">
		</div>

		<div class="col-xs-6">
			<div id='<? echo $tmpRightBanner['ID']; ?>' class='bannerClick'>
<?
				if (BANNER_TYPE_ORDINARY == $tmpRightBanner['PROPERTIES']['type']['VALUE_ENUM_ID']) { ?>
					<div class="infoblock-head" style='background-image: url("<? echo $tmpRightBanner['fileSrc']; ?>");'>
					</div>
<?				} elseif (BANNER_TYPE_HTML == $tmpRightBanner['PROPERTIES']['type']['VALUE_ENUM_ID']) {
					echo $tmpRightBanner['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				}
?>
			</div>
		</div>
<?
	}
	else
	{
		/*
?>
		<div class="col-xs-6 content-margin">
			<div class="infoblock-head">
			</div>
		</div>
<?
*/
	}
}
?>







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
