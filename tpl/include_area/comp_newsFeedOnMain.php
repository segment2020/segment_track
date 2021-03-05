  
<? $APPLICATION->IncludeComponent("bitrix:news.list", "newsFeedOnMain", 
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",		// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",			// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",						// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",			// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",			// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",				// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",				// Включить подгрузку стилей
		"CACHE_FILTER" => "N",					// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",					// Учитывать права доступа
		"CACHE_TIME" => "36000000",				// Время кеширования (сек.)
		"CACHE_TYPE" => "N",					// Тип кеширования
		"CHECK_DATES" => "Y",					// Показывать только активные на данный момент элементы 
		"SETTINGS_LIST" => $newsFeed_settingsList,	// Вставляем свои настройки 
	), 
	false
); ?> 