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
	<div class="block-default in block-shadow content-margin">
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
	<div class="block-default in block-shadow content-margin">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['msg']; ?>
			</div>
		</div>
	</div>
<?
}
//pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_ELEMENT_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin">
		<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название баннера', 'name' => $arResult['NAME'], 'previewTextTitle' => 'Описание', 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT'], 'detailTextTitle' => 'Описание', 'includePreviewText' => 'false', 'includeDetailText' => 'false'), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************

// pre($arResult);
?>

<?
// Вывод всех свойств в одном цикле
/*
foreach ($arResult['PROPERTIES'] as $property) {
	if ('L' == $property['PROPERTY_TYPE'])
	{
?>
		<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_place"><? echo $property["NAME"]; ?></label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $property['ID'] . ']'; ?>" id="lk_type" tabindex="-98">
						<?  
							$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $property['IBLOCK_ID'], 'CODE' => $property['CODE']));
							while ($enumFields = $propertyEnums->GetNext()) {
								$selected = '';
								if ($enumFields['ID'] == $property['VALUE_ENUM_ID'])
									$selected = 'selected';
								?>
								<option value="<? echo $enumFields['ID']; ?>" <? echo $selected; ?>><? echo $enumFields['VALUE']; ?></option>
						<?	} ?>
					</select>
				</div>
			</div>
<?
	}
}
*/
?>

<?
			$selected = '';
			if (0 == $arResult['PROPERTIES']['hostingPage']['VALUE'])
				$selected = 'selected';
?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_hostingPage">Страница размещения</label>
					<?
						$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'hostingPage'));
						while ($enumFields = $propertyEnums->GetNext()) {
							if (90 != $enumFields['ID'])
								continue;

							$checked = '';
							if (in_array($enumFields['ID'], $arResult['PROPERTIES']['hostingPage']['VALUE_ENUM_ID']))
								$checked = 'checked';
?>
							<div class="mycheckbox">
								<label for='lk_hostingPage<? echo $enumFields['ID']; ?>'>
									<input name='<? echo 'PROPERTY[' . PROPERTY_ID_HOSTING_PAGE_IN_BANNERS . '][]'; ?>' type="checkbox" <? echo $checked; ?> value='<? echo $enumFields['ID']; ?>' id='lk_hostingPage<? echo $enumFields['ID']; ?>'>
									Показать на главной
								</label>
							</div>
<?
						}
