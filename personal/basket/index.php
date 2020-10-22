<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<div class="container-fluid">
	<div class="row row-flex">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

		<div class="col-sm-9 col-xs-12 content-margin" id="article">
			<h1>Корзина</h1>
			<div class="block-default in block-shadow content-margin">
				<div class="row">
<?
$APPLICATION->IncludeComponent(
	"wp:sale.basket.basket", 
	"basket", 
	array(
		"COMPONENT_TEMPLATE" => "basket",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DELETE",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
		),
		"TEMPLATE_THEME" => "green",
		"PATH_TO_ORDER" => "/personal/ordering/",
		"HIDE_COUPON" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"CORRECT_RATIO" => "N",
		"AUTO_CALCULATION" => "Y",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"USE_GIFTS" => "N",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);
?>

				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>