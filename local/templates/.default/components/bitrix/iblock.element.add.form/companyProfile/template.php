<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);


// pre($arResult);
?>


<?
$countryArray = array('Абхазия', 'Австралия', 'Австрия', 'Азавад', 'Азад Джамму и Кашмир', 'Азербайджан', 'Азорские острова', 'Аландские острова', 'Албания', 'Алжир', 'Американское Самоа', 'Ангилья', 'Ангола', 'Андорра', 'Антигуа и Барбуда', 'Аомынь', 'Аргентина', 'Армения', 'Аруба', 'Афганистан', 'Багамы', 'Бангладеш', 'Барбадос', 'Бахрейн', 'Беларусь', 'Белиз', 'Бельгия', 'Бенин', 'Бермуды', 'Болгария', 'Боливия', 'Босния и Герцеговина', 'Ботсвана', 'Бразилия', 'Британская территория в Индийском океане', 'Бруней', 'Буркина-Фасо', 'Бурунди', 'Бутан', 'Вануату', 'Ватикан', 'Великобритания', 'Венгрия', 'Венесуэла', 'Виргинские острова', 'Восточный Тимор', 'Вьетнам', 'Габонская Республика', 'Гавайи', 'Гаити', 'Гайана', 'Гамбия', 'Гана', 'Гваделупа', 'Гватемала', 'Гвинея', 'Гвинея-Бисау', 'Германия', 'Гернси', 'Гибралтар', 'Гондурас', 'Гонконг', 'Гренада', 'Гренландия', 'Греция', 'Грузия', 'Гуам', 'Дания', 'Джерси', 'Джибути', 'Доминика', 'Доминиканская Республика', 'Египет', 'Замбия', 'Зимбабве', 'Израиль', 'Индия', 'Индонезия', 'Иордания', 'Ирак', 'Иран', 'Ирландия', 'Исландия', 'Испания', 'Италия', 'Йемен', 'Кабо-Верде', 'Казахстан', 'Каймановы острова', 'Камбоджа', 'Камерун', 'Канада', 'Канарские острова', 'Катар', 'Кения', 'Кипр', 'Киргизия', 'Кирибати', 'Китай', 'Кокосовые острова', 'Колумбия', 'Коморы', 'Конго', 'Корейская Народно-Демократическая Республика', 'Косово', 'Коста-Рика', 'Кот-д’Ивуар', 'Куба', 'Кувейт', 'Кука острова', 'Кюрасао', 'Лаос', 'Латвия', 'Лесото', 'Либерия', 'Ливан', 'Ливия', 'Литва', 'Лихтенштейн', 'Люксембург', 'Маврикий', 'Мавритания', 'Мадагаскар', 'Мадейра', 'Майотта', 'Македония', 'Малави', 'Малайзия', 'Мали', 'Мальдивы', 'Мальта', 'Марокко', 'Мартиника', 'Маршалловы Острова', 'Мексика', 'Мелилья', 'Микронезия', 'Мозамбик', 'Молдавия', 'Монако', 'Монголия', 'Монтсеррат', 'Мьянма', 'Мэн', 'Нагорно-Карабахская Республика', 'Намибия', 'Науру', 'Непал', 'Нигер', 'Нигерия', 'Нидерланды', 'Никарагуа', 'Ниуэ', 'Новая Зеландия', 'Новая Каледония', 'Норвегия', 'Норфолк', 'ОАЭ', 'Оман', 'Пакистан', 'Палау', 'Палестина', 'Панама', 'Папуа — Новая Гвинея', 'Парагвай', 'Перу', 'Питкэрн', 'Польша, Португалия', 'Приднестровская Молдавская Республика', 'Пуэрто-Рико', 'Реюньон', 'Рождества остров', 'Россия', 'Руанда', 'Румыния', 'Сальвадор', 'Самоа', 'Сан-Марино', 'Сан-Томе и Принсипи', 'Сахарская Арабская Демократическая Республика', 'Саудовская Аравия', 'Свазиленд', 'Святой Елены острова', 'Себорга', 'Северные Марианские острова', 'Сейшельские Острова', 'Сенегал', 'Сен-Бартельми', 'Сен-Мартен', 'Сен-Пьер и Микелон', 'Сент-Винсент и Гренадины', 'Сент-Китс и Невис', 'Сент-Люсия', 'Сербия', 'Сеута', 'Силенд', 'Синт-Маартен', 'Сингапур', 'Сирия', 'Словакия', 'Словения', 'Соединённые Штаты Америки', 'Соломоновы Острова', 'Сомали', 'Сомалиленд', 'Судан', 'Суринам', 'Сьерра-Леоне', 'Таджикистан', 'Таиланд', 'Танзания', 'Тёркс и Кайкос', 'Того', 'Токелау', 'Тонга', 'Тринидад и Тобаго', 'Тувалу', 'Тунис', 'Туркмения', 'Турция', 'Уганда', 'Узбекистан', 'Украина', 'Уоллис и Футуна', 'Уругвай', 'Фарерские острова', 'Фиджи', 'Филиппины', 'Финляндия', 'Фолклендские острова', 'Франция', 'Французская Гвиана', 'Французская Полинезия', 'Французские Южные и Антарктические Территории', 'Хорватия', 'Центральноафриканская Республика', 'Чад', 'Черногория', 'Чехия', 'Чили', 'Швейцария', 'Швеция', 'Шпицберген', 'Шри-Ланка', 'Эквадор', 'Экваториальная Гвинея', 'Эритрея', 'Эстония', 'Эфиопия', 'Южная Георгия и Южные Сандвичевы острова', 'Южная Корея', 'Южно-Африканская Республика', 'Южный Судан', 'Ямайка', 'Япония');
if ($arResult["MESSAGE"] === 'Элемент успешно добавлен')
{
	header('Location: /personal/company/');
	exit();
}

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);

