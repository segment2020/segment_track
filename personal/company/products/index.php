<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Товары");
?>

<div class="container-fluid">
	<div class="row">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<div class="col-sm-9 col-xs-12 content-margin">
	<h1>Каталог товаров</h1>
	<a href='/personal/company/products/hits/'>Показать хиты</a>
<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
    $currentUserId = $USER->GetID();
    $rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
    $arUser = $rsUser->Fetch();

	global $arrFilter;
	$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY']);

	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"productsInPersonalPage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "12",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "custom",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "hit",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "productsInPersonalPage"
	),
	false
);

/*
	$APPLICATION->IncludeComponent("bitrix:catalog.section", "hitsInPersonalPage", Array(
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
			"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
			"ADD_PROPERTIES_TO_BASKET" => "N",	// Добавлять в корзину свойства товаров и предложений
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
			"AJAX_MODE" => "N",	// Включить режим AJAX
			"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
			"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
			"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
			"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
			"BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
			"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
			"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
			"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_TYPE" => "A",	// Тип кеширования
			"COMPATIBLE_MODE" => "N",	// Включить режим совместимости
			"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
			"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
			"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
			"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
			"DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
			"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком
			"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
			"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
			"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
			"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
			"ENLARGE_PRODUCT" => "STRICT",	// Выделять товары в списке
			"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
			"HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
			"IBLOCK_ID" => "3",	// Инфоблок
			"IBLOCK_TYPE" => "Catalog",	// Тип инфоблока
			"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
			"LABEL_PROP" => "",	// Свойства меток товара
			"LAZY_LOAD" => "N",	// Показать кнопку ленивой загрузки Lazy Load
			"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
			"LOAD_ON_SCROLL" => "N",	// Подгружать товары при прокрутке до конца
			"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
			"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
			"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
			"MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
			"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
			"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
			"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
			"OFFERS_LIMIT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
			"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
			"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
			"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
			"PAGER_TEMPLATE" => "custom",	// Шаблон постраничной навигации
			"PAGER_TITLE" => "Товары",	// Название категорий
			"PAGE_ELEMENT_COUNT" => "10",	// Количество элементов на странице
			"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
			"PRICE_CODE" => array(	// Тип цены
				0 => "rub",
			),
			"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
			"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",	// Порядок отображения блоков товара
			"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
			"PRODUCT_PROPERTIES" => "",	// Характеристики товара
			"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
			"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'8','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",	// Вариант отображения товаров
			"PRODUCT_SUBSCRIPTION" => "Y",	// Разрешить оповещения для отсутствующих товаров
			"PROPERTY_CODE" => array(	// Свойства
				0 => "brand",
				1 => "",
			),
			"PROPERTY_CODE_MOBILE" => "",	// Свойства товаров, отображаемые на мобильных устройствах
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],	// Параметр ID продукта (для товарных рекомендаций)
			"RCM_TYPE" => "personal",	// Тип рекомендации
			"SECTION_CODE" => "",	// Код раздела
			"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
			"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"SECTION_USER_FIELDS" => array(	// Свойства раздела
				0 => "",
				1 => "",
			),
			"SEF_MODE" => "N",	// Включить поддержку ЧПУ
			"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
			"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
			"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
			"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
			"SET_STATUS_404" => "N",	// Устанавливать статус 404
			"SET_TITLE" => "N",	// Устанавливать заголовок страницы
			"SHOW_404" => "N",	// Показ специальной страницы
			"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
			"SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
			"SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
			"SHOW_FROM_SECTION" => "N",	// Показывать товары из раздела
			"SHOW_MAX_QUANTITY" => "N",	// Показывать остаток товара
			"SHOW_OLD_PRICE" => "N",	// Показывать старую цену
			"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
			"SHOW_SLIDER" => "N",	// Показывать слайдер для товаров
			"TEMPLATE_THEME" => "blue",	// Цветовая тема
			"USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
			"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
			"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
			"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
			"COMPONENT_TEMPLATE" => "hits",
			"SLIDER_INTERVAL" => "3000",
			"SLIDER_PROGRESS" => "N"
		),
		false
	);
*/
}
?>

		</div> <!-- end div class="col-sm-9 col-xs-12 content-margin"> -->
	</div> <!-- end div class="row"> -->
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>