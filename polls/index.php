<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опросы");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/events.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/komments.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array());?>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/defaulters.php', array(), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>Опросы</h1>
<?
	$APPLICATION->IncludeComponent(
		"bitrix:voting.list", 
		"voting", 
		array(
			"CHANNEL_SID" => array(
			),
			"VOTE_FORM_TEMPLATE" => "vote_new.php?VOTE_ID=#VOTE_ID#",
			"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#",
			"COMPONENT_TEMPLATE" => "voting"
		),
		false
	);
?>
		</div> <!-- end div class="row"> -->
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>