if (CModule::IncludeModule("iblock") && !empty($arUser['UF_ID_COMPANY']))
{
	$arSelect = array("NAME", 'ACTIVE', 'PROPERTY_inModeration');
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();
}
?>

<div class="col-xs-3 content-margin" id="aside1">
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
				<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageMenu.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'companyName' => $arFields['NAME']), array());?>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-9 content-margin" id="article"> <!-- Закрывающий тэг в щаблоне следующего компонента("bitrix:news.list", "companyProfilePriceList") который подключен на index.php -->

<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
<?  if ($arParams['COMPANY_ADD'] == 'Y') { ?>
		<input type="hidden" name="company_add" value="Y">
		<input name="PROPERTY[<? echo PROPERTY_ID_CONTACT_PERSON; ?>][0]" type="hidden" value="<?=$USER->GetID()?>">
		<input name="PROPERTY[<? echo PROPERTY_ID_USER_ID; ?>][0]" type="hidden" value="<?=$USER->GetID()?>">
<? 	}

	if ($arParams['COMPANY_ADD'] == 'Y')
		$title = 'Добавить компанию';
	else
		$title = 'Карточка компании';
?>

		<h1><? echo $title; ?></h1>

<?
		if (isset($arFields) && '1' === $arFields['PROPERTY_INMODERATION_VALUE']) { ?>
			<div class="block-default in block-shadow content-margin">
				<h2>Карточка компании на модерации и недоступна в общем разделе.</h2>
			</div>
<?
		}

		//pre($arResult);
		if ((!empty($arResult["ERRORS"])) || (strlen($arResult["MESSAGE"]) > 0))
		{
		?>
			<div class="block-default in block-shadow content-margin">
				<div class="block-title clearfix">Уведомления</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
		<?
							if (!empty($arResult["ERRORS"]))
								ShowError(implode("<br />", $arResult["ERRORS"]));

							if (strlen($arResult["MESSAGE"]) > 0)
								ShowNote($arResult["MESSAGE"]);
		?>
						</div>
					</div>
				</div>
			</div>
		<?
		}
		?>
		<div class="block-default in block-shadow content-margin ">
			<div class="block-title clearfix">Логотип компании</div>
			<div class="lk_companylogoblock clearfix">
				<div class="lk_companylogoimg floatleft">
	<?
					$value = $arResult["ELEMENT"]['PREVIEW_PICTURE'];
					$logoFile = CFile::ResizeImageGet($arResult["ELEMENT_FILES"][$value], array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);

					if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
					{
						if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
						{
	?>
							<img src="<? echo $logoFile["src"]; ?>" border="0" width='200px' />
	<?
						}
					}
					else
					{
						?>
						<img src="" border="0" width='200px' />
						<?
					}
	?>
				</div>
				<div class="lk_companylogotext ">
					<div class="lk_companylogotitle"><? if ($arParams['COMPANY_ADD'] == 'Y') { ?>Добавить логотип компании:<? } else { ?>Обновить логотип компании:<? } ?></div>
					<div class="lk_companylogobtn">
						<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $value; ?>" />
						<input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
						<label for='previewPicture'>
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</label>
						<span id='previewPictureFileName'></span>
					</div>
				</div>
			</div>
		</div>
		<div class="block-default in block-shadow content-margin">
			<div class="block-title clearfix">Общая информация</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
					<?
						if (in_array('NAME', $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT"]['NAME']) > 0)
							$value = $arResult["ELEMENT"]['NAME'];
						else
							$value = "";
					?>
						<label class="control-label mainlabel" for="lk_companyName">Название компании<? echo $required; ?></label>
						<input type="text" class="form-control" id="lk_companyName" name='PROPERTY[NAME][0]' value="<? echo $value; ?>">
					</div>						
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<?
						if (in_array(PROPERTY_ID_FORM_OF_OWNERSHIP, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_FORM_OF_OWNERSHIP][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_FORM_OF_OWNERSHIP][0]['VALUE'];
						else
							$value = "";
						?>
						<label class="control-label mainlabel" for="lk_formOwnership">Форма собственности<? echo $required; ?></label>
						<input type="text" class="form-control" id="lk_formOwnership" name='PROPERTY[<? echo PROPERTY_ID_FORM_OF_OWNERSHIP; ?>][0]' value="<? echo $value; ?>">
					</div>
				</div>
			</div>
			<div class="lk_companycat clearfix">
				<div class="lk_companycattitle floatleft">
					Категория компании:
				</div>
				<div class="lk_companycatchek">
	<?
					foreach ($arResult['SECTION_LIST'] as $key => $value)
					{
						$checked = '';
						
						foreach ($arResult['ELEMENT']['IBLOCK_SECTION'] as $sKey => $sValue)
						{
							if ($key == $sValue['VALUE'])
							{
								$checked = 'checked';
								break;
							}
						}
	?>
						<div class="mycheckbox"><label><input name='PROPERTY[IBLOCK_SECTION][]' type="checkbox" <? echo $checked; ?> value='<? echo $key; ?>'><? echo substr($value['VALUE'], 2) ; ?></label></div>
	<?
					}
	?>
				</div>
			</div>
		</div>	
		<div class="block-default in block-shadow content-margin">
			<div class="block-title clearfix">Контактные данные</div>
			<div class="row" id='list'>
				<div class="col-xs-6">
					<div class="form-group">
					<?
						if (in_array(PROPERTY_ID_ADDRESS, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_ADDRESS][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_ADDRESS][0]['VALUE'];
						else
							$value = "";
					?>
						<label class="control-label mainlabel" for="lk_companyAddress">Адрес<? echo $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_ADDRESS; ?>][0]' id="lk_companyAddress" class="form-control" value="<? echo $value; ?>">
					</div>
				</div>
				<?
				foreach ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_ADDRESS_ADD_OFFICES] as $key => $address) { ?>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="control-label mainlabel" for="lk_companyAddAddress<? echo $key; ?>">Адрес дополнительного офиса</label>
							<input type="text" name='PROPERTY[<? echo PROPERTY_ID_ADDRESS_ADD_OFFICES; ?>][<? echo $key; ?>]' id="lk_companyAddAddress<? echo $key; ?>" class="form-control" value="<? echo $address['VALUE']; ?>">
						</div>
					</div>
<?				}
?>
				<div class="col-xs-12 addAddressFieldsBtn" id='addAddressFieldsBtn'>
					<div class="form-group">
						+ Добавить адрес
					</div>
				</div>
				<div class="hide" id='addrTpl'>
					<div class="col-xs-6" id='addressTpl'>
						<div class="form-group">
							<label class="control-label mainlabel" for="lk_companyAddAddress">Дополнительный адрес</label>
							<input type="text" name='PROPERTY[<? echo PROPERTY_ID_ADDRESS_ADD_OFFICES; ?>][]' id="lk_companyAddAddress" class="form-control" value="">
						</div>
					</div>
				</div>

				<div class="col-xs-6">
					<div class="form-group">
					<?
						if (in_array(PROPERTY_ID_PHONE, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_PHONE][0]['VALUE']) > 0)
							$phone = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_PHONE][0]['VALUE'];
						else
							$phone = "";
					?>
						<label class="control-label mainlabel" for="lk_companyPhone">Телефон<? echo $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_PHONE; ?>][0]' id="lk_companyPhone" class="form-control" value="<? echo $phone; ?>">
					</div>
				</div>

				<?
				foreach ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_ADD_PHONE] as $key => $phone) { ?>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="control-label mainlabel" for="lk_companyAddPhone<? echo $key; ?>">Дополнительный телефон</label>
							<input type="text" name='PROPERTY[<? echo PROPERTY_ID_ADD_PHONE; ?>][<? echo $key; ?>]' id="lk_companyAddPhone<? echo $key; ?>" class="form-control" value="<? echo $phone['VALUE']; ?>">
						</div>
					</div>
				<?}?>

				<div class="col-xs-12 addPhoneFieldsBtn" id='addPhoneFieldsBtn'>
					<div class="form-group">
						+ Добавить телефон
					</div>
				</div>
				<div class="hide" id='tpl'>
					<div class="col-xs-6" id='phoneTpl'>
						<div class="form-group">
							<label class="control-label mainlabel" for="lk_companyAddPhone">Дополнительный телефон</label>
							<input type="text" name='PROPERTY[<? echo PROPERTY_ID_ADD_PHONE; ?>][]' id="lk_companyAddPhone" class="form-control" value="">
						</div>
					</div>
				</div>
