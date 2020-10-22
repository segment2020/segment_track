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
?>


<div class="block-title clearfix">
	<a class="notitlestyle" href="<? echo $arResult['SECTION_PAGE_URL']; ?>"><? echo $arResult['NAME']; ?></a><a class="floatright" href="<? echo $arResult['SECTION_PAGE_URL']; ?>">Все каталоги<i class="icon-icons_main-10"></i></a>
</div>
<div class="row">
<?
foreach($arResult["ITEMS"] as $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	// if ($arItem["PREVIEW_PICTURE"]["SRC"])
		// $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>70, 'height'=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	// else
		// $file['src'] = '';

	if ('1' === $arItem['PROPERTIES']['paidOption']['VALUE']) {
		$arSelect = array("NAME", 'PROPERTY_paidBrandsNum', 'PROPERTY_beginDatePB', 'PROPERTY_endDatePB');
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arItem['PROPERTIES']['companyId']['VALUE'], "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
		if ($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			if (0 !== (int)$arFields['PROPERTY_PAIDBRANDSNUM_VALUE'])
			{
				$curStrDate = strtotime('now');
				if (strtotime($arFields['PROPERTY_BEGINDATEPB_VALUE']) <= $curStrDate && strtotime($arFields['PROPERTY_ENDDATEPB_VALUE']) >= $curStrDate)
					$companyName = strip_tags($arItem['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']);
				else
					$companyName = 'Не указан';
			}
		}
	}
	else
	{
		$companyName = strip_tags($arItem['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']);
	}
?>
	<div class="col-xs-6">
		<div class="tableblockitem nobmarrgin">
			<a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>">
				<div class="imgblock floatleft nodisp1320">
					<img src="/tpl/images/pdfIcon70x70.png" width='70px'>
				</div>
				<div class="textblock nomarginleft1320">
					<div class="firmblock">
						Собственник <? echo $companyName; ?>
					</div>
					<div class="titleblock">
						<? echo $arItem["NAME"]; ?>
					</div>
<?
						if (isset($arItem['PROPERTIES']['country']['VALUE']) && !empty($arItem['PROPERTIES']['country']['VALUE'])) { ?>
							<div class="infotvc">
								<? echo GetCountryByID($arItem['PROPERTIES']['country']['VALUE']); ?>
							</div>
<?						} ?>
				</div>
			</a>
		</div>
	</div>
<?
}
?>
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
