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
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/admin_tools.php";
if (!CModule::includeModule("iblock") || !CModule::includeModule('fileman')) {
    echo 'нет нужных модулей';
}
?>

<form name="iblock_add" action="/editelement/?edit=Y&CODE=<? echo $arResult['ID']; ?>" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage' id='newProduct'>
	<?=bitrix_sessid_post()?>

<div class="col-xs-9 content-margin" id="article">
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
// pre($arParams);
// pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_ELEMENT_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
		<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название товара', 'name' => $arResult['NAME'], 'previewTextTitle' => 'Описание', 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT'], 'includeDetailText' => 'false'), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>
		</div>
<?
// pre($arResult);
$categories = array();
$arSelect = array('ID');
$resSection = CIBlockSection::GetNavChain(IBLOCK_ID_CATALOG, $arResult['IBLOCK_SECTION_ID'], $arSelect);
while ($arSection = $resSection->GetNext())
	$categories[] = $arSection['ID'];
?>
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
					<label class="control-label mainlabel" for="catalogId">Выберите категорию</label>
					<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" id="catalogId" name="catalogId" tabindex="-98">
<?
						$items = GetIBlockSectionList(IBLOCK_ID_CATALOG, 0, array("sort" => "asc"));
						while ($arItem = $items->GetNext())
						{
							$selected = '';
							if ($arItem['ID'] == $categories[0])
								$selected = 'selected';

							echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
						}
?>
					</select>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group" id='categoryListBlock'>
					<label class="control-label mainlabel" for="categoryId">Выберите раздел</label>
					<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='categoryId' name='PROPERTY[IBLOCK_SECTION][]'>
<?
						$items = GetIBlockSectionList(IBLOCK_ID_CATALOG, $categories[0], array("sort" => "asc"));
						while ($arItem = $items->GetNext())
						{
							$selected = '';
							if ($arItem['ID'] == $categories[1])
								$selected = 'selected';
						
							echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
						}
?>
					</select>	
				</div>
			</div>
			
			
						<?
			/*
			<div class="col-xs-4">
				<div class="form-group" id='categoryListBlock'>
					<label class="control-label mainlabel" for="categoryId">Выберите раздел</label>
					<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='categoryId' name='categoryId'>
<?
						$items = GetIBlockSectionList(IBLOCK_ID_CATALOG, $categories[0], array("sort" => "asc"));
						while ($arItem = $items->GetNext())
						{
							$selected = '';
							if ($arItem['ID'] == $categories[1])
								$selected = 'selected';
						
							echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
						}
?>
					</select>	
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group" id='subCategoryListBlock'>
					<label class="control-label mainlabel" for="subCategoryId">Выбрите подраздел</label>
					<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='subCategoryId' name='PROPERTY[IBLOCK_SECTION][]'>
<?
						$items = GetIBlockSectionList(IBLOCK_ID_CATALOG, $categories[1], array("sort" => "asc"));
						while ($arItem = $items->GetNext())
						{
							$selected = '';
							if ($arItem['ID'] == $arResult['IBLOCK_SECTION_ID'])
								$selected = 'selected';
						
							echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
						}
?>
					</select>
				</div>
			</div>
			*/
			?>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_article">Артикул</label>
					<input type="text" class="form-control" id="lk_article" name='PROPERTY[<? echo $arResult['PROPERTIES']['article']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['article']['VALUE']; ?>">
				</div>
			</div>

		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="addLicenses">Выбрать лицензию</label>
				<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['licenses']['ID'] . '][0]'; ?>" id="addLicenses" tabindex="-98">
					<option value="">Нет</option>
<?
					$arSelect = Array("ID", "NAME");
					$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_LICENSE, "ACTIVE" => "Y");
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
					while($ob = $res->GetNextElement()) {
						$arFields = $ob->GetFields();

						$selected = '';
						if ($arFields['ID'] == $arResult['PROPERTIES']['licenses']['VALUE'])
							$selected = 'selected';	?>
						<option value="<? echo $arFields['ID']; ?>" <? echo $selected; ?>><? echo $arFields['NAME']; ?></option>
<?					} ?>
				</select>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="addBrand">Выбрать бренд</label>
				<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['brand']['ID'] . '][0]'; ?>" id="addBrand" tabindex="-98">
					<option value="">Нет</option>
<?
					$arSelect = Array("ID", "NAME");
					$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BRANDS, "ACTIVE" => "Y");
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
					while($ob = $res->GetNextElement()) {
						$arFields = $ob->GetFields();

						$selected = '';
						if ($arFields['ID'] == $arResult['PROPERTIES']['brand']['VALUE'])
							$selected = 'selected'; ?>
						<option value="<? echo $arFields['ID']; ?>" <? echo $selected; ?>><? echo $arFields['NAME']; ?></option>
<?					} ?>
				</select>
			</div>
		</div>

<?
		$checked = '';
		if ('Y' == $arResult['PROPERTIES']['hit']['VALUE'])
			$checked = 'checked';
?>
		<div class="col-xs-12">
			<div class="lk_companycatchek">
			<?
				$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arResult['PROPERTIES']['hit']['IBLOCK_ID'], 'CODE' => $arResult['PROPERTIES']['hit']['CODE']));
				if ($enumFields = $propertyEnums->GetNext())
					$propId = $enumFields['ID'];
			?>
				<div class="mycheckbox"><label><input name="<? echo 'PROPERTY[' . $arResult['PROPERTIES']['hit']['ID'] . ']'; ?>" type="checkbox" <? echo $checked; ?> value="<? echo $propId; ?>">Хит</label></div>
			</div>
		</div>

		<?
		$res = CPrice::GetList(array(), array("PRODUCT_ID" => $arResult['ID'], "CATALOG_GROUP_ID" => 1));
		if ($arr = $res->Fetch()) {
			$price = $arr["PRICE"];
		}
		?>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="lk_price">Цена в рублях</label>
				<input type="text" class="form-control" id="lk_price" name='PROPERTY[<? echo $arResult['PROPERTIES']['price']['ID']; ?>][0]' value="<? echo $price; ?>">
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

			<div class="col-xs-12" id='fileList'>
<?
	_ShowPropertyField(
		'PROPERTY[' . PROPERTY_ID_ADD_PHOTO_IN_CATALOG . ']', 
		$arResult['PROPERTIES'][PROPERTY_CODE_ADD_PHOTO_IN_CATALOG], 
		$arResult['PROPERTIES'][PROPERTY_CODE_ADD_PHOTO_IN_CATALOG]["VALUE"], 
		false, 
		false, 
		50000, 
		'iblock_add'
	);
?>
			</div>
		</div>

		<div class='marginTop15px'>
			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
			<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
			<input type="hidden" name="PROPERTY[ACTIVE][0]" value="N">
			<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
			<div class="errorBlockCategory hide" id='errorCategory'>Выберите категорию</div>
			<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>
		</div>
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