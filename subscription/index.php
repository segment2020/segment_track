<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/newitems.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>		
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/developments.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/brandblock.php', array(), array());?>	
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/pricelists.php', array(), array());?>				
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
		<h1>Подписаться на рассылку</h1>
<?
	$APPLICATION->IncludeComponent(
		"bitrix:subscribe.form", 
		"subscription", 
		array(
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"PAGE" => "#SITE_DIR#subscription/?subscribe=OK",
			"SHOW_HIDDEN" => "N",
			"USE_PERSONALIZATION" => "Y",
			"COMPONENT_TEMPLATE" => "subscription"
		),
		false
	);




// подписка пользователя
function subscribe($email) {
	if (!empty($email))
	{
		$message = 'В процессе возникла ошибка или указан неверный формат email. Попробуйте повторить позже или обратитесь к администратору сайта.';

		$subscr = new CSubscription;
		$subscription = CSubscription::GetByEmail($email); // поиск подписчика по mail
		if ($arSub = $subscription->Fetch()) {
			// если майл есть в подписчиках
			$message = 'Данный email уже имеется в базе подписчиков.';
		} else {
			// если нет подписки, то добавляем его
			$arFieldFilter = array(
							"FORMAT" => "html",
							"EMAIL" => $email,
							"ACTIVE" => "Y",
							"SEND_CONFIRM" => 'N'
						);

			$ID = $subscr->Add($arFieldFilter);
			if ($ID)
			{
 				// поиск подписчика по mail, что бы получить код потверждения
				$subscription = CSubscription::GetByEmail($email);              
				if ($arSub = $subscription->Fetch())
					$arResult['DATA_SUB_USSER'] = $arSub;

				// подтверждаем подписку
				$res = $subscr->Update(
								$ID,
								array(
									"CONFIRMED"=>"Y",
									"CONFIRM_CODE"=>$arResult['DATA_SUB_USSER']["CONFIRM_CODE"])
								);

				if ($res)
				{
					$message = 'Вы успешно подписаны на рассылку.';

					$arEventFields = array(
						"EMAIL" => $email,
					);
					$res = CEvent::Send("NEW_SUBCRIBER", SITE_ID, $arEventFields);
				}
			}

			unset($arResult);
		}
	}
	else
	{
		$message = 'Пустой email.';
	}

	return $message;
}


if ('OK' == $_POST['sub'])
{
	if (CModule::IncludeModule('subscribe'))
	{
		$message = subscribe($_POST['sf_EMAIL']);
?>
		<div class="block-default in block-shadow content-margin">
			<? echo $message; ?>
		</div>
<?
	}
}

?>
		</div>			
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>