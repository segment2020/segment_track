<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?><div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="row">
				 <?$APPLICATION->IncludeFile('/tpl/include_area/bannersContent.php', array('includeArea' => array('newitems', 'developments', 'licenses', 'pricelists')), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>
			Обратная связь </h1>
			 <?$APPLICATION->IncludeComponent(
	"wp:form",
	"",
Array()
);?><br>
			 <!-- <div class="col-xs-9 content-margin"> --><br>
		</div>
	</div>
</div>
&nbsp;<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>