<script>
var list = document.getElementById('list');

var inc = 0;
var elBtn = document.getElementById('addPhoneFieldsBtn');
var phoneTpl = document.getElementById('phoneTpl');
elBtn.addEventListener('click', function(){
	var newEl = phoneTpl.cloneNode(true);
	newEl.id = newEl.id + inc;
	list.insertBefore(newEl, elBtn);
	++inc;
});

var incAddr = 0;
var elBtnAddr = document.getElementById('addAddressFieldsBtn');
var addressTpl = document.getElementById('addressTpl');
elBtnAddr.addEventListener('click', function(){
	var newEl = addressTpl.cloneNode(true);
	newEl.id = newEl.id + incAddr;
	list.insertBefore(newEl, elBtnAddr);
	++incAddr;
});
</script>
				<div class="col-xs-6">
					<div class="form-group" id="lk_BD">
	<?
	// Дата основания.
						if (in_array(PROPERTY_ID_DATE_FOUNDATION, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_DATE_FOUNDATION][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_DATE_FOUNDATION][0]['VALUE'];
						else
							$value = "";
					?>
						<label class="control-label mainlabel" for="lk_dateFoundation"><? echo $arResult['PROPERTY_LIST_FULL'][PROPERTY_ID_DATE_FOUNDATION]['NAME'] . $required; ?></label>
	<?
						if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
						{
							$value = intval(PROPERTY_ID_DATE_FOUNDATION) > 0 ? $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_DATE_FOUNDATION][0]["~VALUE"] : $arResult["ELEMENT"][PROPERTY_ID_DATE_FOUNDATION];
							$description = intval(PROPERTY_ID_DATE_FOUNDATION) > 0 ? $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_DATE_FOUNDATION][$i]["DESCRIPTION"] : "";
						}
						elseif ($i == 0)
						{
							$value = intval(PROPERTY_ID_DATE_FOUNDATION) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_DATE_FOUNDATION]["DEFAULT_VALUE"];
							$description = "";
						}
						else
						{
							$value = "";
							$description = "";
						}

						$APPLICATION->IncludeComponent(
							'bitrix:main.calendar',
							'calendarBirthDay',
							array(
								'SHOW_INPUT' => 'Y',
								'FORM_NAME' => 'iblock_add',
								'INPUT_NAME' => "PROPERTY[".PROPERTY_ID_DATE_FOUNDATION."][0]",
								'INPUT_VALUE' => $value,
								'SHOW_TIME' => "N",
							),
							null,
							array('HIDE_ICONS' => 'Y')
						);
	?>
					</div>						
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Skype.
						if (in_array(PROPERTY_ID_SKYPE, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SKYPE][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SKYPE][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_skype"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_SKYPE]['NAME'] . $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_SKYPE; ?>][0]' id="lk_skype" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
			</div>
			<? 
				if ($arParams['COMPANY_ADD'] != 'Y') {	
			?>
			<div class="lk_companycat clearfix">
				<?
				if (in_array(PROPERTY_ID_CONTACT_PERSON, $arResult["PROPERTY_REQUIRED"]))
					$required = '*';
				else
					$required = '';
				?>


				<div class="lk_companycattitle floatleft">
					Контактное лицо<? echo $required; ?>
				</div>
				<div class="lk_companycatchek">
					<?
					// Свойство "Контактное лицо" - мультиселект с привязкой к пользователю.
					$num = 0;
// pre($arResult['ELEMENT']['ID']);
					$filter = array("UF_ID_COMPANY" => $arResult['ELEMENT']['ID']);
					$order = array('sort' => 'asc');
					$tmp = 'sort'; // параметр проигнорируется методом, но обязан быть
					$rsUsers = CUser::GetList($order, $tmp, $filter); // выбираем пользователей

					// pre($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_CONTACT_PERSON]);

					while ($user = $rsUsers->Fetch())
					{
						// pre($user);
						$checked = '';

						foreach ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_CONTACT_PERSON] as $key => $valueArr)
						{
							if ($user['ID'] == $valueArr['VALUE'])
							{
								$checked = 'checked';
								break;											
							}
						}

						$userName = $user['NAME'] . ' ' . $user['LAST_NAME'];
					?>
						<div class="mycheckbox">
							<label><input name='PROPERTY[<? echo PROPERTY_ID_CONTACT_PERSON; ?>][<? echo $num; ?>]' type="checkbox" <? echo $checked; ?> value='<? echo $user['ID']; ?>'><? echo $userName; ?></label>
						</div>
					<?
						++$num;
					}
					?>
				</div>
			</div>
			<? }?>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Должность.
						if (in_array(PROPERTY_ID_POSITION, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_POSITION][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_POSITION][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_position"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_POSITION]['NAME'] . $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_POSITION; ?>][0]' id="lk_position" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Сайт компании.
						if (in_array(PROPERTY_ID_COMPANY_WEBSITE, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';
						
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_COMPANY_WEBSITE][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_COMPANY_WEBSITE][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_website"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_COMPANY_WEBSITE]['NAME'] . $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_COMPANY_WEBSITE; ?>][0]' id="lk_website" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Email.
						if (in_array(PROPERTY_ID_EMAIL, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';

						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_EMAIL][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_EMAIL][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_email"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_EMAIL]['NAME'] . $required; ?></label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_EMAIL; ?>][0]' id="lk_email" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_VK][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_VK][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_socialNetworkVK">Адрес в социальной сети BK</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_SOCIAL_NETWORK_VK; ?>][0]' id="lk_socialNetworkVK" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_FB][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_FB][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_socialNetworkFB">Адрес в социальной сети FB</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_SOCIAL_NETWORK_FB; ?>][0]' id="lk_socialNetworkFB" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_GOOGLE][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_GOOGLE][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_socialNetworkGP">Адрес в социальной сети Google+</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_SOCIAL_NETWORK_GOOGLE; ?>][0]' id="lk_socialNetworkGP" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
	<?
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_INSTAGRAMM][0]['VALUE']) > 0)
							$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_SOCIAL_NETWORK_INSTAGRAMM][0]['VALUE'];
						else
							$value = "";
	?>
						<label class="control-label mainlabel" for="lk_socialNetworkInst">Адрес в социальной сети instagram</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_SOCIAL_NETWORK_INSTAGRAMM; ?>][0]' id="lk_socialNetworkInst" class="form-control"  value="<? echo $value; ?>">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label class="control-label mainlabel" for="countryList">Страна</label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='countryList' name='PROPERTY[<? echo PROPERTY_ID_COUNTRY; ?>][0]'>
							<?
							foreach ($countryArray as $countyName)
							{
								$selected = '';
								if ('Y' == $arParams['COMPANY_ADD'] && 'Россия' == $countyName)
									$selected = 'selected';

								if ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_COUNTRY][0]['VALUE'] == $countyName)
									$selected = 'selected';

								echo "<option value='{$countyName}' {$selected}>{$countyName}</option>";
							}
							?>
						</select>
					</div>
				</div>
			</div>
