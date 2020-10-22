<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="block-default block-shadow lk_userinfo content-margin">
				<?
				if ('Логин или EMail не найдены.<br>' === $arParams["~AUTH_RESULT"]['MESSAGE'])
					$arParams["~AUTH_RESULT"]['MESSAGE'] = 'Логин или e-mail не найдены.<br>';

					ShowMessage($arParams["~AUTH_RESULT"]);
				?>
				<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
				<?
				if (strlen($arResult["BACKURL"]) > 0)
				{
				?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?
				}
				?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="SEND_PWD">
					<p><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>
					<div class="form-group">
						<label class="control-label mainlabel"><?=GetMessage("AUTH_EMAIL")?></label>
						<input class="form-control" type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>"  />
					</div>
					<?if($arResult["USE_CAPTCHA"]):?>
						<div class="form-group">
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
						</div>
						<div class="form-group">
							<label class="control-label mainlabel"><?echo GetMessage("system_auth_captcha")?></label>
							<input class="form-control" type="text" name="captcha_word" maxlength="50" value="" />
						</div>
					<?endif?>
					<div class="form-group btnblock">
						<button class="btn btn-blue-full minbr" name="send_account_info"><?=GetMessage("AUTH_SEND")?><i class="icon-icons_main-10"></i></button>
					</div>
					<div class="form-group">
						<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
					</div>
					<div class="form-group">
						<a href="#regauth-popup" class="reg-popup-link" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
					</div>
				</form>
				<script type="text/javascript">
					document.bform.USER_LOGIN.focus();
				</script>
			</div>
		</div>
	</div>
</div>