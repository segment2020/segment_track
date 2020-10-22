<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить компанию");
global $USER;
?>

<div class="container-fluid">
	<div class="row row-flex">

<?
if (CSite::InGroup(array(ID_GROUP_COMPANY_STAFF)) || CSite::InGroup(array(ID_GROUP_COMPANY_ADMIN))) {
	$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());
	//localredirect('/personal/', false, '301 Moved permanently'); ?>
		<div class="col-sm-9 col-xs-12 content-margin">
			<div class="block-default in block-shadow content-margin">
				<h1>Компания успешно добавлена</h1>
				<p>После проверки модератором она будет активирована</p>
				<p>Перейти в <a href="/personal/" class='normalLink'>личный кабинет</a> или на <a href="/personal/" class='normalLink'>главную страницу</a></p>
			</div>
		</div>
<?	} else {
		// в массив добавлен новый пареметр "COMPANY_ADD" => "Y", который показывает что компания новая

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
					0 => "7",
				),
				"STATUS" => "ANY",	// Редактирование возможно
				"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
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
				"COMPANY_ADD" => "Y",
			),
			false
		);
	}
?>
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>