<?
			$class = '';
			if ('Y' == $arParams['COMPANY_ADD'] || 'Россия' === $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_COUNTRY][0]['VALUE'])
				$class = 'hide';
?>
			<div class='row <? echo $class; ?>' id='cityNameBlock'>
				<div class="col-xs-6">
					<div class="form-group">
<?
						// Город введённый пользователем.
						if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_USER_CITY][0]['VALUE']) > 0)
							$userCity = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_USER_CITY][0]['VALUE'];
						else
							$userCity = "";
?>
						<label class="control-label mainlabel" for="userCity">Город</label>
						<input type="text" name='PROPERTY[<? echo PROPERTY_ID_USER_CITY; ?>][0]' id="userCity" class="form-control"  value="<? echo $userCity; ?>">
					</div>
				</div>
			</div>
<?
			$class = '';
			if ('Y' != $arParams['COMPANY_ADD'] && 'Россия' !== $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_COUNTRY][0]['VALUE'])
				$class = 'hide';
?>
			<div class='row <? echo $class; ?>' id='regionsListBlock'>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Регион.
						if (in_array(PROPERTY_ID_REGION, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
						else
							$required = '';
	?>
						<label class="control-label mainlabel" for="regionsList"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_REGION]['NAME'] . $required; ?></label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='regionsList' name='PROPERTY[<? echo PROPERTY_ID_REGION; ?>][0]'>
							<option value=''></option>
	<?
							$blockId = 7;
							//выберем папки из информационного блока $blockId и раздела 0.
							$items = GetIBlockSectionList($blockId, 0, array("sort" => "asc"));
							while ($arItem = $items->GetNext())
							{
								$selected = '';
								
								if ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_REGION][0]['VALUE'] == $arItem["ID"])
									$selected = 'selected';

								echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
							}
	?>
						</select>
					</div>
				</div>
			</div>
			<div class='row <? echo $class; ?>' id='areaListBlock'>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Область.
						$required = '';
						if (in_array(PROPERTY_ID_AREA, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
	?>
						<label class="control-label mainlabel" for="areaList"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_AREA]['NAME'] . $required; ?></label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='areaList' name='PROPERTY[<? echo PROPERTY_ID_AREA; ?>][0]'>
							<option value=''></option>
	<?
							$blockId = 7;
							//выберем папки из информационного блока $blockId.
							$items = GetIBlockSectionList($blockId, $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_REGION][0]['VALUE'], array("sort" => "asc"));
							while ($arItem = $items->GetNext())
							{
								$selected = '';

								if ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_AREA][0]['VALUE'] == $arItem["ID"])
									$selected = 'selected';

								echo '<option value="' . $arItem["ID"] . '" ' . $selected . '>' . $arItem["NAME"] . '</option>';
							}
	?>
						</select>
					</div>
				</div>
			</div>
			<div class='row <? echo $class; ?>' id='citiesListBlock'>
				<div class="col-xs-6">
					<div class="form-group">
	<?
	// Город.
						$required = '';
						if (in_array(PROPERTY_ID_CITY, $arResult["PROPERTY_REQUIRED"]))
							$required = '*';
	?>
						<label class="control-label mainlabel" for="citiesList"><? echo $arResult["PROPERTY_LIST_FULL"][PROPERTY_ID_CITY]['NAME'] . $required; ?></label>
						<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='citiesList' name='PROPERTY[<? echo PROPERTY_ID_CITY; ?>][0]'>
							<option value=''></option>
	<?
							$blockId = IBLOCK_ID_CITY;
							$arSelect = array("ID", "NAME");
							$arFilter = array("IBLOCK_ID"=>$blockId, 'SECTION_ID' => $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_AREA][0]['VALUE'], "ACTIVE"=>"Y");
							$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>250), $arSelect);
							while ($ob = $res->GetNextElement())
							{
								$arFields = $ob->GetFields();
								$selected = '';

								if ($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_CITY][0]['VALUE'] == $arFields["ID"])
									$selected = 'selected';

								echo '<option value="' . $arFields["ID"] . '" ' . $selected . '>' . $arFields["NAME"] . '</option>';
							}
	?>
						</select>
					</div>
				</div>
			</div>
		</div>
