<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список компаний");


/*
$array_country = file("country.dat");
$count_array = count($array_country);

print "<select size=\"1\" name=\"country\">\n";

   for ($i=0; $i<$count_array; $i++) {
   	   $country = str_replace("\r\n", "", $array_country[$i]);
	   $country = str_replace(" ", "", $country);

	   print "<option value=\"{$country}\">{$country}</option>\n";
	}

print "</select>\n";    
*/
?>


	<div class="container-fluid">
		<div class="row row-flex">
			<div class="col-sm-3 col-xs-12 order-xs-1">
				<div class="row">
					<?$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('new-members', 'top100', 'viewpoint')), array());?>
				</div>					
			</div>
			<div class="col-sm-9 col-xs-12 content-margin">
				<h1>Общий список участников рынка</h1>
				<div class="addfilterblock clearfix content-margin">
					<? if (!CSite::InGroup(array(ID_GROUP_COMPANY_STAFF)) && !CSite::InGroup(array(ID_GROUP_COMPANY_ADMIN))) { ?>
					<div class="addcompanyblock floatleft">
						<a href="/personal/companyadd/" class="btn btn-blue-full minbr"><span class="plus">+</span>Добавить свою компанию</a>
					</div>
					<? } ?>
					<div class="moarfilterblock floatright">
						<div class="btn btn-blue minbr"><i class="icon-icons_main-14"></i>Расширенный поиск</div>
					</div>					
				</div>
				<div class="block-default in block-shadow content-margin advancedsearchblock">
					<div class="block-title clearfix">Расширенный поиск</div>
						<form action='' method='GET'>
							<div class="row">
								<div class="col-xs-12">
										<div class="form-group">
											<label class="control-label mainlabel" for="country">Страна</label>
											<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='country' name='country'>
												<option value="Абхазия">Абхазия</option>
												<option value="Австралия">Австралия</option>
												<option value="Австрия">Австрия</option>
												<option value="Азавад">Азавад</option>
												<option value="АзадДжаммуиКашмир">АзадДжаммуиКашмир</option>
												<option value="Азербайджан">Азербайджан</option>
												<option value="Азорскиеострова">Азорскиеострова</option>
												<option value="Аландскиеострова">Аландскиеострова</option>
												<option value="Албания">Албания</option>
												<option value="Алжир">Алжир</option>
												<option value="АмериканскоеСамоа">АмериканскоеСамоа</option>
												<option value="Ангилья">Ангилья</option>
												<option value="Ангола">Ангола</option>
												<option value="Андорра">Андорра</option>
												<option value="АнтигуаиБарбуда">АнтигуаиБарбуда</option>
												<option value="Аомынь">Аомынь</option>
												<option value="Аргентина">Аргентина</option>
												<option value="Армения">Армения</option>
												<option value="Аруба">Аруба</option>
												<option value="Афганистан">Афганистан</option>
												<option value="Багамы">Багамы</option>
												<option value="Бангладеш">Бангладеш</option>
												<option value="Барбадос">Барбадос</option>
												<option value="Бахрейн">Бахрейн</option>
												<option value="Беларусь">Беларусь</option>
												<option value="Белиз">Белиз</option>
												<option value="Бельгия">Бельгия</option>
												<option value="Бенин">Бенин</option>
												<option value="Бермуды">Бермуды</option>
												<option value="Болгария">Болгария</option>
												<option value="Боливия">Боливия</option>
												<option value="БоснияиГерцеговина">БоснияиГерцеговина</option>
												<option value="Ботсвана">Ботсвана</option>
												<option value="Бразилия">Бразилия</option>
												<option value="БританскаятерриториявИндийскомокеане">БританскаятерриториявИндийскомокеане</option>
												<option value="Бруней">Бруней</option>
												<option value="Буркина-Фасо">Буркина-Фасо</option>
												<option value="Бурунди">Бурунди</option>
												<option value="Бутан">Бутан</option>
												<option value="Вануату">Вануату</option>
												<option value="Ватикан">Ватикан</option>
												<option value="Великобритания">Великобритания</option>
												<option value="Венгрия">Венгрия</option>
												<option value="Венесуэла">Венесуэла</option>
												<option value="Виргинскиеострова">Виргинскиеострова</option>
												<option value="ВосточныйТимор">ВосточныйТимор</option>
												<option value="Вьетнам">Вьетнам</option>
												<option value="ГабонскаяРеспублика">ГабонскаяРеспублика</option>
												<option value="Гавайи">Гавайи</option>
												<option value="Гаити">Гаити</option>
												<option value="Гайана">Гайана</option>
												<option value="Гамбия">Гамбия</option>
												<option value="Гана">Гана</option>
												<option value="Гваделупа">Гваделупа</option>
												<option value="Гватемала">Гватемала</option>
												<option value="Гвинея">Гвинея</option>
												<option value="Гвинея-Бисау">Гвинея-Бисау</option>
												<option value="Германия">Германия</option>
												<option value="Гернси">Гернси</option>
												<option value="Гибралтар">Гибралтар</option>
												<option value="Гондурас">Гондурас</option>
												<option value="Гонконг">Гонконг</option>
												<option value="Гренада">Гренада</option>
												<option value="Гренландия">Гренландия</option>
												<option value="Греция">Греция</option>
												<option value="Грузия">Грузия</option>
												<option value="Гуам">Гуам</option>
												<option value="Дания">Дания</option>
												<option value="Джерси">Джерси</option>
												<option value="Джибути">Джибути</option>
												<option value="Доминика">Доминика</option>
												<option value="ДоминиканскаяРеспублика">ДоминиканскаяРеспублика</option>
												<option value="Египет">Египет</option>
												<option value="Замбия">Замбия</option>
												<option value="Зимбабве">Зимбабве</option>
												<option value="Израиль">Израиль</option>
												<option value="Индия">Индия</option>
												<option value="Индонезия">Индонезия</option>
												<option value="Иордания">Иордания</option>
												<option value="Ирак">Ирак</option>
												<option value="Иран">Иран</option>
												<option value="Ирландия">Ирландия</option>
												<option value="Исландия">Исландия</option>
												<option value="Испания">Испания</option>
												<option value="Италия">Италия</option>
												<option value="Йемен">Йемен</option>
												<option value="Кабо-Верде">Кабо-Верде</option>
												<option value="Казахстан">Казахстан</option>
												<option value="Каймановыострова">Каймановыострова</option>
												<option value="Камбоджа">Камбоджа</option>
												<option value="Камерун">Камерун</option>
												<option value="Канада">Канада</option>
												<option value="Канарскиеострова">Канарскиеострова</option>
												<option value="Катар">Катар</option>
												<option value="Кения">Кения</option>
												<option value="Кипр">Кипр</option>
												<option value="Киргизия">Киргизия</option>
												<option value="Кирибати">Кирибати</option>
												<option value="Китай">Китай</option>
												<option value="Кокосовыеострова">Кокосовыеострова</option>
												<option value="Колумбия">Колумбия</option>
												<option value="Коморы">Коморы</option>
												<option value="Конго">Конго</option>
												<option value="КорейскаяНародно-ДемократическаяРеспублика">КорейскаяНародно-ДемократическаяРеспублика</option>
												<option value="Косово">Косово</option>
												<option value="Коста-Рика">Коста-Рика</option>
												<option value="Кот-д’Ивуар">Кот-д’Ивуар</option>
												<option value="Куба">Куба</option>
												<option value="Кувейт">Кувейт</option>
												<option value="Кукаострова">Кукаострова</option>
												<option value="Кюрасао">Кюрасао</option>
												<option value="Лаос">Лаос</option>
												<option value="Латвия">Латвия</option>
												<option value="Лесото">Лесото</option>
												<option value="Либерия">Либерия</option>
												<option value="Ливан">Ливан</option>
												<option value="Ливия">Ливия</option>
												<option value="Литва">Литва</option>
												<option value="Лихтенштейн">Лихтенштейн</option>
												<option value="Люксембург">Люксембург</option>
												<option value="Маврикий">Маврикий</option>
												<option value="Мавритания">Мавритания</option>
												<option value="Мадагаскар">Мадагаскар</option>
												<option value="Мадейра">Мадейра</option>
												<option value="Майотта">Майотта</option>
												<option value="Македония">Македония</option>
												<option value="Малави">Малави</option>
												<option value="Малайзия">Малайзия</option>
												<option value="Мали">Мали</option>
												<option value="Мальдивы">Мальдивы</option>
												<option value="Мальта">Мальта</option>
												<option value="Марокко">Марокко</option>
												<option value="Мартиника">Мартиника</option>
												<option value="МаршалловыОстрова">МаршалловыОстрова</option>
												<option value="Мексика">Мексика</option>
												<option value="Мелилья">Мелилья</option>
												<option value="Микронезия">Микронезия</option>
												<option value="Мозамбик">Мозамбик</option>
												<option value="Молдавия">Молдавия</option>
												<option value="Монако">Монако</option>
												<option value="Монголия">Монголия</option>
												<option value="Монтсеррат">Монтсеррат</option>
												<option value="Мьянма">Мьянма</option>
												<option value="Мэн">Мэн</option>
												<option value="Нагорно-КарабахскаяРеспублика">Нагорно-КарабахскаяРеспублика</option>
												<option value="Намибия">Намибия</option>
												<option value="Науру">Науру</option>
												<option value="Непал">Непал</option>
												<option value="Нигер">Нигер</option>
												<option value="Нигерия">Нигерия</option>
												<option value="Нидерланды">Нидерланды</option>
												<option value="Никарагуа">Никарагуа</option>
												<option value="Ниуэ">Ниуэ</option>
												<option value="НоваяЗеландия">НоваяЗеландия</option>
												<option value="НоваяКаледония">НоваяКаледония</option>
												<option value="Норвегия">Норвегия</option>
												<option value="Норфолк">Норфолк</option>
												<option value="ОАЭ">ОАЭ</option>
												<option value="Оман">Оман</option>
												<option value="Пакистан">Пакистан</option>
												<option value="Палау">Палау</option>
												<option value="Палестина">Палестина</option>
												<option value="Панама">Панама</option>
												<option value="Папуа—НоваяГвинея">Папуа—НоваяГвинея</option>
												<option value="Парагвай">Парагвай</option>
												<option value="Перу">Перу</option>
												<option value="Питкэрн">Питкэрн</option>
												<option value="Польша">Польша</option>
												<option value="Португалия">Португалия</option>
												<option value="ПриднестровскаяМолдавскаяРеспублика">ПриднестровскаяМолдавскаяРеспублика</option>
												<option value="Пуэрто-Рико">Пуэрто-Рико</option>
												<option value="Реюньон">Реюньон</option>
												<option value="Рождестваостров">Рождестваостров</option>
												<option value="Россия" selected>Россия</option>
												<option value="Руанда">Руанда</option>
												<option value="Румыния">Румыния</option>
												<option value="Сальвадор">Сальвадор</option>
												<option value="Самоа">Самоа</option>
												<option value="Сан-Марино">Сан-Марино</option>
												<option value="Сан-ТомеиПринсипи">Сан-ТомеиПринсипи</option>
												<option value="СахарскаяАрабскаяДемократическаяРеспублика">СахарскаяАрабскаяДемократическаяРеспублика</option>
												<option value="СаудовскаяАравия">СаудовскаяАравия</option>
												<option value="Свазиленд">Свазиленд</option>
												<option value="СвятойЕленыострова">СвятойЕленыострова</option>
												<option value="Себорга">Себорга</option>
												<option value="СеверныеМарианскиеострова">СеверныеМарианскиеострова</option>
												<option value="СейшельскиеОстрова">СейшельскиеОстрова</option>
												<option value="Сенегал">Сенегал</option>
												<option value="Сен-Бартельми">Сен-Бартельми</option>
												<option value="Сен-Мартен">Сен-Мартен</option>
												<option value="Сен-ПьериМикелон">Сен-ПьериМикелон</option>
												<option value="Сент-ВинсентиГренадины">Сент-ВинсентиГренадины</option>
												<option value="Сент-КитсиНевис">Сент-КитсиНевис</option>
												<option value="Сент-Люсия">Сент-Люсия</option>
												<option value="Сербия">Сербия</option>
												<option value="Сеута">Сеута</option>
												<option value="Силенд">Силенд</option>
												<option value="Синт-Маартен">Синт-Маартен</option>
												<option value="Сингапур">Сингапур</option>
												<option value="Сирия">Сирия</option>
												<option value="Словакия">Словакия</option>
												<option value="Словения">Словения</option>
												<option value="СоединённыеШтатыАмерики">СоединённыеШтатыАмерики</option>
												<option value="СоломоновыОстрова">СоломоновыОстрова</option>
												<option value="Сомали">Сомали</option>
												<option value="Сомалиленд">Сомалиленд</option>
												<option value="Судан">Судан</option>
												<option value="Суринам">Суринам</option>
												<option value="Сьерра-Леоне">Сьерра-Леоне</option>
												<option value="Таджикистан">Таджикистан</option>
												<option value="Таиланд">Таиланд</option>
												<option value="Танзания">Танзания</option>
												<option value="ТёрксиКайкос">ТёрксиКайкос</option>
												<option value="Того">Того</option>
												<option value="Токелау">Токелау</option>
												<option value="Тонга">Тонга</option>
												<option value="ТринидадиТобаго">ТринидадиТобаго</option>
												<option value="Тувалу">Тувалу</option>
												<option value="Тунис">Тунис</option>
												<option value="Туркмения">Туркмения</option>
												<option value="Турция">Турция</option>
												<option value="Уганда">Уганда</option>
												<option value="Узбекистан">Узбекистан</option>
												<option value="Украина">Украина</option>
												<option value="УоллисиФутуна">УоллисиФутуна</option>
												<option value="Уругвай">Уругвай</option>
												<option value="Фарерскиеострова">Фарерскиеострова</option>
												<option value="Фиджи">Фиджи</option>
												<option value="Филиппины">Филиппины</option>
												<option value="Финляндия">Финляндия</option>
												<option value="Фолклендскиеострова">Фолклендскиеострова</option>
												<option value="Франция">Франция</option>
												<option value="ФранцузскаяГвиана">ФранцузскаяГвиана</option>
												<option value="ФранцузскаяПолинезия">ФранцузскаяПолинезия</option>
												<option value="ФранцузскиеЮжныеиАнтарктическиеТерритории">ФранцузскиеЮжныеиАнтарктическиеТерритории</option>
												<option value="Хорватия">Хорватия</option>
												<option value="ЦентральноафриканскаяРеспублика">ЦентральноафриканскаяРеспублика</option>
												<option value="Чад">Чад</option>
												<option value="Черногория">Черногория</option>
												<option value="Чехия">Чехия</option>
												<option value="Чили">Чили</option>
												<option value="Швейцария">Швейцария</option>
												<option value="Швеция">Швеция</option>
												<option value="Шпицберген">Шпицберген</option>
												<option value="Шри-Ланка">Шри-Ланка</option>
												<option value="Эквадор">Эквадор</option>
												<option value="ЭкваториальнаяГвинея">ЭкваториальнаяГвинея</option>
												<option value="Эритрея">Эритрея</option>
												<option value="Эстония">Эстония</option>
												<option value="Эфиопия">Эфиопия</option>
												<option value="ЮжнаяГеоргияиЮжныеСандвичевыострова">ЮжнаяГеоргияиЮжныеСандвичевыострова</option>
												<option value="ЮжнаяКорея">ЮжнаяКорея</option>
												<option value="Южно-АфриканскаяРеспублика">Южно-АфриканскаяРеспублика</option>
												<option value="ЮжныйСудан">ЮжныйСудан</option>
												<option value="Ямайка">Ямайка</option>
												<option value="Япония">Япония</option>
											</select>
										</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group" id='regionListBlock'>
										<label class="control-label mainlabel" for="lk_input1">Регион</label>
										<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='regionsList' name='regionId'>
											<option value=''></option>
