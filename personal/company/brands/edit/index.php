<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить бренд");
?>
<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 


if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("NAME", 'PROPERTY_paidBrandsNum');
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();

	$arSelect = array();
	$arFilter = array("IBLOCK_ID" => $_GET['iBlockId'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arProps = $ob->GetProperties();
}
?>


<?
// pre($arProps);
if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
{
	$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"editBrandsInPersonalPage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/brands/edit/#ELEMENT_CODE#/",
		"ELEMENT_ID" => $_REQUEST["elementId"],
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "SHOW_COUNTER",
			6 => "",
		),
		"IBLOCK_ID" => IBLOCK_ID_BRANDS,
		"IBLOCK_TYPE" => "brands",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "imgString",
			2 => "SHOW_COUNTER",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "editBrandsInPersonalPage"
	),
	false
);
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
		<h1>Добавить бренд</h1>
		<div class="block-default in block-shadow content-margin" id='brands'>
			<div class="row">
				<div class="col-xs-9">
					<div class="lk_companycatchek">
					<?
					$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arProps['paidOption']['IBLOCK_ID'], 'CODE' => $arProps['paidOption']['CODE']));
					if ($enumFields = $propertyEnums->GetNext())
						$propId = $enumFields['ID'];
					?>
						<div class="mycheckbox">
							<label>
								<input name="<? echo 'PROPERTY[' . $arProps['paidOption']['ID'] . ']'; ?>" type="checkbox" checked="" value="<? echo $propId; ?>">
								Платно
							</label>
						</div>
					</div>
				</div>

				<div class="col-xs-3">
					<div class="lk_companycatchek">
						<div class="mycheckbox">
							Осталось: <? echo $arFields['PROPERTY_PAIDBRANDSNUM_VALUE']; ?>
						</div>
					</div>
				</div>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название бренда', 'name' => $arResult['NAME'], 'previewTextTitle' => 'Описание', 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT'], 'detailTextTitle' => 'Развёрнутое описание', 'includePreviewText' => 'true', 'includeDetailText' => 'true'), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
//*********************************************************************************************************************************
?>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_country">Страна</label>
<?
						$fieldName = 'PROPERTY[' . $arProps['country']['ID'] . '][0]';
						echo SelectBoxFromArray($fieldName, GetCountryArray(), '', "< Выберите страну >", 'class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true"');
?>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_type">Тип</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . $arProps['type']['ID'] . ']'; ?>" id="lk_type" tabindex="-98">
							<option value="">Нет</option>
						<?
							$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arProps['type']['IBLOCK_ID'], 'CODE' => $arProps['type']['CODE']));
							while ($enumFields = $propertyEnums->GetNext()) { ?>
								<option value="<? echo $enumFields['ID']; ?>"><? echo $enumFields['VALUE']; ?></option>
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
									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"],
									'title1' => 'Фото логотипа',
									'title2' => 'Фото для детальной страницы'),
							array());
//*********************************************************************************************************************************
?>
			</div>

			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
			<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
			<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
			<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>
		</div>
		<div class="previewBlock"></div>
	</div>
	</form>
<?
}
?>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>