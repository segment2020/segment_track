<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/admin_tools.php";
$APPLICATION->SetTitle("Добавить товар");

if (!CModule::includeModule("iblock") || !CModule::includeModule('fileman')) {
    echo 'нет нужных модулей';
}
?>

<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 


if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("NAME", 'PROPERTY_paidHitsNum');
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 21), $arSelect);
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
	"editProductsInPersonalPage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
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
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/products/edit/#ELEMENT_CODE#/",
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
		"IBLOCK_ID" => IBLOCK_ID_CATALOG,
		"IBLOCK_TYPE" => "Catalog",
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
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "editProductsInPersonalPage"
	),
	false
);
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage' id='newProduct'>
	<?=bitrix_sessid_post()?>

	<div class="col-sm-9 col-xs-12 content-margin" id="article">
		<h1>Добавить товар</h1>
		<div class="block-default in block-shadow content-margin">
			<div class="row">
				<div class="col-sm-9 col-xs-12">
					<div class="lk_companycatchek">
					<?
						$disabled = '';
						if ('0' == $arFields['PROPERTY_PAIDHITSNUM_VALUE'])
							$disabled = 'disabled';

						$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arProps['hit']['IBLOCK_ID'], 'CODE' => $arProps['hit']['CODE']));
						if ($enumFields = $propertyEnums->GetNext())
							$propId = $enumFields['ID'];
					?>
						<div class="mycheckbox"><label><input name="<? echo 'PROPERTY[' . $arProps['hit']['ID'] . ']'; ?>" type="checkbox" <? echo $disabled; ?> value="<? echo $propId; ?>">Хит</label></div>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12">
					<div class="lk_companycatchek">
						<div class="mycheckbox">
							Осталось: <? echo $arFields['PROPERTY_PAIDHITSNUM_VALUE']; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название товара', 'name' => $arResult['NAME'], 'previewTextTitle' => 'Описание', 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT'], 'includeDetailText' => 'false', 'catalog' => true), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
//*********************************************************************************************************************************
?>
			</div>

			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label class="control-label mainlabel" for="catalogId">Выберите категорию</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" id="catalogId" name="catalogId" tabindex="-98">
							<option value=""></option>
<?
						$blockId = IBLOCK_ID_CATALOG;
						$items = GetIBlockSectionList($blockId, 0, array("sort" => "asc"));
							while ($arItem = $items->GetNext())
								echo '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';