<?
							//выберем папки из информационного блока $blockId и раздела 0.
							$items = GetIBlockSectionList(IBLOCK_ID_CITY, 0, array("sort" => "asc"));
							while ($arItem = $items->GetNext())
								echo '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';
?>
										</select>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group hide" id='areaListBlock'>
										<label class="control-label mainlabel" for="lk_input1">Область</label>
										<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='areaList' name='areaId'>
										</select>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group hide" id='citiesListBlock'>
										<label class="control-label mainlabel" for="lk_input1">Город</label>
										<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id='citiesList' name='cityId'>
										</select>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group hide" id='cityNameBlock'>
									<label class="control-label mainlabel" for="cityName">Город</label>
									<input type="text" class="form-control" id="cityName" value="" name='cityName'>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_input4">Название</label>
									<input type="text" class="form-control" id="lk_input4" value="" name='companyName'>
								</div>							
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_input1">Тип компании</label>
									<select class="selectpicker selectboxbtn form-control minbr" name='typeCompanyId'>
									<option value=''>Bce</option>
<?
										$blockId = IBLOCK_ID_COMPANY;
										//выберем папки из информационного блока $blockId и раздела 0.
										$items = GetIBlockSectionList($blockId, 0, array("sort" => "asc"));
										while ($arItem = $items->GetNext())
											echo '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';
