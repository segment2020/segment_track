<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>

<div class="container-fluid">
	<div class="row row-flex">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<?
$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
// pre($arUser);
?>

		<div class="col-sm-9 col-xs-12 content-margin" id="article">
			<h1>Оформление заказа</h1>
				<div class="block-default in block-shadow content-margin">
					<div class="row">
						<form name="iblock_add" action="/formsActions/" method="POST" id='order' enctype="multipart/form-data">
							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_name">ФИО</label>
									<input type="text" class="form-control" id="lk_name" name='name' value="<? echo $arUser['NAME'] . ' ' . $arUser['LAST_NAME']; ?>">
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_phone">Телефон</label>
									<input type="text" class="form-control" id="lk_phone" name='phone' value="<? echo $arUser['PERSONAL_PHONE']; ?>">
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_email">Email</label>
									<input type="text" class="form-control" id="lk_email" name='email' value="<? echo $arUser['EMAIL']; ?>">
								</div>
							</div>

							<div class="col-xs-12">
								<div class="form-group">
									<label class="control-label mainlabel" for="lk_comment">Комментарии к заказу</label>
									<textarea class='form-control maintextarea' id="lk_comment" name="comments"></textarea>
								</div>
							</div>

							<div class="col-xs-12">
								<input type='hidden' id='companyId' name='companyId' value='<? echo $_POST['companyId']; ?>'>
								<input type='hidden' id='createOrder' name='actionNum' value='createOrder'>
								<input type="submit" name="iblock_submit" value="Оформить" class="btn btn-blue-full minbr">
							</div>
						</form>
<?
/*
$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "N",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/basket/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "N",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "N",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_VAT_PRICE" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "green",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
*/
?>

				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>