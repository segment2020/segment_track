<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Компания");
?>

<div class="container-fluid">
	<div class="row">

<?
// Грязный хак - компонент получает ID компании из GET парамерта CODE. При обновлении формы этот параметр теряется. Подставим его вручную.
$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch();
	
$_REQUEST['CODE'] = $arUser['UF_ID_COMPANY'];

$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "companyProfile", Array(
	"COMPONENT_TEMPLATE" => "companyProfile",
		"IBLOCK_TYPE" => "Company",	// Тип инфоблока
		"IBLOCK_ID" => "1",	// Инфоблок
		"STATUS_NEW" => "N",	// Деактивировать элемент
		"LIST_URL" => "",	// Страница со списком своих элементов
		"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
		"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
		"USER_MESSAGE_ADD" => "",	// Сообщение об успешном добавлении
		"DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
		"RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
		"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
			0 => PROPERTY_ID_ADDRESS,
			1 => PROPERTY_ID_PHONE,
			2 => "20",
			3 => "21",
			4 => "65",
			5 => "66",
			6 => "67",
			7 => "68",
			8 => "97",
			9 => "98",
			10 => PROPERTY_ID_POSITION,
			11 => "NAME",
			12 => "IBLOCK_SECTION",
			13 => "PREVIEW_TEXT",
			14 => "PREVIEW_PICTURE",
			15 => PROPERTY_ID_CITY,
			16 => PROPERTY_ID_REGION,
			17 => PROPERTY_ID_AREA,
			18 => PROPERTY_ID_CONDITION_EMP,
			19 => PROPERTY_ID_ADDRESS_ADD_OFFICES,
			20 => PROPERTY_ID_ADD_PHONE,
			21 => PROPERTY_ID_SOCIAL_NETWORK_VK,
			22 => PROPERTY_ID_SOCIAL_NETWORK_FB,
			23 => PROPERTY_ID_SOCIAL_NETWORK_GOOGLE,
			24 => PROPERTY_ID_SOCIAL_NETWORK_INSTAGRAMM,
			25 => PROPERTY_ID_COUNTRY,
		),
		"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
			0 => "17",
			1 => "19",
			2 => "21",
			3 => "NAME",
		),
		"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
			0 => "5",
		),
		"STATUS" => "ANY",	// Редактирование возможно
		"ELEMENT_ASSOC" => "PROPERTY_ID",	// Привязка к пользователю
		"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
		"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
		"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
		"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования текста анонса
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования подробного текста
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"CUSTOM_TITLE_NAME" => "Название компании",	// * наименование *
		"CUSTOM_TITLE_TAGS" => "",	// * теги *
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Описание компании",	// * текст анонса *
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
		"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
		"ELEMENT_ASSOC_PROPERTY" => "110",	// по свойству инфоблока -->
	),
	false
);
?>

<?
global $arrFilter;
$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY']);

$APPLICATION->IncludeComponent("bitrix:news.list", "companyProfilePriceList", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "16",	// Код информационного блока
		"IBLOCK_TYPE" => "-",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "file",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
?>

	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>