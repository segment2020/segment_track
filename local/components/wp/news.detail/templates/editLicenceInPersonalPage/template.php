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

if (isset($_GET['errorStr']) && !empty($_GET['errorStr']))
{
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

if (isset($_GET['msg']) && !empty($_GET['msg']))
{
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
//pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_ELEMENT_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">

<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название лицензии', 'name' => $arResult['NAME'], 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT']), array());
//*********************************************************************************************************************************		


//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?> 

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_country">Страна</label>
<?
						$fieldName = 'PROPERTY[' . $arResult['PROPERTIES']['country']['ID'] . '][0]';
						echo SelectBoxFromArray($fieldName, GetCountryArray(), $arResult['PROPERTIES']['country']['VALUE'], "< Выберите страну >", 'class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true"');
?>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_type">Тип</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['type']['ID'] . ']'; ?>" id="lk_type" tabindex="-98">
						<option value="">Нет</option>
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

<?
	//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
							array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
									'previewPictureId' => $arResult["PREVIEW_PICTURE"]["ID"],
									'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"]),
							array());
//*********************************************************************************************************************************
?>			
			
<? /* ?>
			<div class="col-xs-12">
				<div class="lk_companylogoblock clearfix">
					<div class="lk_companylogoimg floatleft">
<?
						if ($arResult["PREVIEW_PICTURE"]["SRC"])
							$file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						else
							$file['src'] = '';
?>
						<img src="<? echo $file["src"]; ?>" border="0" />
					</div>
					<div class="lk_companylogotext ">
						<div class="lk_companylogotitle">Изображение:</div>
						<div class="lk_companylogobtn">
							<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $arResult["PREVIEW_PICTURE"]["ID"]; ?>" />
							<input type="file" name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</div>
					</div>
					<div class="seporator lksep"></div>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="lk_companylogoblock clearfix">
					<div class="lk_companylogoimg floatleft">
<?
						if ($arResult["DETAIL_PICTURE"]["SRC"])
							$file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						else
							$file['src'] = '';
?>
						<img src="<? echo $file["src"]; ?>" border="0" />
					</div>
					<div class="lk_companylogotext ">
						<div class="lk_companylogotitle">Изображение для детальной страницы:</div>
						<div class="lk_companylogobtn">
							<input type="hidden" name="PROPERTY[DETAIL_PICTURE][0]" value="<? echo $arResult["DETAIL_PICTURE"]["ID"]; ?>" />
							<input type="file" name="PROPERTY_FILE_DETAIL_PICTURE_0" />
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</div>
					</div>
					<div class="seporator lksep"></div>
				</div>
			</div>
<? */ ?>		
		</div>

		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='updateElement' />
		<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
		<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>
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