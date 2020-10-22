<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статистика просмотров");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 ">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/new-members.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>						
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/komments.php', array(), array());?>				
			</div>					
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
<?
$companyId = $_GET['companyId'];

$strSql = "SELECT `NAME` FROM `b_iblock_element` WHERE `ID` = '" . $companyId . "'";
$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
if ($company = $res->GetNext())
	$companyName = $company['NAME'];
?>
			<h2>Статистика просмотров компании <? echo $companyName; ?></h2>
			<div class='block-default in block-shadow content-margin corpnewsblock'>
<?
$stat = array();
// $strSql = "SELECT * FROM `segment_views` WHERE MONTH(`CUR_DATE`) = MONTH(NOW()) AND YEAR(`CUR_DATE`) = YEAR(NOW()) AND `COMPANY_ID` = '" . $companyId . "' AND `IBLOCK_ID` != '" . IBLOCK_ID_BANNERS . "' ORDER BY `ID` DESC";
$strSql = "SELECT * FROM `segment_views` WHERE MONTH(`CUR_DATE`) = MONTH(NOW()) AND YEAR(`CUR_DATE`) = YEAR(NOW()) AND `COMPANY_ID` = '" . $companyId . "' AND `IBLOCK_ID` != '" . IBLOCK_ID_BANNERS . "' ORDER BY `ID` DESC";
$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
while ($company = $res->GetNext())
	$stat[$company['CUR_DATE']][$company['IBLOCK_ID']] += $company['NUM_VIEWS'];


$strSql = "SELECT * FROM `segment_banners` WHERE `companyid` = '" . $companyId . "' ORDER BY `ID` DESC";
$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
while ($banner = $res->GetNext())
	$stat[$banner['datecreate']][IBLOCK_ID_BANNERS] += $banner['clicksnumber'];


// pre($stat);
foreach ($stat as $date => $value)
{
	$totalDayNumViews = 0;
?>
				<div class='newsbitem clearfix'>
					<div class="newsbimg floatleft text-center">
						<? echo $date; ?>
					</div>
<?
	foreach ($value as $blockId => $numView)
	{
		switch ($blockId)
		{
			case IBLOCK_ID_COMPANY:
			{
				$title = 'Карточка компании'; break;
			}
			case IBLOCK_ID_NEWS_COMPANY:
			{
				$title = 'Новости компании'; break;
			}
			case IBLOCK_ID_CATALOG:
			{
				$title = 'Товары компании'; break;
			}
			case IBLOCK_ID_STOCK:
			{
				$title = 'Акции'; break;
			}
			case IBLOCK_ID_NEWS_INDUSTRY:
			{
				$title = 'Новости индустрии'; break;
			}
			case IBLOCK_ID_VIEWPOINT:
			{
				$title = 'Точка зрения'; break;
			}
			case IBLOCK_ID_GALLERY_PHOTO:
			{
				$title = 'Фотогалерея'; break;
			}
			case IBLOCK_ID_GALLERY_VIDEO:
			{
				$title = 'Видеогалерея'; break;
			}
			case IBLOCK_ID_EVENTS:
			{
				$title = 'События'; break;
			}
			case IBLOCK_ID_PRODUCTS_REVIEW:
			{
				$title = 'Товарные обзоры'; break;
			}
			case IBLOCK_ID_PRICE_LISTS:
			{
				$title = 'Прайс листы'; break;
			}
			case IBLOCK_ID_BRANDS:
			{
				$title = 'Бренды'; break;
			}
			case IBLOCK_ID_LICENSE:
			{
				$title = 'Лицензии'; break;
			}
			case IBLOCK_ID_NOVETLY:
			{
				$title = 'Новинки'; break;
			}
			case IBLOCK_ID_BANNERS:
			{
				$title = 'Кликов по баннерам'; break;
			}
			case IBLOCK_ID_CATALOGS_PDF:
			{
				$title = 'Каталоги PDF'; break;
			}
			default:
			{
				$title = 'Дргуие разделы';
			}
		}
?>
		<div class="newsbtext">
			<? echo $title . ':'; ?>
			<span class='numViews'><? echo $numView; ?></span>
		</div>
<?
		$totalDayNumViews += $numView;
	}
?>
					<br>
					<div class="newsbtext">
						<span class='numViewsTotal'>Всего: <? echo $totalDayNumViews; ?></span>
					</div>
				</div>
				<div class='seporator'>
				</div>
<?
}

?>
			</div>
<?

/*

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"top100", 
	array(
		"COMPONENT_TEMPLATE" => "top100",
		"IBLOCK_TYPE" => "Company",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "100",
		"SORT_BY1" => "property_rating",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "property_rating",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "dateUpdateRating",
			1 => "placeInRating",
			2 => "rating",
			3 => "FORUM_MESSAGE_CNT",
			4 => "",
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
		"PAGER_TEMPLATE" => "custom",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
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
*/
?>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>