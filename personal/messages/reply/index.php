<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новое сообщение");
?>
<div class="container-fluid">
	<div class="row row-flex">

<?
$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch();

$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'workPosition' => $arUser["WORK_POSITION"]), array());
?>

		<div class="col-sm-9 col-xs-12 content-margin">

<?
global $arrFilter;
$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY']);


// Сообщения.
$APPLICATION->IncludeComponent(
	"bitrix:forum.pm.edit",
	"",
	array(
		"SET_TITLE" => $arResult["SET_TITLE"],
		"SET_NAVIGATION" => $arResult["SET_NAVIGATION"],
		"CACHE_TIME" => $arResult["CACHE_TIME"],
		"URL_TEMPLATES_PM_FOLDER" => $arResult["URL_TEMPLATES_PM_FOLDER"],
		"URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
		"URL_TEMPLATES_PM_READ" => $arResult["URL_TEMPLATES_PM_READ"],
		"URL_TEMPLATES_PM_EDIT" => $arResult["URL_TEMPLATES_PM_EDIT"],
		"URL_TEMPLATES_PM_SEARCH" => $arResult["URL_TEMPLATES_PM_SEARCH"],
		"URL_TEMPLATES_PROFILE_VIEW" => $arResult["URL_TEMPLATES_PROFILE_VIEW"],

		"MID" => $arResult["MID"],
		"FID" => $arResult["FID"],
		"UID" =>  $arResult["UID"],
		"mode" =>  $arResult["mode"],
		
		"SMILES_COUNT" => $arParams["SMILES_COUNT"],
		"EDITOR_CODE_DEFAULT" => $arParams["EDITOR_CODE_DEFAULT"],
		"SEO_USER" => $arParams["SEO_USER"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"]
	),
	$component
);
?>

		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>