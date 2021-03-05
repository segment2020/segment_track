<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить лицензию");
?>
<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 


if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("NAME", 'PROPERTY_paidLicensesNum');
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
if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
{
	$APPLICATION->IncludeComponent("wp:news.detail", "editLicenceInPersonalPage", Array(
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
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/license/edit/#ELEMENT_CODE#/",	// Код новости
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
		"IBLOCK_ID" => IBLOCK_ID_LICENSE,	// Код информационного блока
		"IBLOCK_TYPE" => "license",	// Тип информационного блока (используется только для проверки)
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
		"COMPONENT_TEMPLATE" => "editStocksInPersonalPage"
	),
	false
);
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-sm-9 col-xs-12 content-margin" id="article">
		<h1>Добавить лицензию</h1>
		<div class="block-default in block-shadow content-margin ">
			<div class="row">
				<div class="col-sm-9 col-xs-12">
					<div class="lk_companycatchek">
					<?
					$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arProps['paidOption']['IBLOCK_ID'], 'CODE' => $arProps['paidOption']['CODE']));
					if ($enumFields = $propertyEnums->GetNext())
						$propId = $enumFields['ID'];
					?>
						<div class="mycheckbox">
							<label>
								<input name="<? echo 'PROPERTY[' . $arProps['paidOption']['ID'] . ']'; ?>" type="checkbox" value="<? echo $propId; ?>">
								Платно
							</label>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12">
					<div class="lk_companycatchek">
						<div class="mycheckbox">
							Осталось: <? echo $arFields['PROPERTY_PAIDLICENSESNUM_VALUE']; ?>
						</div>
					</div>
				</div>

<?
				//*********************************************************************************************************************************
				$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название лицензии'), array());
				//*********************************************************************************************************************************		
?> 

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

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_country">Страна</label>
<?
						$fieldName = 'PROPERTY[' . $arProps['country']['ID'] . '][0]';
						echo SelectBoxFromArray($fieldName, GetCountryArray(), '', "< Выберите страну >", 'class="selectpicker selectboxbtn form-control minbr typeselect" data-live-search="true"');
?>
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