<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сообщения");
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
	"wp:forum.pm.folder", 
	"personalMessages", 
	array(
		"SET_TITLE" => "N",
		"SET_NAVIGATION" => "N",
		"CACHE_TIME" => $arResult["CACHE_TIME"],
		// "URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
		"URL_TEMPLATES_PM_LIST" => "list/?PAGE_NAME=pm_edit&FID=#FID#&by=post_date&order=desc",
		"URL_TEMPLATES_PM_FOLDER" => $arResult["URL_TEMPLATES_PM_FOLDER"],
		"URL_TEMPLATES_PM_EDIT" => "new/?PAGE_NAME=pm_edit&FID=1&MID=0&mode=new&by=post_date&order=desc",
		"URL_TEMPLATES_PROFILE_VIEW" => $arResult["URL_TEMPLATES_PROFILE_VIEW"],
		"NAME_TEMPLATE" => "personalMessages",
		"COMPONENT_TEMPLATE" => "personalMessages",
		"URL_TEMPLATES_PM_READ" => "pm_read.php?MID=#MID#",
		"CACHE_TYPE" => "A"
	),
	$component
);
?>

		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>