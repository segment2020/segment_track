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

	<div class="block-default pricelistblock block-shadow content-margin">
		<div class="block-title clearfix">Прайс-листы</div>
		<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data">
			<?=bitrix_sessid_post()?>
			<div class="row">
				<div class='col-xs-3'>
					<label for='priceListName'>Название</label>
					<input type="text" id='priceListName' name="PROPERTY[NAME][0]" class='form-control' size="30" value="" style='width: 196px;'>
				</div>

				<div class='col-xs-3'>
					<label>Выберите файл</label>
					<div class="lk_companylogobtn">
						<input type="hidden" name="iBlockId" value="<? echo $arParams['IBLOCK_ID']; ?>">
						<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
						<input type="hidden" name="PROPERTY[<? echo PROPERTY_ID_FILE_IN_PRICE_LIST; ?>][0]" value="">
						<input type="file" class='hide fileUpload' id='priceList' name="PROPERTY_FILE_<? echo PROPERTY_ID_FILE_IN_PRICE_LIST; ?>_0" />
						<label for='priceList'>
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать прайс-лист
							</div>
						</label>
						<span id='priceListFileName'></span>
					</div>
				</div>
			</div>
			<div class="row">
<?			foreach($arResult["ITEMS"] as $arItem) {
				$fileArray = CFile::GetFileArray($arItem['PROPERTIES']['file']['VALUE']);
				$fileSize = ($fileArray['FILE_SIZE'] > 1000)? ceil($fileArray['FILE_SIZE'] / 1000) . ' Кб': $fileArray['FILE_SIZE'] . ' б';
		?>
				<div class="col-xs-4">
					<div class="pricelisttitle">
						<? echo $arItem['NAME']; ?>
					</div>
					<div class="pricelistdown">
						<div class="pricelistimg xls floatleft">
							<a target="_blank" href="<? echo $fileArray['SRC']; ?>"><i class="icon-icons_main-03"></i></a>
						</div>
						<div class="pricelisttext">
							<div class="pricelistlink">
								<a target="_blank" href="<? echo $fileArray['SRC']; ?>">Скачать прайс</a>
								<br>
								<a href="/formsActions/?actionNum=delete&id=<? echo $arItem['ID'] . '&sesId=' . bitrix_sessid(); ?>" onclick="return confirm('Вы действительно хотите удалить элемент?')">Удалить</a>
							</div>
							<div class="pricelistsize">
								<? echo $fileSize; ?>
							</div>
						</div>
					</div>
				</div>
				
<?			} ?>
			</div>
		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" id='addPriceList' class="btn btn-blue-full minbr" />
		</form>
	</div>
</div> <!-- end div class="col-xs-9 content-margin" id="article"> -->





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