<script>
	var selectCountry = document.getElementById('countryList');
	selectCountry.addEventListener('change', function() {
		var optionCountry = selectCountry.options[selectCountry.selectedIndex].text;
		if ('Россия' !== optionCountry)
		{
			document.getElementById('cityNameBlock').classList.remove('hide');
			document.getElementById('regionsListBlock').classList.add('hide');
			document.getElementById('areaListBlock').classList.add('hide');
			document.getElementById('citiesListBlock').classList.add('hide');
		}
		else
		{
			document.getElementById('cityNameBlock').classList.add('hide');
			document.getElementById('regionsListBlock').classList.remove('hide');
			document.getElementById('areaListBlock').classList.remove('hide');
			document.getElementById('citiesListBlock').classList.remove('hide');
		}
	});
</script>
		<div class="block-default in block-shadow content-margin">
			<div class="block-title clearfix">Описание компании</div>
			<div class="form-group">
	<?	
			if (strlen($arResult["ELEMENT"]['PREVIEW_TEXT']) > 0)
				$value = $arResult["ELEMENT"]['PREVIEW_TEXT'];
			else
				$value = "";
	?>
				<textarea class='form-control maintextarea' name="PROPERTY[PREVIEW_TEXT][0]"><? echo $value; ?></textarea>
			</div>
		</div>

		<div class="block-default in block-shadow content-margin">
			<div class="block-title clearfix">Условия работы</div>
			<div class="form-group">
	<?	
			if (strlen($arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_CONDITION_EMP][0]['VALUE']) > 0)
				$value = $arResult["ELEMENT_PROPERTIES"][PROPERTY_ID_CONDITION_EMP][0]['VALUE'];
			else
				$value = "";
	?>
				<textarea class='form-control maintextarea' name="PROPERTY[<? echo PROPERTY_ID_CONDITION_EMP; ?>][0]"><? echo $value; ?></textarea>
			</div>
			<div class="seporator lksep"></div>
			<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" class="btn btn-blue-full minbr" />
		</div>
