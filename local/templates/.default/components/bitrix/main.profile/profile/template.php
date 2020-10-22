<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\UserGroupTable;
?>




<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
	$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
	$arUser = $rsUser->Fetch(); 
	if (!empty($arUser['PERSONAL_PHOTO']))
		$avatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$avatarFile['src'] = EMPTY_LOGO_AVATAR_PATH;
}
?>

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="userId" id='userId' value=<? echo $USER->GetID(); ?> />

<div class="col-sm-9 col-xs-12 content-margin" id="article">
	<h1>Профиль пользователя</h1>

<?
if (($arResult['DATA_SAVED'] == 'Y') || (0 !== strlen($arResult["strProfileError"])) )
{
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Уведомления</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<? ($arResult['DATA_SAVED'] == 'Y')? ShowNote(GetMessage('PROFILE_DATA_SAVED')): ShowError($arResult["strProfileError"]); ?>
				</div>
			</div>
		</div>
	</div>
<?}?>

<!-- ********************************************************************************************************** -->

	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Аватар</div>
		<div class="lk_companylogoblock clearfix">
			<div class="lk_companylogoimg floatleft">
				<img src="<? echo $avatarFile['src']; ?>" width='200px'>
			</div>
			<div class="lk_companylogotext ">
				<div class="lk_companylogotitle">Обновить аватар:</div>
				<div class="lk_companylogobtn">
					<input type="file" class='hide fileUpload' id='detailPicture' name="PERSONAL_PHOTO" />
					<label for='detailPicture'>
						<div class="btn btn-blue btnplus minbr">
							<span class="plus text-center">+</span>Выбрать изображение
						</div>
					</label>
					<span id='detailPictureFileName'></span>
				</div>
			</div>
		</div>
	</div>

<!-- ********************************************************************************************************** -->

	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Компания</div>
<? 		if (!empty($arResult["USER_PROPERTIES"]['DATA']['UF_ID_COMPANY']['VALUE']))
		{
			$arSelect = array();
			$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arResult["USER_PROPERTIES"]['DATA']['UF_ID_COMPANY']['VALUE'], "ACTIVE" => "Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			if ($ob = $res->GetNextElement())
			{
				$arProps = $ob->GetProperties(false, array('ID' => PROPERTY_ID_STAFF));
				$arFields = $ob->GetFields();
				// pre($arFields);
			}

			// $arSelect = array('ID', "NAME", 'PROPERTY_staff');
			// $arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arResult["USER_PROPERTIES"]['DATA']['UF_ID_COMPANY']['VALUE'], "ACTIVE" => "Y",
				// array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => IBLOCK_ID_COMPANY, "PROPERTY_staff" => $arUser['ID'])))
				// );
			// $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			// if ($ob = $res->GetNextElement())
				// $arFields = $ob->GetFields();
				

			$staff = false;
			if (isset($arProps['staff']))
			{
				foreach ($arProps['staff']['VALUE'] as $key => $userId)
				{
					if ($arUser['ID'] == $userId)
					{
						$staff = true;
						break;
					}
				}
			}

			// if (isset($arFields))
			if ($staff)
			{
?>
				<div id='userCompany'>
					Вы сотрудник компании <? echo $arFields['NAME']; ?>
<?					
					$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $arUser['ID'], 'GROUP_ID' => ID_GROUP_COMPANY_ADMIN)));
					if (!$res->fetch()) {
?>
						<div class="btn btn-blue-full minbr" id='fire'>Уволиться</div>
<?					} ?>
				</div>
				<div class='hide' id='message'>
					Вы уволились.
				</div>

				<script type="text/javascript">
					var el = document.getElementById('fire');
					var userId = document.getElementById('userId').value;
					if (!!el)
					{
						el.addEventListener('click', function(){
							$.ajax({
								type: 'POST',
								dataType: 'json',
								url: '/formsActions/',
								data: 'actionNum=2&userId=' + userId + '&self=true',
								success: function(request) {
									if ('OK' == request.message)
									{
										document.getElementById('userCompany').remove();
										document.getElementById('message').classList.remove("hide");
									}
								}
							});
						});
					}
				</script>
