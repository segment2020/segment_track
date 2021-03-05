<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить событие"); 

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
	$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( "iBlockId" => IBLOCK_ID_NEWS_COMPANY, "jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_COMPANY ));  
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{ 
	$APPLICATION->IncludeFile('/tpl/include_area/newCreateElement.php', Array( "iBlockId" => IBLOCK_ID_NEWS_COMPANY, "jsonDataId" => PROPERTY_ID_JSON_DATA_IN_NEWS_COMPANY )); 
}
?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>