<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Правила обсуждения");
?>

	<div class="container-fluid">
		<div class="row row-flex">
			<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
				<div class="row">
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array());?>
					<div class="col-xs-12 content-margin">
						<div class="infoblock"></div>
					</div>					
					<?$APPLICATION->IncludeFile('/tpl/widgets/left/defaulters.php', array(), array());?>
				</div>
			</div>
			<div class="col-sm-9 col-xs-12 content-margin">
				<h1>Правила портала</h1>
				<div class="block-default in block-shadow content-margin detailblock">
					<?$APPLICATION->IncludeFile('/tpl/include_area/rules.php', array(), array());?>
				</div>
			</div>			
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>