?>
									</select>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_input4">Описание</label>
									<input type="text" class="form-control" id="lk_input4" value="" name='description'>
								</div>
								<div class="seporator lksep"></div>
								<button class="btn btn-blue-full minbr">Найти</button>
							</div>
						</div>
					</form>
				</div>
	<div class="block-default block-shadow content-margin fliteralphabetblock clearfix show_rus">
		<div class="langselect btn-group floatleft" data-toggle="buttons">
		  <label class="btn btn-light-blue minbr active">
			<input type="radio" name="options" id="option1" value="show_rus" autocomplete="off" checked>Rus</label>
		  <label class="btn btn-light-blue minbr">
			<input type="radio" name="options" id="option2" value="show_eng" autocomplete="off">Eng</label>
		</div>
		<div class="fliteralphabetshowall floatright">
			<a href="/company/list/"><i class="icon-icons_main-05"></i>Показать все</a>
		</div>
		<div class="fliteralphabet">
			<div class="btn btn-light-blue minbr prewslid"><i class="icon-icons_main-09"></i></div>
			<div class="paginationbox">
				<? $APPLICATION->IncludeFile('/tpl/include_area/firstLetterFilter.php', array(), array()); ?>
			</div>
			<div class="btn btn-light-blue minbr nextslid"><i class="icon-icons_main-08"></i></div>
		</div>
	</div>
			
			
