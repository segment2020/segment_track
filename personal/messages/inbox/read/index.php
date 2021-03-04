<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Прочитать");
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

$mode = $_GET['mode'];
if (!isset($mode))
{
	// Сообщения.
	$APPLICATION->IncludeComponent(
		"wp:forum.pm.read",
		"",
		array(
			"SET_TITLE" => $arResult["SET_TITLE"],
			"SET_NAVIGATION" => $arResult["SET_NAVIGATION"],
			"CACHE_TIME" => $arResult["CACHE_TIME"],
			"CACHE_TYPE" => $arResult["CACHE_TYPE"],
			// "URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
			"URL_TEMPLATES_PM_LIST" => '/personal/messages/inbox/?PAGE_NAME=pm_edit&FID=#FID#&by=post_date&order=desc',
			"URL_TEMPLATES_PM_READ" => $arResult["URL_TEMPLATES_PM_READ"],
			"URL_TEMPLATES_PM_EDIT" => $arResult["URL_TEMPLATES_PM_EDIT"],
			//"URL_TEMPLATES_PM_EDIT" => '/personal/messages/reply/?PAGE_NAME=pm_edit&FID=#FID#&by=post_date&order=desc&mode=reply',
			"URL_TEMPLATES_PM_SEARCH" => $arResult["URL_TEMPLATES_PM_SEARCH"],
			"URL_TEMPLATES_PM_FOLDER" => $arResult["URL_TEMPLATES_PM_FOLDER"],
			"URL_TEMPLATES_PROFILE_VIEW" => $arResult["URL_TEMPLATES_PROFILE_VIEW"],

			"MID" => $arResult["MID"],
			"FID" => $arResult["FID"],

			"DATE_TIME_FORMAT" =>  $arParams["DATE_TIME_FORMAT"],
			"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
			"SEO_USER" => $arParams["SEO_USER"]
			),
		$component
	);
}
else
{
	$APPLICATION->IncludeComponent(
		"bitrix:forum.pm.edit",
		"",
		array(
			"SET_TITLE" => $arResult["SET_TITLE"],
			"SET_NAVIGATION" => $arResult["SET_NAVIGATION"],
			"CACHE_TIME" => $arResult["CACHE_TIME"],
			"URL_TEMPLATES_PM_FOLDER" => $arResult["URL_TEMPLATES_PM_FOLDER"],
			//"URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
			"URL_TEMPLATES_PM_LIST" => '/personal/messages/inbox/?PAGE_NAME=pm_edit&FID=#FID#&by=post_date&order=desc',
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
}
?>

		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>