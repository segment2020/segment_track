<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Page\Asset;
$APPLICATION->SetTitle("Редактировать мнение"); 

?>
<div class="container-fluid">
	<div class="row"> 
		<? 
		$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());
		 
 
		if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
		{ 
			$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( 
				"iBlockId" => IBLOCK_ID_VIEWPOINT,  
				"iBlockType" => "viewpoint",
				"elementCode" => "#SITE_DIR#/personal/viewpoint/edit/#ELEMENT_CODE#/",	// Код новости
			 ));  
		}
		elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
		{ 
			$APPLICATION->SetTitle("Добавить мнение");
			$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array( 
				"iBlockId" => IBLOCK_ID_VIEWPOINT, 
				"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_VIEWPOINT,
				"iBlockType" => "viewpoint",
				"moveToId" => PROPERTY_ID_MOVE_TO_IN_VIEWPOINT
			)); 
		}
		?> 
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>