<?
global $arFilter;

if (isset($_GET['firstLetter']) && !empty($_GET['firstLetter']))
	$name = $_GET['firstLetter'];
elseif (isset($_GET['companyName']) && !empty($_GET['companyName']))
	$name = $_GET['companyName'];

if (isset($name) && !empty($name))
{
	if (empty($_GET['firstLetter']))
		$arFilter["NAME"] = '%' . $name . "%";
	else
		$arFilter["NAME"] = $name . "%";
}

if (isset($_GET['typeCompanyId']) && !empty($_GET['typeCompanyId']))
	$arFilter['SECTION_ID'] = $_GET['typeCompanyId'];

if (isset($_GET['description']) && !empty($_GET['description']))
	$arFilter['DETAIL_TEXT'] = '%' . $_GET['description'] . '%';

if (isset($_GET['regionId']) && !empty($_GET['regionId']))
	$arFilter['PROPERTY_region'] = $_GET['regionId'];

if (isset($_GET['areaId']) && !empty($_GET['areaId']))
	$arFilter['PROPERTY_area'] = $_GET['areaId'];

if (isset($_GET['cityId']) && !empty($_GET['cityId']))
	$arFilter['PROPERTY_city'] = $_GET['cityId'];

if (isset($_GET['cityName']) && !empty($_GET['cityName']))
	$arFilter['PROPERTY_userCity'] = $_GET['cityName'];

if (isset($_GET['country']) && !empty($_GET['country']))
{
	if ('Россия' !== $_GET['country'])
		$arFilter['PROPERTY_country'] = $_GET['country'];
}

//pre($arFilter);

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"companys", 
	array(
		"COMPONENT_TEMPLATE" => "companys",
		"IBLOCK_TYPE" => "Company",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "500",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "userCity",
			1 => "contactPerson",
			2 => "placeInRating",
			3 => "timeBegin",
			4 => "dateBegin",
			5 => "FORUM_MESSAGE_CNT",
			6 => "city",
			7 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/company/#SECTION_CODE#/#ELEMENT_CODE#/",
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
);
?>
	<!-- end Компании -->
<?
	$APPLICATION->IncludeComponent("bitrix:menu", "BrandLocation", Array(
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
			"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
			"DELAY" => "N",	// Откладывать выполнение шаблона меню
			"MAX_LEVEL" => "3",	// Уровень вложенности меню
			"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
				0 => "",
			),
			"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
			"MENU_CACHE_TYPE" => "Y",	// Тип кеширования
			"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
			"ROOT_MENU_TYPE" => "BrandLocation",	// Тип меню для первого уровня
			"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		),
		false
	);
?>
			</div>
		</div>
	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>