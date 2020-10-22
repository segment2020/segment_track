<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["SHOW_FORM"]) 
{ ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="block-default block-shadow lk_userinfo content-margin">
				<p><?echo $arResult["MESSAGE_TEXT"]?></p>
				<?//here you can place your own messages
					switch($arResult["MESSAGE_CODE"])
					{
					case "E01":
						?><? //When user not found
						break;
					case "E02":
						?><? //User was successfully authorized after confirmation
						break;
					case "E03":
						?><? //User already confirm his registration
						break;
					case "E04":
						?><? //Missed confirmation code
						break;
					case "E05":
						?><? //Confirmation code provided does not match stored one
						break;
					case "E06":
						?><? //Confirmation was successfull
						break;
					case "E07":
						?><? //Some error occured during confirmation
						break;
					}
					?>
				<form method="post" action="<?echo $arResult["FORM_ACTION"]?>">
					<div class="form-group">
						<label class="control-label mainlabel"><?echo GetMessage("CT_BSAC_LOGIN")?>:</label>
						<input class="form-control" type="text" name="<?echo $arParams["LOGIN"]?>" maxlength="50" value="<?echo $arResult["LOGIN"]?>" size="17" />
					</div>		
					<div class="form-group">
						<label class="control-label mainlabel"><?echo GetMessage("CT_BSAC_CONFIRM_CODE")?>:</label>
						<input class="form-control" type="text" name="<?echo $arParams["CONFIRM_CODE"]?>" maxlength="50" value="<?echo $arResult["CONFIRM_CODE"]?>" size="17" />
					</div>		
					<div class="form-group btnblock">
						<button type="submit" class="btn btn-blue-full minbr" name="send_account_info"><?echo GetMessage("CT_BSAC_CONFIRM")?><i class="icon-icons_main-10"></i></button>
					</div>		
					<input type="hidden" name="<?echo $arParams["USER_ID"]?>" value="<?echo $arResult["USER_ID"]?>" />
				</form>
			</div>
		</div>
	</div>
</div>
<? } elseif(!$USER->IsAuthorized()) {?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="block-default block-shadow lk_userinfo content-margin">
				<h3><?echo $arResult["MESSAGE_TEXT"]?></h3>
				<?//here you can place your own messages
					switch($arResult["MESSAGE_CODE"])
					{
					case "E01":
						?><? //When user not found
						break;
					case "E02":
						?><? //User was successfully authorized after confirmation
						break;
					case "E03":
						?><? //User already confirm his registration
						break;
					case "E04":
						?><? //Missed confirmation code
						break;
					case "E05":
						?><? //Confirmation code provided does not match stored one
						break;
					case "E06":
						?><? //Confirmation was successfull
						break;
					case "E07":
						?><? //Some error occured during confirmation
						break;
					}
					?>			
				</div>
			</div>
		</div>
	</div>						
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "", array());?>
<? } ?>
