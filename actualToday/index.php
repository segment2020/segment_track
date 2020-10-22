<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Актуально сегодня");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="row">				
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/newitems.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>		
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/promotions.php', array(), array());?>							
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>	
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/brandblock.php', array(), array());?>	
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/licenses.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/pricelists.php', array(), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
<?
// Актуальное сегодня.
$GLOBALS['arrFilter'] = array("!PROPERTY_TOINDEX" => false, 'PROPERTY_actualToday_VALUE' => '1');
$APPLICATION->IncludeComponent("bitrix:news.index", "actualToday", Array(
	"IBLOCKS" => array(	// Код информационного блока
			0 => "1",
			1 => "2",
			2 => "4",
			3 => "5",
			4 => "8",
			5 => "9",
			6 => "10",
			7 => "14",
			8 => "15",
			9 => "17",
		),
		"NEWS_COUNT" => "2",	// Количество новостей в каждом блоке
		"IBLOCK_SORT_BY" => "ID",	// Поле для сортировки информационных блоков
		"IBLOCK_SORT_ORDER" => "ASC",	// Направление для сортировки информационных блоков
		"SORT_BY1" => "ID",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "RAND",	// Направление для первой сортировки новостей
		"FIELD_CODE" => array(	// Поля
			0 => "DATE_CREATE",
			1 => "SHOW_COUNTER",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "TOINDEX",
			2 => "actualToday",
			3 => "DATE_CREATE",
			4 => "SHOW_COUNTER",
		),
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"IBLOCK_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"COMPONENT_TEMPLATE" => "actualToday",
		"IBLOCK_TYPE" => "khayr",	// Тип информационных блоков
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	),
	false
);
?> 
		</div>
	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>