<?
			}
			else
			{
?>
				<div id='userCompany'>
					Подана заявка в компанию <? echo $arFields['NAME']; ?>
					<div class="btn btn-blue-full minbr" id='revoke'>Отозвать заявку</div>
				</div>
				<div class="hide" id='message'>Заявка отменена</div>
				<script type="text/javascript">
					var el = document.getElementById('revoke');
					el.addEventListener('click', function(){
						$.ajax({
							type: 'POST',
							dataType: 'json',
							url: '/formsActions/',
							data: 'actionNum=4',
							success: function(request) {
								if ('OK' == request.message)
								{
									document.getElementById('userCompany').remove();
									document.getElementById('message').classList.remove("hide");
								}
							}
						});
					});
				</script>
<?			}
		}
		else
		{
?>
			<div style='margin-bottom: 5px;'>Вы не привязаны к компании. Можете найти компанию в <a href="/company/" class='normalLink'>общем списке</a> и подать заявку или добавить свою компанию.</div>
			<? if (!CSite::InGroup(array(ID_GROUP_COMPANY_STAFF)) && !CSite::InGroup(array(ID_GROUP_COMPANY_ADMIN))) { ?>
			<div class="addfilterblock clearfix content-margin">
				<div class="addcompanyblock floatleft">
					<a href="/personal/companyadd/" class="btn btn-blue-full minbr"><span class="plus">+</span>Добавить свою компанию</a>
				</div>
				</div>
			<? } ?>
<?
		}
?>
	</div>
	<?
	// pre($arResult);
	?>

<!-- ********************************************************************************************************** -->
	
	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Личные данные</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userName"><?=GetMessage('NAME')?></label>
					<input type="text" class="form-control" id="lk_userName" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_lastName"><?=GetMessage('LAST_NAME')?></label>
					<input type="text" class="form-control" id="lk_lastName" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
				</div>							
			</div>		
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_secondName"><?=GetMessage('SECOND_NAME')?></label>
					<input type="text" class="form-control" id="lk_secondName" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
				</div>						
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group" id="lk_Sex">
					<label class="control-label mainlabel" for="lk_Sex"><?=GetMessage('USER_GENDER')?></label>
					<select name="PERSONAL_GENDER" class="selectpicker selectboxbtn form-control minbr">
						<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
						<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
						<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
					</select>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group" id="lk_Sex">
					<label class="control-label mainlabel" for="lk_login"><?=GetMessage('NICKNAME')?></label>
					<input type="text" class="form-control" id="lk_login" name="UF_NICKNAME" maxlength="50" value="<?=$arResult["USER_PROPERTIES"]["DATA"]['UF_NICKNAME']['VALUE']?>" />
				</div>
			</div>
<?
			foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField)
			{
				if ('UF_ID_COMPANY' == $FIELD_NAME);
					continue;

				if ($arUserField["MANDATORY"] == "Y")
				{
?>
					<span class="starrequired">*</span>
<?				}
?>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_input3"><? echo $arUserField["EDIT_FORM_LABEL"]; ?></label>
<?
						$APPLICATION->IncludeComponent(
							"bitrix:system.field.edit",
							$arUserField["USER_TYPE"]["USER_TYPE_ID"],
							array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y")
						);
?>
					</div>
				</div>
<?
			}
?>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group" id="lk_BD">
					<label class="control-label mainlabel" for="PERSONAL_BIRTHDAY"><?=GetMessage("USER_BIRTHDAY_DT")?></label>
					<?
						$APPLICATION->IncludeComponent(
							'bitrix:main.calendar',
							'calendarBirthDay',
							array(
								'SHOW_INPUT' => 'Y',
								'FORM_NAME' => 'form1',
								'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
								'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
								'SHOW_TIME' => 'N'
							),
							null,
							array('HIDE_ICONS' => 'Y')
						);

						//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
						?>
				</div>
			</div>
		</div>
		<div class="seporator lksep"></div>
	</div>

	<!--
	*********************************************************************
	* Контактные данные
	***************************************************************** -->
	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Контактные данные</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userICQ">Skype</label>
					<input type="text" class="form-control" id="lk_userICQ" name="PERSONAL_ICQ" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ICQ"]?>" />
				</div>						
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userSite"><?=GetMessage('USER_PHONE')?></label>
					<input type="text" class="form-control" id="lk_userSite" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_Country"><?=GetMessage('USER_COUNTRY')?></label>
					<? echo $arResult["COUNTRY_SELECT"]; ?>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userCity"><?=GetMessage('USER_CITY')?></label>
					<input type="text" class="form-control" id="lk_userCity" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" />
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userSite"><?=GetMessage('USER_WWW')?></label>
					<input type="text" class="form-control" id="lk_userSite" name="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" />
				</div>
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_position"><?=GetMessage("USER_POSITION")?></label>
					<input type="text" class="form-control" id="lk_position"name="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" />
				</div>				
			</div>			
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_userDescription"><?=GetMessage("USER_NOTES")?></label>
					<textarea cols="30" class="form-control" rows="5" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>
				</div>
			</div>

		</div>
		<div class="seporator lksep"></div>
	</div>
	
	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Смена пароля</div>
		<div class="row">
