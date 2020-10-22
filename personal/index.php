<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>

<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"profile", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(
			0 => "UF_ID_COMPANY",
			1 => "UF_NICKNAME",
			2 => "UF_NAME_OR_LOGIN",
		),
		"USER_PROPERTY_NAME" => "",
		"COMPONENT_TEMPLATE" => "profile"
	),
	false
);
?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
