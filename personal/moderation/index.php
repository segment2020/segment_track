<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Модерация");
?>
<div class="container-fluid">
	<div class="row">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
    $currentUserId = $USER->GetID();
    $rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля
    $arUser = $rsUser->Fetch();

    $APPLICATION->IncludeComponent(
        "bitrix:news.index",
        "moderatorFeed",
        array(
        "IBLOCKS" => array(   // Код информационного блока
           0 => "2",
           1 => "5",
           2 => "9",
           3 => "10",
           4 => "15",
           5 => "4",
           6 => "20", 
        ),
        "NEWS_COUNT" => "5",   // Количество новостей в каждом блоке
        "IBLOCK_SORT_BY" => "SORT",   // Поле для cортировки информационных блоков
        "IBLOCK_SORT_ORDER" => "ASC",   // Направление для cортировки информационных блоков
        "SORT_BY1" => "ID",   // Поле для первой сортировки новостей
        "SORT_ORDER1" => "RAND",   // Направление для первой сортировки новостей
        "FIELD_CODE" => "",   // Поля
        "PROPERTY_CODE" => "",   // Свойства
        "FILTER_NAME" => "arrFilter",   // Имя массива со значениями фильтра для фильтрации элементов
        "IBLOCK_URL" => "",   // URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => "",   // URL, ведущий на страницу с содержимым элемента раздела
        "ACTIVE_DATE_FORMAT" => "d.m.Y",   // Формат показа даты
        "CACHE_TYPE" => "A",   // Тип кеширования
        "CACHE_TIME" => "36000000",   // Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",   // Учитывать права доступа
        ),
        false
    );
}
?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>