?>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group hide" id='categoryListBlock'>
						<label class="control-label mainlabel" for="categoryId">Выберите раздел</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='categoryId' name='PROPERTY[IBLOCK_SECTION][0]'>
						</select>	
					</div>
				</div>
		<?
			/*
				<div class="col-xs-4">
					<div class="form-group hide" id='categoryListBlock'>
						<label class="control-label mainlabel" for="categoryId">Выберите раздел</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='categoryId' name='categoryId'>
						</select>	
					</div>
				</div>

				<div class="col-xs-4">
					<div class="form-group hide" id='subCategoryListBlock'>
						<label class="control-label mainlabel" for="subCategoryId">Выбрите подраздел</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='subCategoryId' name='PROPERTY[IBLOCK_SECTION][]'>
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
						<input type="text" class="form-control" id="lk_article" name='PROPERTY[<? echo $arProps['article']['ID']; ?>][0]' value="<? echo $arProps['article']['VALUE']; ?>">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="addLicenses">Выбрать лицензию</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arProps['licenses']['ID'] . '][0]'; ?>" id="addLicenses" tabindex="-98">
							<option value="">Нет</option>
		<?
							$arSelect = Array("ID", "NAME");
							$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_LICENSE, "ACTIVE" => "Y");
							$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
							while($ob = $res->GetNextElement()) {
								$arFields = $ob->GetFields(); ?>
								<option value="<? echo $arFields['ID']; ?>"><? echo $arFields['NAME']; ?></option>
		<?					} ?>
						</select>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="addBrand">Выбрать бренд</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arProps['brand']['ID'] . '][0]'; ?>" id="addBrand" tabindex="-98">
							<option value="">Нет</option>
		<?
							$arSelect = Array("ID", "NAME");
							$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BRANDS, "ACTIVE" => "Y");
							$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
							while($ob = $res->GetNextElement()) {
								$arFields = $ob->GetFields(); ?>
								<option value="<? echo $arFields['ID']; ?>"><? echo $arFields['NAME']; ?></option>
		<?					} ?>
						</select>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_price">Цена в рублях</label>
						<input type="text" class="form-control" id="lk_price" name='PROPERTY[<? echo $arProps['price']['ID']; ?>][0]' value="<? echo $price; ?>">
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
?>

<div class="col-xs-12" id='fileList'>
<?
// Ести доп. код для этого в \www\segment.wps2.qh0.ru\local\components\wp\iblock.element.add.form\component.php
// Искать по коментарию - ZZZ добавление картинок через загрузчик.
	_ShowPropertyField(
	// 'PROPERTY[' . PROPERTY_ID_ADD_PHOTO_IN_CATALOG . ']', 
	'PROPERTY[' . PROPERTY_ID_ADD_PHOTO_IN_CATALOG . ']', 
	Array(
		'ID' => PROPERTY_ID_ADD_PHOTO_IN_CATALOG,
		//'TIMESTAMP_X' => '2017-05-05 14:45:56',
		'IBLOCK_ID' => IBLOCK_ID_CATALOG,
		'NAME' => 'Дополнительные фото',
		'ACTIVE' => 'Y',
		'SORT' => 500,
		'CODE' => PROPERTY_CODE_ADD_PHOTO_IN_CATALOG,
		'DEFAULT_VALUE' => '',
		'PROPERTY_TYPE' => 'F',
		'ROW_COUNT' => 1,
		'COL_COUNT' => 30,
		'LIST_TYPE' => 'L', 
		'MULTIPLE' => 'Y',
		'XML_ID' => '',
		'FILE_TYPE' => '',
		'MULTIPLE_CNT' => 5,
		'TMP_ID' => '',
		'LINK_IBLOCK_ID' => 0,
		'WITH_DESCRIPTION' => 'N',
		'SEARCHABLE' => 'N',
		'FILTRABLE' => 'N',
		'IS_REQUIRED' => 'N',
		'VERSION' => 1,
		'USER_TYPE' => '',
		'USER_TYPE_SETTINGS' => '',
		'HINT' => '',
		'VALUE' => Array(),
		'~VALUE' => Array()
	),
	array(), 
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
				<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
				<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
				<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
				<div class="errorBlock errorBlockCategory hide" id='errorCategory'>Выберите категорию</div>
			</div>
		</div>
		<div class="previewBlock"></div>
	</div>
	</form>
<?
}
?>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var subCategory = document.getElementById('categoryId');

	document.getElementById('newProduct').addEventListener('submit', function(event){
		console.log(subCategory.options.length); // Количество option.
		if (0 == subCategory.options.length)
		{
			document.getElementById('errorCategory').classList.remove('hide');
			event.preventDefault();
			return false;
		}

		var category = document.getElementById('categoryId');
		if (!!category && '' == category.value)
		{
			document.getElementById('errorCategory').classList.remove('hide');
			event.preventDefault();
			return false;
		}
	});
	
	
	/*
	var subCategory = document.getElementById('subCategoryId');
	console.log(subCategory);
	document.getElementById('newProduct').addEventListener('submit', function(event){
		if (1 == subCategory.options.length)
		{
			var category = document.getElementById('categoryId');
			category.name = 'PROPERTY[IBLOCK_SECTION][]';
			subCategory.name = '';
			var subCategoryFlag = true;
		}

		if (!!subCategoryFlag)
		{
			if (!!category && '' == category.value)
			{
				document.getElementById('errorCategory').classList.remove('hide');
				event.preventDefault();
				return false;
			}
			else if (!!category && '' != category.value)
			{
				console.log(category);
				document.getElementById('errorCategory').classList.add('hide');
			}
		}
		else
		{
			if (!!subCategory && '' == subCategory.value)
			{
				document.getElementById('errorCategory').classList.remove('hide');
				event.preventDefault();
				return false;
			}
			else if (!!subCategory && '' != subCategory.value)
			{
				document.getElementById('errorCategory').classList.add('hide');
				if ('' == subCategory.name)
					subCategory.name = 'PROPERTY[IBLOCK_SECTION][]';

				document.getElementById('categoryId').name = 'categoryId';
			}
		}
	});
	
	*/
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>