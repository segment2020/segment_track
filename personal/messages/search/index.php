<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
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
	"wp:forum.pm.search",
	"",
	array(
		"PM_USER_PAGE" => $arResult["PM_USER_PAGE"],
		"URL_TEMPLATES_PROFILE_VIEW" => $arResult["URL_TEMPLATES_PROFILE_VIEW"],
		"URL_TEMPLATES_PM_LIST" => $arResult["URL_TEMPLATES_PM_LIST"],
		"URL_TEMPLATES_PM_READ" => $arResult["URL_TEMPLATES_PM_READ"],
		"URL_TEMPLATES_PM_EDIT" => $arResult["URL_TEMPLATES_PM_EDIT"],
		"URL_TEMPLATES_PM_SEARCH" => $arResult["URL_TEMPLATES_PM_SEARCH"],
		"PAGE_NAVIGATION_TEMPLATE" => $arParams["PAGE_NAVIGATION_TEMPLATE"],
		"PAGE_NAVIGATION_WINDOW" =>  $arParams["PAGE_NAVIGATION_WINDOW"],
		"NAME_TEMPLATE"	=> $arParams["NAME_TEMPLATE"],
		"SEO_USER" => $arParams["SEO_USER"]
	),
	$component
);
?>

		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>