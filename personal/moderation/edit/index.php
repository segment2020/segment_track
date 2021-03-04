<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактировать материал");
?>
<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch();   
$res = CIBlockElement::GetByID($_GET["elementId"]); 
if($ar_res = $res->GetNext())  {
	console_log($ar_res["ACTIVE"]);
	$APPLICATION->IncludeFile('/tpl/include_area/newEditElement.php', Array( 
		"iBlockId" => $ar_res['IBLOCK_ID'],  
		"iBlockType" => $ar_res['IBLOCK_TYPE_ID'],
		"iBlockIsActive" => $ar_res["ACTIVE"],
	));
}
?>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>