<?
			if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == '')
			{
?>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_password"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
						<input type="password" class="form-control" id="lk_password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
					</div>
				</div>
<?
				if($arResult["SECURE_AUTH"])
				{
?>
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
<?				}
?>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_confirmPassword"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
						<input type="password" class="form-control" id="lk_confirmPassword" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
					</div>
				</div>
<?			}
?>
		</div>
		<div class="seporator lksep"></div>
	</div>

	<div class="block-default in block-shadow content-margin ">
		<div class="block-title clearfix">Сохранить изменения</div>
		<input type="submit" class="btn btn-blue-full minbr" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
	</div>


	<input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
	<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />

	<?
	/*
	<input type="reset" value="<?=GetMessage('MAIN_RESET');?>">
	*/
	?>
</div>
</form>






<?
/*

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>


<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("REG_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('reg')"><?=GetMessage("REG_SHOW_HIDE")?></a></div>
<div class="profile-block-<?=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"?>" id="user_div_reg">
<table class="profile-table data-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
	<?
	if($arResult["ID"]>0)
	{
	?>
		<?
		if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
		{
		?>
		<tr>
			<td><?=GetMessage('LAST_UPDATE')?></td>
			<td><?=$arResult["arUser"]["TIMESTAMP_X"]?></td>
		</tr>
		<?
		}
		?>
		<?
		if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
		{
		?>
		<tr>
			<td><?=GetMessage('LAST_LOGIN')?></td>
			<td><?=$arResult["arUser"]["LAST_LOGIN"]?></td>
		</tr>
		<?
		}
		?>
	<?
	}
	?>
	<tr>
		<td><?echo GetMessage("main_profile_title")?></td>
		<td><input type="text" name="TITLE" value="<?=$arResult["arUser"]["TITLE"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('NAME')?></td>
		<td><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('LAST_NAME')?></td>
		<td><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('SECOND_NAME')?></font></td>
		<td><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></td>
		<td><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('LOGIN')?><span class="starrequired">*</span></td>
		<td><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></td>
	</tr>
<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_REQ')?></td>
		<td><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
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
		</td>
	</tr>
<?endif?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_CONFIRM')?></td>
		<td><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></td>
	</tr>
<?endif?>
<?if($arResult["TIME_ZONE_ENABLED"] == true):?>
	<tr>
		<td colspan="2" class="profile-header"><?echo GetMessage("main_profile_time_zones")?></td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_auto")?></td>
		<td>
			<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
		<td>
			<select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
				<option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
<?endforeach?>
			</select>
		</td>
	</tr>
<?endif?>
	</tbody>
</table>
</div>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('personal')"><?=GetMessage("USER_PERSONAL_INFO")?></a></div>
<div id="user_div_personal" class="profile-block-<?=strpos($arResult["opened"], "personal") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('USER_PROFESSION')?></td>
			<td><input type="text" name="PERSONAL_PROFESSION" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PROFESSION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_WWW')?></td>
			<td><input type="text" name="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_ICQ')?></td>
			<td><input type="text" name="PERSONAL_ICQ" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ICQ"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_GENDER')?></td>
			<td><select name="PERSONAL_GENDER">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>):</td>
			<td><?
			$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'',
				array(
					'SHOW_INPUT' => 'Y',
					'FORM_NAME' => 'form1',
					'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
					'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
					'SHOW_TIME' => 'N'
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);

			//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
			?></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_PHOTO")?></td>
			<td>
			<?=$arResult["arUser"]["PERSONAL_PHOTO_INPUT"]?>
			<?
			if (strlen($arResult["arUser"]["PERSONAL_PHOTO"])>0)
			{
			?>
			<br />
				<?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>
			<?
			}
			?></td>
		<tr>
			<td colspan="2" class="profile-header"><?=GetMessage("USER_PHONES")?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_PHONE')?></td>
			<td><input type="text" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_FAX')?></td>
			<td><input type="text" name="PERSONAL_FAX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_FAX"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_MOBILE')?></td>
			<td><input type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_PAGER')?></td>
			<td><input type="text" name="PERSONAL_PAGER" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PAGER"]?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="profile-header"><?=GetMessage("USER_POST_ADDRESS")?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_COUNTRY')?></td>
			<td><?=$arResult["COUNTRY_SELECT"]?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_STATE')?></td>
			<td><input type="text" name="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_CITY')?></td>
			<td><input type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_ZIP')?></td>
			<td><input type="text" name="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_STREET")?></td>
			<td><textarea cols="30" rows="5" name="PERSONAL_STREET"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_MAILBOX')?></td>
			<td><input type="text" name="PERSONAL_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MAILBOX"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_NOTES")?></td>
			<td><textarea cols="30" rows="5" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea></td>
		</tr>
	</tbody>
</table>
</div>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('work')"><?=GetMessage("USER_WORK_INFO")?></a></div>
<div id="user_div_work" class="profile-block-<?=strpos($arResult["opened"], "work") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('USER_COMPANY')?></td>
			<td><input type="text" name="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_WWW')?></td>
			<td><input type="text" name="WORK_WWW" maxlength="255" value="<?=$arResult["arUser"]["WORK_WWW"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_DEPARTMENT')?></td>
			<td><input type="text" name="WORK_DEPARTMENT" maxlength="255" value="<?=$arResult["arUser"]["WORK_DEPARTMENT"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_POSITION')?></td>
			<td><input type="text" name="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_WORK_PROFILE")?></td>
			<td><textarea cols="30" rows="5" name="WORK_PROFILE"><?=$arResult["arUser"]["WORK_PROFILE"]?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_LOGO")?></td>
			<td>
			<?=$arResult["arUser"]["WORK_LOGO_INPUT"]?>
			<?
			if (strlen($arResult["arUser"]["WORK_LOGO"])>0)
			{
			?>
				<br /><?=$arResult["arUser"]["WORK_LOGO_HTML"]?>
			<?
			}
			?></td>
		</tr>
		<tr>
			<td colspan="2" class="profile-header"><?=GetMessage("USER_PHONES")?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_PHONE')?></td>
			<td><input type="text" name="WORK_PHONE" maxlength="255" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_FAX')?></font></td>
			<td><input type="text" name="WORK_FAX" maxlength="255" value="<?=$arResult["arUser"]["WORK_FAX"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_PAGER')?></font></td>
			<td><input type="text" name="WORK_PAGER" maxlength="255" value="<?=$arResult["arUser"]["WORK_PAGER"]?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="profile-header"><?=GetMessage("USER_POST_ADDRESS")?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_COUNTRY')?></td>
			<td><?=$arResult["COUNTRY_SELECT_WORK"]?></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_STATE')?></td>
			<td><input type="text" name="WORK_STATE" maxlength="255" value="<?=$arResult["arUser"]["WORK_STATE"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_CITY')?></td>
			<td><input type="text" name="WORK_CITY" maxlength="255" value="<?=$arResult["arUser"]["WORK_CITY"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_ZIP')?></td>
			<td><input type="text" name="WORK_ZIP" maxlength="255" value="<?=$arResult["arUser"]["WORK_ZIP"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_STREET")?></td>
			<td><textarea cols="30" rows="5" name="WORK_STREET"><?=$arResult["arUser"]["WORK_STREET"]?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_MAILBOX')?></td>
			<td><input type="text" name="WORK_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["WORK_MAILBOX"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_NOTES")?></td>
			<td><textarea cols="30" rows="5" name="WORK_NOTES"><?=$arResult["arUser"]["WORK_NOTES"]?></textarea></td>
		</tr>
	</tbody>
</table>
</div>
	<?
	if ($arResult["INCLUDE_FORUM"] == "Y")
	{
	?>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('forum')"><?=GetMessage("forum_INFO")?></a></div>
<div id="user_div_forum" class="profile-block-<?=strpos($arResult["opened"], "forum") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage("forum_SHOW_NAME")?></td>
			<td><input type="checkbox" name="forum_SHOW_NAME" value="Y" <?if ($arResult["arForumUser"]["SHOW_NAME"]=="Y") echo "checked=\"checked\"";?> /></td>
		</tr>
		<tr>
			<td><?=GetMessage('forum_DESCRIPTION')?></td>
			<td><input type="text" name="forum_DESCRIPTION" maxlength="255" value="<?=$arResult["arForumUser"]["DESCRIPTION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('forum_INTERESTS')?></td>
			<td><textarea cols="30" rows="5" name="forum_INTERESTS"><?=$arResult["arForumUser"]["INTERESTS"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("forum_SIGNATURE")?></td>
			<td><textarea cols="30" rows="5" name="forum_SIGNATURE"><?=$arResult["arForumUser"]["SIGNATURE"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("forum_AVATAR")?></td>
			<td><?=$arResult["arForumUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arForumUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arForumUser"]["AVATAR_HTML"]?>
			<?
			}
			?></td>
		</tr>
	</tbody>
</table>
</div>

	<?
	}
	?>
	<?
	if ($arResult["INCLUDE_BLOG"] == "Y")
	{
	?>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('blog')"><?=GetMessage("blog_INFO")?></a></div>
<div id="user_div_blog" class="profile-block-<?=strpos($arResult["opened"], "blog") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('blog_ALIAS')?></td>
			<td><input class="typeinput" type="text" name="blog_ALIAS" maxlength="255" value="<?=$arResult["arBlogUser"]["ALIAS"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('blog_DESCRIPTION')?></td>
			<td><input class="typeinput" type="text" name="blog_DESCRIPTION" maxlength="255" value="<?=$arResult["arBlogUser"]["DESCRIPTION"]?>" /></td>
		</tr>
		<tr>
			<td><?=GetMessage('blog_INTERESTS')?></td>
			<td><textarea cols="30" rows="5" class="typearea" name="blog_INTERESTS"><?echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea></td>
		</tr>
		<tr>
			<td><?=GetMessage("blog_AVATAR")?></td>
			<td><?=$arResult["arBlogUser"]["AVATAR_INPUT"]?>
			<?
			if (strlen($arResult["arBlogUser"]["AVATAR"])>0)
			{
			?>
				<br /><?=$arResult["arBlogUser"]["AVATAR_HTML"]?>
			<?
			}
			?></td>
		</tr>
	</tbody>
</table>
</div>
	<?
	}
	?>
	<?if ($arResult["INCLUDE_LEARNING"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('learning')"><?=GetMessage("learning_INFO")?></a></div>
	<div id="user_div_learning" class="profile-block-<?=strpos($arResult["opened"], "learning") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=GetMessage("learning_PUBLIC_PROFILE");?>:</td>
				<td><input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <?if ($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y") echo "checked=\"checked\"";?> /></td>
			</tr>
			<tr>
				<td><?=GetMessage("learning_RESUME");?>:</td>
				<td><textarea cols="30" rows="5" name="student_RESUME"><?=$arResult["arStudent"]["RESUME"]; ?></textarea></td>
			</tr>

			<tr>
				<td><?=GetMessage("learning_TRANSCRIPT");?>:</td>
				<td><?=$arResult["arStudent"]["TRANSCRIPT"];?>-<?=$arResult["ID"]?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?if($arResult["IS_ADMIN"]):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('admin')"><?=GetMessage("USER_ADMIN_NOTES")?></a></div>
	<div id="user_div_admin" class="profile-block-<?=strpos($arResult["opened"], "admin") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=GetMessage("USER_ADMIN_NOTES")?>:</td>
				<td><textarea cols="30" rows="5" name="ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea></td>
			</tr>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
		<?endforeach;?>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>
	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<p>
	<input type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<input type="reset" value="<?=GetMessage('MAIN_RESET');?>"></p>
</form>
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
</div>