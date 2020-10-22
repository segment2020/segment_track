<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


if (isset($_POST['blockId']) && !empty($_POST['blockId']))
// if (true)
{
	if ('9999' == $_POST['blockId']) // Всё.
	{
		$blockId = array(   
                            // 0 => "1",
							1 => "2",
							2 => "4",
							3 => "5",
							4 => "8",
							5 => "9",
							6 => "10",
							7 => "14",
							8 => "15",
							9 => "17",
						);
		$num = 3;
	}
	else
	{
		$blockId = $_POST['blockId'];
		$num = 15;
	}

	$APPLICATION->IncludeComponent("bitrix:news.index", "newOnSite", Array(
			"IBLOCKS" => $blockId,
			"NEWS_COUNT" => $num,				// Количество новостей в каждом блоке
			"IBLOCK_SORT_BY" => "ID",			// Поле для сортировки информационных блоков
			"IBLOCK_SORT_ORDER" => "ASC",		// Направление для сортировки информационных блоков
			"SORT_BY1" => "ID",					// Поле для первой сортировки новостей
			"SORT_ORDER1" => "RAND",			// Направление для первой сортировки новостей
			"FIELD_CODE" => array(				// Поля
				0 => "SHOW_COUNTER",
				1 => "FORUM_MESSAGE_CNT",
				2 => "DATE_CREATE",
				3 => "PREVIEW_PICTURE",
				4 => "PREVIEW_TEXT",
			),
			"PROPERTY_CODE" => array(			// Свойства
				0 => "",
				1 => "TOINDEX",
				2 => "actualToday",
				3 => "FORUM_MESSAGE_CNT",
				4 => "SHOW_COUNTER",
				5 => "DATE_CREATE",
			),
			"FILTER_NAME" => "arrFilter",		// Имя массива со значениями фильтра для фильтрации элементов
			"IBLOCK_URL" => "",					// URL, ведущий на страницу с содержимым раздела
			"DETAIL_URL" => "",					// URL, ведущий на страницу с содержимым элемента раздела
			"ACTIVE_DATE_FORMAT" => "d F Y",	// Формат показа даты
			"CACHE_TYPE" => "A",				// Тип кеширования
			"CACHE_TIME" => "36000000",			// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",				// Учитывать права доступа
			"COMPONENT_TEMPLATE" => "newOnSite",
			"IBLOCK_TYPE" => "khayr",			// Тип информационных блоков
			"SORT_BY2" => "SORT",				// Поле для второй сортировки новостей
			"SORT_ORDER2" => "ASC",				// Направление для второй сортировки новостей
		),
		false
	);
	
	
	/*
	$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"pastEventsForAjax", 
		array(
			"COMPONENT_TEMPLATE" => "pastEventsForAjax",
			// "IBLOCK_TYPE" => "Events",
			"IBLOCK_ID" => $_POST['blockId'],
			"NEWS_COUNT" => "15",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "arrFilter",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "timeBegin",
				1 => "dateBegin",
				2 => "dateEnd",
				3 => "place",
				4 => "FORUM_MESSAGE_CNT",
				5 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "/events/pastevents/#ELEMENT_CODE#/",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_META_DESCRIPTION" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "Y",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"PAGER_TEMPLATE" => ".default",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"DETAIL_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"LIST_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"STRICT_SECTION_CHECK" => "N"
		),
		false
	);*/
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");