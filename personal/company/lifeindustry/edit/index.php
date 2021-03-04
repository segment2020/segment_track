<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Page\Asset;

?>
<div class="container-fluid">
	<div class="row"> 
		<? 
		$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());
			
		if (CModule::IncludeModule("iblock"))
		{
			$arSelect = array();
			$arFilter = array("IBLOCK_ID" => $_GET['iBlockId'], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect); 
			if ($ob = $res->GetNextElement())
				$arProps = $ob->GetProperties();
		}  

		if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
		{  
			$APPLICATION->SetTitle("Редактировать статью");
			$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( 
				"iBlockId" => IBLOCK_ID_LIFE_INDUSTRY,  
				"iBlockType" => "lifeindustry",
				"elementCode" => "#SITE_DIR#/personal/lifeindustry/edit/#ELEMENT_CODE#/",	// Код новости
			 ));  
		}  
		elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
		{ 
			$APPLICATION->SetTitle("Добавить статью");
			$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array( 
				"iBlockId" => IBLOCK_ID_LIFE_INDUSTRY, 
				"jsonDataId" => PROPERTY_ID_JSON_DATA_IN_LIFE_INDUSTRY,
				"moveToId" => PROPERTY_ID_MOVE_TO_IN_LIFE_INDUSTRY 
		 )); 
		}
		?> 
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>