?>
					
					
					<?
					/*
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['hostingPage']['ID'] . ']'; ?>" id="lk_hostingPage" tabindex="-98">
							<option value="">-</option>
							<option value="0" <? echo $selected; ?>>Главная</option>
						<?	// Выберем все активные информационные блоки для текущего сайта
							$res = CIBlock::GetList(array(), array('SITE_ID' => SITE_ID, 'ACTIVE'=>'Y'), true);
							while ($ar_res = $res->Fetch()) {
								if (IBLOCK_ID_CITY == $ar_res['ID'] || IBLOCK_ID_INFOBLOCKS_LIST == $ar_res['ID'] || IBLOCK_ID_BANNERS == $ar_res['ID'])
									continue;

								$selected = '';
								if ($ar_res['ID'] == $arResult['PROPERTIES']['hostingPage']['VALUE'])
									$selected = 'selected'; ?>
								<option value="<? echo $ar_res['ID']; ?>" <? echo $selected; ?>><? echo $ar_res['NAME']; ?></option>
<?
							}
?>
							<option value="222">Топ 100</option>
					</select>
					*/
					?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
				<?
				/*
					<label class="control-label mainlabel" for="lk_place">Зона показа</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['displayingArea']['ID'] . ']'; ?>" id="lk_place" tabindex="-98">
						<?  
							$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => $arResult['PROPERTIES']['displayingArea']['IBLOCK_ID'], 'CODE' => $arResult['PROPERTIES']['displayingArea']['CODE']));
							while ($enumFields = $propertyEnums->GetNext()) {
								if (false !== strpos($enumFields['VALUE'], 'Главная'))
								{
									$mainArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
								}
								else
								{
									$otherArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
								}
								$selected = '';
								if ($enumFields['ID'] == $arResult['PROPERTIES']['displayingArea']['VALUE_ENUM_ID'])
									$selected = 'selected';
								?>
								<option value="<? echo $enumFields['ID']; ?>" <? echo $selected; ?>><? echo $enumFields['VALUE']; ?></option>
						<?	} ?>
					</select>
					*/
					// pre($arResult['PROPERTIES']);
					?>
					<label class="control-label mainlabel" for="lk_place">Зона показа на главной</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_DISPLAY_AREA_IN_BANNERS . ']'; ?>" id="lk_place" tabindex="-98">
						<option value="">-</option>
						<?
							$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'displayingArea'));
							while ($enumFields = $propertyEnums->GetNext()) {
								$selected = '';
								if ($enumFields['ID'] == $arResult['PROPERTIES']['displayingArea']['VALUE_ENUM_ID'])
									$selected = 'selected';
								/*if (false !== strpos($enumFields['VALUE'], 'Главная'))
								{
									$mainArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
									continue;
								}
								else
								{
									$otherArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
								}*/
								?>
								<option value="<? echo $enumFields['ID']; ?>" <? echo $selected; ?>><? echo $enumFields['VALUE']; ?></option>
						<?	} ?>
					</select>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_hostingPage">Страница размещения</label>
					<?
						$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'hostingPage'));
						while ($enumFields = $propertyEnums->GetNext()) {
							if (90 == $enumFields['ID'])
								continue;

							$checked = '';
							if (in_array($enumFields['ID'], $arResult['PROPERTIES']['hostingPage']['VALUE_ENUM_ID']))
								$checked = 'checked';
?>
							<div class="mycheckbox">
								<label for='lk_hostingPage<? echo $enumFields['ID']; ?>'>
									<input name='<? echo 'PROPERTY[' . PROPERTY_ID_HOSTING_PAGE_IN_BANNERS . '][]'; ?>' type="checkbox" <? echo $checked; ?> value='<? echo $enumFields['ID']; ?>' id='lk_hostingPage<? echo $enumFields['ID']; ?>'>
									<? echo $enumFields['VALUE']; ?>
								</label>
							</div>
<?
						}
