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

<form name="iblock_add" action="/editelement/?edit=Y&CODE=<? echo $arResult['ID']; ?>" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

<div class="col-sm-9 col-xs-12 content-margin" id="article">
<?
if (isset($_GET['errorStr']) && !empty($_GET['errorStr'])) {
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['errorStr']; ?>
			</div>
		</div>
	</div>
<?
}

if (isset($_GET['msg']) && !empty($_GET['msg'])) {
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['msg']; ?>
			</div>
		</div>
	</div>
<?
}
// pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_ELEMENT_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => $arResult['NAME'], 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT']), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_nameAuthor">Имя автора*</label>
					<input type="text" class="form-control" id='lk_nameAuthor' name="PROPERTY[<? echo $arResult['PROPERTIES']['name']['ID']; ?>][0]" value="<? echo $arResult['PROPERTIES']['name']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_newsSource">Источник</label>
					<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['source']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['source']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_photoSource">Источник фото</label>
					<input type="text" class="form-control" id="lk_photoSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['imgSource']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['imgSource']['VALUE']; ?>">
				</div>
			</div>

<?
//*********************************************************************************************************************************
// $APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
// 							array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
// 									'previewPictureId' => $arResult["PREVIEW_PICTURE"]["ID"],
// 									'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
// 									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"]),
// 							array());
//*********************************************************************************************************************************

// pre($arResult);
?>

		</div>
	</div>

		<div class='block-default in block-shadow content-margin'>
			<div class='block-title clearfix'>
				Дополнительный материал
			</div>
			<div class='row'>
<?  // Выберем все активные информационные блоки для текущего сайта
	$res = CIBlock::GetList(array(), array('SITE_ID' => SITE_ID, 'ACTIVE'=>'Y'), true);
	while ($ar_res = $res->Fetch()) {
		if (IBLOCK_ID_CITY == $ar_res['ID'])
			continue;

		$categoryList[$ar_res['ID']] = $ar_res['NAME'];
	}

	$addMaterialArray = array();
	foreach ($arResult['PROPERTIES']['addmore']['VALUE'] as $key => $elId) {
		$iBlockId = CIBlockElement::GetIBlockByID($elId);
		// Т. к. iBlockId могут повторятся а id элемента уникальны => делаем связку idEl => idBlock.
		$addMaterialArray[$elId] = $iBlockId;
	}

	$k = 0;
 	foreach ($addMaterialArray as $elId => $iBlockId) { ?>
		<div class="col-xs-12">
			Дополнительный материал <? echo ($k + 1); ?>
		</div>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="addMaterial">Прикрепить материал - выберите раздел</label>
				<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['addBblockId']['ID'] . '][' . $k . ']'; ?>" id="<? echo $k; ?>" tabindex="-98">
					<option value="">Нет</option>
<?					foreach ($categoryList as $id => $name) {
						$selected = '';
						if ($id == $iBlockId)
							$selected = 'selected'; ?>
						<option value="<? echo $id; ?>" <? echo $selected; ?>><? echo $name; ?></option>
<?					} ?>
				</select>
			</div>
		</div>

		<div class="col-xs-12" id='addMatElem_<? echo $k; ?>'>
					<div class="form-group">
						<label class="control-label mainlabel" for="el_<? echo $k; ?>">Прикрепить материал - выберите публикацию</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['addmore']['ID'] . '][' . $k . ']'; ?>" id="el_<? echo $k; ?>" tabindex="-98">
<?							$items = GetIBlockElementList($iBlockId);
							while ($arItem = $items->GetNext()) {
								$selected = '';
								if ($arItem['ID'] == $elId)
									$selected = 'selected'; ?>
								<option value="<? echo $arItem["ID"]; ?>" <? echo $selected; ?>><? echo $arItem["NAME"]; ?></option>
<?							} ?>
						</select>
					</div>
				</div>
<?
		++$k;
	}


	// Выведем пустые поля.
	for ($n = $k; $n < COUNT_ADD_MATERIAL; ++$n) { ?>
		<div class="col-xs-12">
			Дополнительный материал <? echo ($n + 1); ?>
		</div>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="addMaterial">Прикрепить материал - выберите раздел</label>
				<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['addBblockId']['ID'] . '][' . $n . ']'; ?>" id="<? echo $n; ?>" tabindex="-98">
					<option value="">Нет</option>
<?					foreach ($categoryList as $id => $name) { ?>
						<option value="<? echo $id; ?>"><? echo $name; ?></option>
<?					} ?>
				</select>
			</div>
		</div>

			<div class="col-xs-12" id='addMatElem_<? echo $n; ?>'>
				<div class="form-group">
					<label class="control-label mainlabel" for="el_<? echo $n; ?>">Прикрепить материал - выберите публикацию</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['addmore']['ID'] . '][' . $n . ']'; ?>" id="el_<? echo $n; ?>" tabindex="-98">
<?							$items = GetIBlockElementList($arResult['PROPERTIES']['addBblockId']['VALUE'][$n]);
						while ($arItem = $items->GetNext()) { ?>
							<option value="<? echo $arItem["ID"]; ?>"><? echo $arItem["NAME"]; ?></option>
<?							} ?>
					</select>
				</div>
			</div>
<?} // end for ($n = 0; $n < 3; ++$n) { ?>



<script type="text/javascript">
		$('.addCategory').on('change', function(){
			var id = $(this).attr('id');
			var iBlockId = $(this).val();

			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '/ajax/additionalMaterial.php',
				data: 'iBlockId=' + iBlockId,
				beforeSend: function() {
					$('#addMatElem_' + id).addClass('hide');
				},
				success: function(response) {
					$('#el_' + id).empty();
					console.log(id);
					console.log($('#el_' + id));
					$('#el_' + id).append(response);
					$('#el_' + id).selectpicker('refresh');
					$('#addMatElem_' + id).removeClass('hide');
				}
			})
		});
</script>
			</div>
		</div>

		<div class='block-default in block-shadow content-margin'>
			<div class='row'>
				<? $APPLICATION->IncludeFile('/tpl/include_area/tags.php', array('value' => $arResult['TAGS'], 'text' => 'size="'.$arResult["PROPERTY_LIST_FULL"]["TAGS"]["COL_COUNT"].'"'), array()); ?>
			</div>
		</div>

		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
		<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
		<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
		<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>

		<div class="previewBlock"></div>
	</div>
</div>
</form>


<?
/*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>