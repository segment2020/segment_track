<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка на рассылку");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>
		
		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>Подписка на рассылку</h1>
		
<?
	$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form", 
	"subscription", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"PAGE" => "#SITE_DIR#subscription/?sub=OK",
		"SHOW_HIDDEN" => "N",
		"USE_PERSONALIZATION" => "Y",
		"COMPONENT_TEMPLATE" => "subscription"
	),
	false
);
?>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>