?>
					
					
					<?
					/*
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['hostingPage']['ID'] . ']'; ?>" id="lk_hostingPage" tabindex="-98">
							<option value="">-</option>
							<option value="0" <? echo $selected; ?>>Главная</option>
						<?	// Выберем все активные информационные блоки для текущего сайта
							$res = CIBlock::GetList(array(), array('SITE_ID' => SITE_ID, 'ACTIVE'=>'Y'), true);
							while ($ar_res = $res->Fetch()) {
								if (IBLOCK_ID_CITY == $ar_res['ID'] || IBLOCK_ID_INFOBLOCKS_LIST == $ar_res['ID'] || IBLOCK_ID_BANNERS == $ar_res['ID'])
									continue;

								$selected = '';
								if ($ar_res['ID'] == $arResult['PROPERTIES']['hostingPage']['VALUE'])
									$selected = 'selected'; ?>
								<option value="<? echo $ar_res['ID']; ?>" <? echo $selected; ?>><? echo $ar_res['NAME']; ?></option>
<?
							}
?>
							<option value="222">Топ 100</option>
					</select>
					*/
					?>
				</div>
			</div>
			<div class="col-xs-12" id="pagesZones">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_place_other">Зона показа</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_DISPLAY_AREA_OTHER_PAGE_IN_BANNERS . ']'; ?>" id="lk_place_other" tabindex="-98">
							<option value="">-</option>
							<?
								$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'displayingAreaOtherPage'));
								while ($enumFields = $propertyEnums->GetNext()) {
									$selected = '';
									if ($enumFields['ID'] == $arResult['PROPERTIES']['displayingAreaOtherPage']['VALUE_ENUM_ID'])
										$selected = 'selected';
									/*if (false !== strpos($enumFields['VALUE'], 'Главная'))
									{
										$mainArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
										continue;
									}
									else
									{
										$otherArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
									}*/
									?>
									<option value="<? echo $enumFields['ID']; ?>" <? echo $selected; ?>><? echo $enumFields['VALUE']; ?></option>
							<?	} ?>
						</select>
					</div>
				</div>

			<div class="col-xs-12 hide">
				<select id="mainPageZones" tabindex="-98">
					<?
						foreach ($mainArr as $key => $value) { ?>
							<option value="<? echo $value['ID']; ?>"><? echo $value['VALUE']; ?></option>
					<?	} ?>
				</select>
			</div>
			<div class="col-xs-12 hide">
				<select id="otherPagesZones" tabindex="-98">
					<?
						foreach ($otherArr as $key => $value) { ?>
							<option value="<? echo $value['ID']; ?>"><? echo $value['VALUE']; ?></option>
					<?	} ?>
				</select>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_bannerType">Тип</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['type']['ID'] . ']'; ?>" id="lk_bannerType" tabindex="-98">
					<?  
						$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arResult['PROPERTIES']['type']['IBLOCK_ID'], 'CODE' => $arResult['PROPERTIES']['type']['CODE']));
						while ($enumFields = $propertyEnums->GetNext()) {
							$selected = '';
							if ($enumFields['ID'] == $arResult['PROPERTIES']['type']['VALUE_ENUM_ID'])
								$selected = 'selected';
							?>
							<option value="<? echo $enumFields['ID']; ?>" <? echo $selected; ?>><? echo $enumFields['VALUE']; ?></option>
					<?	} ?>
					</select>
				</div>
			</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var typeSelect = document.getElementById('lk_bannerType');
	// var pageSelect = document.getElementById('lk_hostingPage');
 
	function changeOption() {
		var selectedOption = typeSelect.options[typeSelect.selectedIndex].text;
		if ('html' == selectedOption)
		{
			document.getElementById('normal').classList.add('hide');
			document.getElementById('html').classList.remove('hide');
		}
		else if ('обычный' == selectedOption)
		{
			document.getElementById('html').classList.add('hide');
			document.getElementById('normal').classList.remove('hide');
		}
	}

	function changeZones() {
		var selectedOption = pageSelect.options[pageSelect.selectedIndex].text;
		if ('Главная' == selectedOption)
		{
			var options = document.getElementById('mainPageZones').innerHTML;
			var current = document.getElementById('lk_place');
			current.options.length = 0;
			current.innerHTML = options;
			$('.selectpicker').selectpicker('refresh');
		}
		else
		{
			var options = document.getElementById('otherPagesZones').innerHTML;
			var current = document.getElementById('lk_place');
			current.options.length = 0;
			current.innerHTML = options;
			$('.selectpicker').selectpicker('refresh');
		}
	}

	typeSelect.addEventListener("change", changeOption);
	// pageSelect.addEventListener("change", changeZones);
});
</script>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_link">Ссылка (с http:// или https://)</label>
					<input type="text" class="form-control" id="lk_link" name='PROPERTY[<? echo $arResult['PROPERTIES']['link']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['link']['VALUE']; ?>" placeholder='http://ya.ru или https://ya.ru'>
				</div>
			</div>

			<div id='normal'>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
							array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
									'previewPictureId' => $arResult['PROPERTIES']['flash']['VALUE'],
									'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"],
									'title1' => 'Основной баннер (jpg, gif, png, swf (FLASH))',
									'title2' => 'Альтернативный баннер (JPG)',
									'page' => 'banners'),
							array());
//*********************************************************************************************************************************
?>
			</div>

			<div id='html' class='hide'>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_htmlCode">HTML код</label>
						<textarea class='form-control maintextarea' id="lk_htmlCode" name="PROPERTY[<? echo PROPERTY_ID_HTML_CODE_IN_BANNERS; ?>][0]"></textarea>
					</div>
				</div>
			</div>
		</div>

		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement'>
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
		<input type="hidden" name="PROPERTY[ACTIVE][0]" value="N">
		<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
		<div class="errorBlock hide" id='errorPage'>Выберите страницу размещения</div>
	</div>
	<div class="previewBlock"></div>
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