</form>

<?
if ($arParams['COMPANY_ADD'] == 'Y')
	echo '</div>';
?>



<?
/*

<?
if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
	<table class="data-table" style="width: 90%">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				<tr>
					<td><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></td>
					<td>
						<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br /><?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CHTMLEditor;
								$LHE->Show(array(
									'name' => "PROPERTY[".$propertyID."][0]",
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'width' => '100%',
									'minBodyWidth' => 248,
									'normalBodyWidth' => 555,
									'height' => '200',
									'bAllowPhp' => false,
									'limitPhpAccess' => false,
									'autoResize' => true,
									'autoResizeOffset' => 40,
									'useFileDialogs' => false,
									'saveOnBlur' => true,
									'showTaskbars' => false,
									'showNodeNavi' => false,
									'askBeforeUnloadPage' => true,
									'bbCode' => false,
									'siteId' => SITE_ID,
									'controlsMap' => array(
										array('id' => 'Bold', 'compact' => true, 'sort' => 80),
										array('id' => 'Italic', 'compact' => true, 'sort' => 90),
										array('id' => 'Underline', 'compact' => true, 'sort' => 100),
										array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
										array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
										array('id' => 'Color', 'compact' => true, 'sort' => 130),
										array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
										array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
										array('separator' => true, 'compact' => false, 'sort' => 145),
										array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
										array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
										array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
										array('separator' => true, 'compact' => false, 'sort' => 200),
										array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
										array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
										array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
										array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
										array('separator' => true, 'compact' => false, 'sort' => 290),
										array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
										array('id' => 'More', 'compact' => true, 'sort' => 400)
									),
								));
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?=$value?>" /><br /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><br /><?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>
					</td>
				</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
						>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>