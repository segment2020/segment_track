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

<?
foreach($arResult["IBLOCKS"] as $arIBlock) {
	if (empty($arIBlock["ITEMS"]))
		continue;

	$this->AddEditAction('iblock_'.$arIBlock['ID'], $arIBlock['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arIBlock["ID"], "ELEMENT_ADD"));
?>
	<div class="block-default block-shadow content-margin compnewsblock in nobgimg">
		<div class="block-title clearfix">
			<span>
				<a class="bigRed" href="<? echo $arIBlock["LIST_PAGE_URL"]; ?>?companyid=<? echo $arResult["ITEMS"][0]['PROPERTIES']['companyId']['VALUE']; ?>">
					<? echo $arIBlock["NAME"]; ?>
				</a>
			</span>
			<a class="floatright" href="<? echo $arResult["SECTION_PAGE_URL"]; ?>?companyid=<? echo $arResult["ITEMS"][0]['PROPERTIES']['companyId']['VALUE']; ?>">Все <? echo $arIBlock["NAME"]; ?><i class="icon-icons_main-10"></i></a>
		</div>
		<div class="row">
<?
	foreach($arIBlock["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNI_ELEMENT_DELETE_CONFIRM')));
	// pre($arItem);
		if (isset($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']) && !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']))
			$msgCounter = $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];
		else
			$msgCounter = 0;

		$showCounter = (isset($arItem['SHOW_COUNTER']) && !empty($arItem['SHOW_COUNTER']))? $arItem["SHOW_COUNTER"]: 0;

		if ($arItem["PREVIEW_PICTURE"]['SRC'])
			$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
		else
			$file['src'] = EMPTY_IMAGE_PATH;
?>
		<div class="col-sm-4 col-xs-12">
			<div class="newsbitem clearfix">
				<div class="newsbimg floatleft nodisp1320">
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
						<img src="<? echo $file["src"]; ?>" width='60'>
					</a>
				</div>
				<div class="newsbtext nomarginleft1320">
					<? if ($arResult['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']) 
					{ ?>		
						<div class="newsbfirm">Новость компании <?=$arResult['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']?></div>
					<? } ?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="newsbtitle"><?echo $arItem["NAME"]?></a>
					<div class="infotvc in">
						<span class="infotime"><? echo $arItem["DATE_CREATE"]; ?></span>
						<span class="infoview"><i class="icon-icons_main-05"></i><? echo $showCounter; ?></span>
						<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
					</div>
				</div>
			</div>
		</div>
<?
	}
?>
		</div> <!-- end div class="row"> -->
	</div> <!-- end div class="block-default block-shadow content-margin compnewsblock in nobgimg"> -->
<?
}
?>


<?
/*
<?$LINE_ELEMENT_COUNT=2;?>
<div class="news-index">
<table cellpadding="10" cellspacing="0" border="0" width="100%">
	<tr>
<?
$cell = 0;
foreach($arResult["IBLOCKS"] as $arIBlock):?>
		<td valign="top" width="<?=round(100/$LINE_ELEMENT_COUNT)?>%">
			<table class="data-table" cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead>
				<?
				$this->AddEditAction('iblock_'.$arIBlock['ID'], $arIBlock['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arIBlock["ID"], "ELEMENT_ADD"));
				?>
				<tr valign="top" id="<?=$this->GetEditAreaId('iblock_'.$arIBlock['ID']);?>">
					<td colspan="2"><a href="<?=$arIBlock["LIST_PAGE_URL"]?>"><?=$arIBlock["NAME"]?></a></td>
				</tr>
			</thead>
				<?foreach($arIBlock["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNI_ELEMENT_DELETE_CONFIRM')));
				?>
				<tr valign="top" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<td class="news-date-time" style="border:0" nowrap id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?=$arItem["DISPLAY_ACTIVE_FROM"]?>&nbsp;
					</td>
					<td style="border:0">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>&nbsp;
					</td>
				</tr>
				<?endforeach;?>
			</table>
		</td>
	<?
	if((++$cell)>=$LINE_ELEMENT_COUNT):
		$cell = 0;
	?></tr><tr><?
	endif; // if($n%$LINE_ELEMENT_COUNT == 0):
endforeach;
		while ($cell<$LINE_ELEMENT_COUNT):
			$cell++;
		?><td>&nbsp;</td><?
		endwhile;
		?>
	</tr>
</table>
</div>