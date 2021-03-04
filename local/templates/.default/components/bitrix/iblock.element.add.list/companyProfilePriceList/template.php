<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);
  // pre($arResult);
 // pre($arParams);
 
 // $f = CFile::GetFileArray($arResult['ELEMENTS'][0]['ID']);
 // pre($f);
?>
	<div class="block-default in block-shadow content-margin">
		<div class="block-title clearfix">Прайс-листы</div>
		<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
			<div class="lk_companylogobtn">
				<input type="hidden" name="PROPERTY[<? echo PROPERTY_ID_FILE_IN_PRICE_LIST; ?>][0]" value="">
				<input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_<? echo PROPERTY_ID_FILE_IN_PRICE_LIST; ?>_0" />
				<label for='previewPicture'>
					<div class="btn btn-blue btnplus minbr">
						<span class="plus text-center">+</span>Добавить прайс-лист
					</div>
				</label>
				<span id='previewPictureFileName'></span>
			</div>
<input type="text" name="PROPERTY[NAME][0]" size="30" value="y78y87y87y789y">
<?
		$arSelect = array("ID", "NAME", 'PROPERTY_file');
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_PRICE_LISTS, "ACTIVE"=>"Y", 'PROPERTY_companyID' => $_GET['CODE']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while ($fileInfo = $res->Fetch()) {
			$fileArray = CFile::GetFileArray($fileInfo['PROPERTY_FILE_VALUE']);
			$fileSize = ($fileArray['FILE_SIZE'] > 1000)? ($fileArray['FILE_SIZE'] / 1000) . ' Кб': $fileArray['FILE_SIZE'] . ' б';
		?>
			<div class="pricelisttitle">
				 <? echo $arResult['NAME']; ?>
			</div>
			<div class="col-xs-4">
				<div class="pricelistdown">
					<div class="pricelistimg xls floatleft">
						<a target="_blank" href="<? echo $fileArray['SRC']; ?>"><i class="icon-icons_main-03"></i></a>
					</div>
					<div class="pricelisttext">
						<div class="pricelistlink">
							<a target="_blank" href="<? echo $fileArray['SRC']; ?>">Скачать прайс</a>
						</div>
						<div class="pricelistsize">
							 <? echo $fileSize; ?>
						</div>
					</div>
				</div>
			</div>
	<?	} ?>

		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" class="btn btn-blue-full minbr" />
		</form>
	</div>
</div> <!-- end div class="col-sm-9 col-xs-12 content-margin" id="article"> -->






<?
// old template.
/*
$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<table class="data-table">
<?if($arResult["NO_USER"] == "N"):?>
	<thead>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
	<?if (count($arResult["ELEMENTS"]) > 0):?>
		<?foreach ($arResult["ELEMENTS"] as $arElement):?>
		<tr>
			<td><!--a href="detail.php?CODE=<?=$arElement["ID"]?>"--><?=$arElement["NAME"]?><!--/a--></td>
			<td><small><?=is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]]?></small></td>
			<?if ($arResult["CAN_EDIT"] == "Y"):?>
			<td><?if ($arElement["CAN_EDIT"] == "Y"):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=GetMessage("IBLOCK_ADD_LIST_EDIT")?><?else:?>&nbsp;<?endif?></a></td>
			<?endif?>
			<?if ($arResult["CAN_DELETE"] == "Y"):?>
			<td><?if ($arElement["CAN_DELETE"] == "Y"):?><a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a><?else:?>&nbsp;<?endif?></td>
			<?endif?>
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?></td>
		</tr>
	<?endif?>
	</tbody>
<?endif?>
	<tfoot>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?></td>
		</tr>
	</tfoot>
</table>
<?if (strlen($arResult["NAV_STRING"]) > 0):?><?=$arResult["NAV_STRING"]?><?endif?>