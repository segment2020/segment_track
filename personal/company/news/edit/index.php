<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Page\Asset;
$APPLICATION->SetTitle("Добавить новость");

?>
<div class="container-fluid">
	<div class="row">
		<?
		$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array()); 

		if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
		{
			if (isset($_GET['iBlockId']) && !empty($_GET['iBlockId'])) 
			{
				
				$APPLICATION->SetTitle("Редактировать новость");
				if ($_GET['iBlockId'] == 2) { 
					$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( 
						"iBlockId" => IBLOCK_ID_NEWS_COMPANY, 
						"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_COMPANY, 
						"iBlockType" => "news",
						"moveToId" => PROPERTY_ID_MOVE_TO_IN_NEWS_COMPANY,	// Код новости
					)); } 
				if ($_GET['iBlockId'] == 5) { 
					$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array(
						"iBlockId" => IBLOCK_ID_NEWS_INDUSTRY, 
						"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_INDUSTRY, 
						"moveToId" => PROPERTY_ID_MOVE_TO_IN_NEWS_INDUSTRY,
						"iBlockType" => "news",
					)); }
			}
			else
			{
		?>
		<div class="col-sm-3 col-xs-12 content-margin" id="article">
			<a href="/personal/company/news?iBlockId=<? echo IBLOCK_ID_NEWS_COMPANY; ?>" class="list-group-item">Новости компании</a>
			<a href="/personal/company/news?iBlockId=<? echo IBLOCK_ID_NEWS_INDUSTRY; ?>" class="list-group-item">Новости отрасли</a>
		</div>
		<?
			} 
		} 
		elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
		{ 
			if ($_GET['iBlockId'] == 2) { 
				$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array(
					"iBlockId" => IBLOCK_ID_NEWS_COMPANY, 
					"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_COMPANY, 
					"iBlockType" => "news",
					"moveToId" => PROPERTY_ID_MOVE_TO_IN_NEWS_COMPANY,
				)); }  
			if ($_GET['iBlockId'] == 5) { 
				$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array(
					"iBlockId" => IBLOCK_ID_NEWS_INDUSTRY, 
					"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_INDUSTRY, 
					"moveToId" => PROPERTY_ID_MOVE_TO_IN_NEWS_INDUSTRY,
					"iBlockType" => "news",
				)); } 
		}
		?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>