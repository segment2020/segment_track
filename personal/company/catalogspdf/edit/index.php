<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление/редактирование каталога");
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
	$APPLICATION->IncludeComponent("wp:news.detail", "editCatalogPdfInPersonalPage", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/catalogspdf/edit/#ELEMENT_CODE#/",	// Код новости
		"ELEMENT_ID" => $_REQUEST["elementId"],	// ID новости
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "SHOW_COUNTER",
			6 => "",
		),
		"IBLOCK_ID" => "22",	// Код информационного блока
		"IBLOCK_TYPE" => "catalogsPdf",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Страница",	// Название категорий
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "imgString",
			2 => "SHOW_COUNTER",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа элемента
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
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
		<h1>Добавить каталог</h1>
		<div class="block-default in block-shadow content-margin">
			<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название каталога', 'includePreviewText' => 'true', 'previewTextTitle' => 'Описание каталога', 'includeDetailText' => 'false'), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
//*********************************************************************************************************************************
?>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_country">Страна</label>
<?
						$fieldName = 'PROPERTY[' . PROPERTY_ID_COUNTRY_IN_CATALOGS_PDF . '][0]';
						echo SelectBoxFromArray($fieldName, GetCountryArray(), '', "< Выберите страну >", 'class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true"');
?>
					</div>
				</div>

				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_phone">Телефон</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_PHONE_IN_CATALOGS_PDF; ?>][0]' id="lk_phone" class="form-control" value="">
					</div>
				</div>

				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_email">email</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_EMAIL_IN_CATALOGS_PDF; ?>][0]' id="lk_email" class="form-control"  value="">
					</div>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="block-default in block-shadow content-margin" id='catalogFile'>
					<div class="lk_companylogoblock  clearfix">
						<div class="lk_companylogoimg lk_companylogoimgEditForm floatleft">
							<img src="" border="0" />
						</div>
						<div class="lk_companylogotextEditForm">
							<div class="lk_companylogotitle">Каталог PDF</div>
							<div class="lk_companylogobtn">
								<input type="hidden" name="PROPERTY[<? echo PROPERTY_ID_FILE_IN_CATALOGS_PDF; ?>][0]" value="" />
								<input type="file" class='hide fileUpload' id='catalog' name="PROPERTY_FILE_<? echo PROPERTY_ID_FILE_IN_CATALOGS_PDF; ?>_0" />
								<label for='catalog'>
									<div class="btn btn-blue btnplus minbr">
										<span class="plus text-center">+</span>Выбрать каталог
									</div>
								</label>
								<span id='catalogFileName'></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
			<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
			<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
			<div class="errorBlock hide" id='errorExt'>Только PDF</div>
		</div>
		<div class="previewBlock"></div>
	</div>
	</form>
<?
}
?>


<?
/*
		<div id="drop_zone">
			Drop file here
		</div>
		<script>
  function handleFileSelect(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  function handleDragOver(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }

  // Setup the dnd listeners.
  var dropZone = document.getElementById('drop_zone');
  dropZone.addEventListener('dragover', handleDragOver, false);
  dropZone.addEventListener('drop', handleFileSelect, false);
</script>
*/
?>

	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>