<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<?if($USER->IsAuthorized()) 
{?>
<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<? } elseif (empty($arResult['ERRORS']) && !empty($arResult['VALUES'])) { ?>
	<? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT"); ?>
<? } else {?>
<?
if (count($arResult["ERRORS"]) > 0) {
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

}/* elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<? }*/ ?>
<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
	<input type="hidden" name="TYPE" value="REGISTRATION"/>
	<input type="hidden" name="register_submit_button" value="Y"/>
	<? /*<input type="text" class="api-mf-antibot" value="" name="ANTIBOT[NAME]"> */?> 
	<input type="hidden" name="backurl" value="" class="backurl">
<?
if($arResult["BACKURL"] <> '') {
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD) {?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true) 
	{?>


		<tr>
			<td><?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y") { ?><span class="starrequired">*</span><? } ?></td>
			<td>
				<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
					<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
					<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
					<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
			<td>
				<select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
				<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name) 
				{ ?>
					<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
				<? } ?>
				</select>
			</td>
		</tr>
	<? } else { ?>
		<div class="form-group">
			<label class="control-label mainlabel"><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y") { ?><span class="starrequired">*</span><? } ?></label>
			<?
	switch ($FIELD)
	{
		case "PASSWORD":
			?><input class="form-control" size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
			<?if($arResult["SECURE_AUTH"]) 
			{ ?>
							<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
								<div class="bx-auth-secure-icon"></div>
							</span>
							<noscript>
							<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
								<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
							</span>
							</noscript>
			<script type="text/javascript">
			document.getElementById('bx_auth_secure').style.display = 'inline-block';
			</script>
			<? } ?>
<?		break;
		case "CONFIRM_PASSWORD":
			?><input class="form-control" size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
		break;
		case "PERSONAL_GENDER":
			?><select class="selectpicker selectboxbtn form-control minbr" name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
		break;
		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
		break;
		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input class="form-control" size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
		break;
		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea class="form-control" cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
		break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY") { ?><small><?=$arResult["DATE_FORMAT"]?></small><br /><? } ?>
			<input class="form-control" size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?>
		</div>
<? } ?>
<? } ?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y") 
{ ?>
	<? /* ?><p><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></p><? */ ?>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField) 
	{?>
		<div class="form-group">
			<label class="control-label mainlabel" for="lk_input5"><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"){?><span class="starrequired">*</span><?}?></label>
			<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
		</div>
	<? } ?>
<? } ?>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<div class="form-group">
			<label class="control-label mainlabel" for="lk_input5"><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></label> 
			<table> 
				<tr>
					<td><input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img class="capcha-img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
					<td><input class="form-control margin-" type="text" name="captcha_word" maxlength="50" value="" /></td>
				</tr>
			</table>
		</div>
	<?
}
/* !CAPTCHA */
?>
	<div class="btnblock text-center">
		<button class="btn btn-blue-full minbr" name="register_submit_button" ><?=GetMessage("AUTH_REGISTER")?><i class="icon-icons_main-10"></i></button>
	</div> 
	<p class="reg-agree">
	Регистрируясь, вы соглашаетесь с <a href="/rules">правилами пользования сайтом</a> и даёте <a href="agreement/">согласие на обработку персональных даных</a>.
	</p> 
</form>
<?}?>
  