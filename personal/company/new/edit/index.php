<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Page\Asset; 
$APPLICATION->SetTitle("Редактировать новинку");
?>
<div class="container-fluid">
	<div class="row"> 
		<?
		$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array()); 

		if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
		{ 
			$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( 
				"iBlockId" => IBLOCK_ID_NOVETLY,  
				"iBlockType" => "new",
				"elementCode" => "#SITE_DIR#/personal/new/edit/#ELEMENT_CODE#/",	// Код новости
			 ));    
		} 
		elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
		{ 
			$APPLICATION->SetTitle("Добавить новинку");
			$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array(
				"iBlockId" => IBLOCK_ID_NOVETLY, 
				"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NOVETLY,
				"moveToId" => PROPERTY_ID_MOVE_TO_IN_NOVETLY 
			)); 
		}
		?> 
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>