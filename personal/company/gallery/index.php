<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");
?>
<div class="container-fluid">
	<div class="row">

<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
	$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
	$arUser = $rsUser->Fetch(); 
	$arResult["PERSONAL_PHOTO_HTML"] = CFile::ShowImage($arUser["PERSONAL_PHOTO"], 80, 80, "border=0", "", true); //$arUser["PERSONAL_PHOTO"] - тут находится id аватарки, здесь мы получим HTML-код для вывода нужного изображения 
}

// pre($arResult);
//pre($arUser);

$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);

if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("IBLOCK_ID", 'ID', "NAME");
	$arFilter = array("IBLOCK_ID" => 1, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();
}
?>
<div class="col-sm-3 col-xs-12 order-xs-1 content-margin" id="article">
	<div id="getFixed" class="lkmenuslide">
		<div class=" content-margin">
			<div class="block-default block-shadow lk_userinfo clearfix">
				<div class="lk_userinfoimg floatleft">
					<img src="<? echo $leftSideAvatarFile["src"]; ?>">
				</div>
				<div class="lk_userinfotext">
					<div class="lk_userinfoname">
						<? echo (CUser::GetFirstName())?CUser::GetFirstName():CUser::GetLogin(); ?>
					</div>
					<div class="lk_userinfofirm">
						<div><? echo $arUser["WORK_POSITION"]; ?></div>
						<div><? echo $arFields['NAME']; ?></div>
					</div>
					<div class="lk_userinfobtn">
						<a href="/personal/" class="btn btn-blue-full btnmin minbr lk_userinfobtnf">Редактировать</a>
						<a href="/?logout=yes" class="btn btn-blue-full btnmin minbr">Выход</a>
					</div>
				</div>
			</div>
		</div>
		<div class="content-margin">
			<div class="list-group block-shadow lk_lmenu clearfix" id="collapselkmenu">
				<?$APPLICATION->IncludeFile('/tpl/include_area/newPersonalPageMenu.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'companyName' => $arFields['NAME']), array());?>
			</div>
		</div>
	</div>
</div>

<?
global $arrFilter;
$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY'], 'PROPERTY_archive' => '');

if (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
	$iBlockId = (int)$_GET["iBlockId"];
	if ( (IBLOCK_ID_GALLERY_PHOTO !== $iBlockId) && (IBLOCK_ID_GALLERY_VIDEO !== $iBlockId) )
		$iBlockId = IBLOCK_ID_GALLERY_PHOTO;

	// Фото и видео компании. 
	$APPLICATION->IncludeComponent("bitrix:news.list", "companyPhotoVideoEdit", Array(
		"COMPONENT_TEMPLATE" => "companyPhotoVideoEdit",
			"IBLOCK_TYPE" => "-",	// Тип информационного блока (используется только для проверки)
			"IBLOCK_ID" => $iBlockId,	// Код информационного блока
			"NEWS_COUNT" => "10",	// Количество новостей на странице
			"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
			"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
			"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
			"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
			"FILTER_NAME" => "arrFilter",	// Фильтр
			"FIELD_CODE" => array(	// Поля
				0 => "SHOW_COUNTER",
				1 => "DATE_CREATE",
				2 => "",
			),
			"PROPERTY_CODE" => array(	// Свойства
				0 => "",
				1 => "newsSource",
				2 => "imgSource",
				3 => "FORUM_MESSAGE_CNT",
				4 => "imgString",
				5 => "PUB_REJECTED",
				6 => "REASON_FOR_REJ",
			),
			"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
			"DETAIL_URL" => "/personal/company/gallery/edit/?elementId=#ELEMENT_ID#&iBlockId=#IBLOCK_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
			"AJAX_MODE" => "N",	// Включить режим AJAX
			"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
			"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
			"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
			"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
			"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
			"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
			"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
			"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
			"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
			"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
			"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
			"PARENT_SECTION" => "",	// ID раздела
			"PARENT_SECTION_CODE" => "",	// Код раздела
			"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
			"DISPLAY_DATE" => "Y",	// Выводить дату элемента
			"DISPLAY_NAME" => "Y",	// Выводить название элемента
			"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
			"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
			"PAGER_TEMPLATE" => "custom",	// Шаблон постраничной навигации
			"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
			"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
			"PAGER_TITLE" => "Новости",	// Название категорий
			"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
			"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
			"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
			"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
			"SET_STATUS_404" => "N",	// Устанавливать статус 404
			"SHOW_404" => "N",	// Показ специальной страницы
			"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
			"DETAIL_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"LIST_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		),
		false
	);
}
else
{
?>
	<div class="col-sm-3 col-xs-12 content-margin" id="article">
		<a href="/personal/company/gallery/?iBlockId=<? echo IBLOCK_ID_GALLERY_PHOTO; ?>" class="list-group-item">Фотогалерея</a>
		<a href="/personal/company/gallery/?iBlockId=<? echo IBLOCK_ID_GALLERY_VIDEO; ?>" class="list-group-item">Видеогалерея</a>
	</div>
<?
}
?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>