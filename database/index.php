<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// use \Bitrix\Main\Loader;
// phpinfo();
// exit();
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('newitems', 'developments', 'licenses', 'pricelists')), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
			<a href='/database/action/?blockId=99999'>Создать таблицу соответсвий ID городов</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_COMPANY; ?>'>Перенос компаний</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_USERS; ?>'>Перенос пользователей</a>
			<br>			
			<a href='/database/action/?blockId=88888'>Синхронизация пользователей с фирмами</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_PRICE_LISTS; ?>'>Перенос прайс-листов</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_NEWS_COMPANY; ?>'>Перенос новостей компании</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_NEWS_INDUSTRY; ?>'>Перенос новостей индустрии</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_NOVETLY; ?>'>Перенос новинок</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_LICENSE; ?>'>Перенос лицензий</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_BRANDS; ?>'>Перенос брендов</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_ANALYTICS; ?>'>Перенос аналитики</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_LIFE_INDUSTRY; ?>'>Перенос жизнь отрасли</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_PRODUCTS_REVIEW; ?>'>Перенос товарных обзоров</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_GALLERY_VIDEO; ?>'>Перенос видеогалереи</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_GALLERY_PHOTO; ?>'>Перенос фотогалереи</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_VIEWPOINT; ?>'>Перенос мнений</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_STOCK; ?>'>Перенос акций</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_CATALOGS_PDF; ?>'>Перенос каталогов PDF</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_EVENTS; ?>'>Перенос событий</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_DEFAULTERS; ?>'>Перенос неплательщиков</a>
			<br>
			<a href='/database/action/?blockId=66666'>Перенос бывщих неплательщиков</a>
			<br>
			<a href='/database/action/?blockId=77777'>Перенос структуры каталога</a>
			<br>
			<a href='/database/action/?blockId=<? echo IBLOCK_ID_CATALOG; ?>'>Перенос каталога</a>
		</div>
	</div>
</div>
<?

/*
$host = '84.52.108.254';
$database = 'segment_ru';
$user = 'root';
$password = '55555';

try {
	$instance = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	// pre($instance);
} catch (PDOException $e) {
	// pre('Ошибка соединения с базой данных! ' . $e->getMessage());
	throw new Exception('Ошибка соединения с базой данных '.$e->getMessage());
}
*/


/*
$arFields['NAME'] = 'Name';
$arFields['TAGS'] = 'Tags';
$arFields['PREVIEW_TEXT'] = 'PREVIEW_TEXT';
$arFields['DETAIL_TEXT'] = 'DETAIL_TEXT';
$arFields['ACTIVE'] = 'Y';
$arFields["IBLOCK_SECTION_ID"] = false;
$arFields["IBLOCK_ID"] = IBLOCK_ID_NEWS_COMPANY;
$arFields["API"] = true;

if (Loader::includeModule('iblock'))
{
	$el = new CIBlockElement();
	if ($newId = $el->Add($arFields))
	{
		echo $newId;
	}
	else
	{
		echo 'Error: ' . $el->LAST_ERROR;
	}
}
*/





// выполняем подключение к серверу
// $link = mysqli_connect($host, $user, $password, $database)
// or die("Ошибка подключения " . mysqli_error($link));
// выполняем различные операции с базой данных

// закрываем подключение к серверу
// mysqli_close($link);

?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>