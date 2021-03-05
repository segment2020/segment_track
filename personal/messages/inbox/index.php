<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Входящие сообщения");
?>
<div class="container-fluid">
	<div class="row">

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
	"wp:forum.pm.list", 
	".default", 
	array(
		"FID" => $arResult["FID"],
		"URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
		"URL_TEMPLATES_PM_READ" => "/personal/messages/inbox/read/?PAGE_NAME=pm_read&FID=#FID#&MID=#MID#",
		"URL_TEMPLATES_PM_EDIT" => $arResult["URL_TEMPLATES_PM_EDIT"],
		"URL_TEMPLATES_PM_FOLDER" => $arResult["URL_TEMPLATES_PM_FOLDER"],
		"URL_TEMPLATES_PROFILE_VIEW" => $arResult["URL_TEMPLATES_PROFILE_VIEW"],
		"PAGE_NAVIGATION_TEMPLATE" => "custom",
		"PM_PER_PAGE" => $arParams["PM_PER_PAGE"],
		"DATE_FORMAT" => $arParams["DATE_FORMAT"],
		"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
		"SET_NAVIGATION" => "Y",
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TIME" => $arResult["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"SET_TITLE" => "N",
		"SEO_USER" => $arParams["SEO_USER"],
		"COMPONENT_TEMPLATE" => ".default"
	),
	$component
);
?>

		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>