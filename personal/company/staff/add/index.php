<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить нового сотрудника");
?>

<div class="container-fluid">
	<div class="row">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>Список пользователей</h1>
			<div class="block-default in block-shadow content-margin">
				<div class="row">
				<form action='/formsActions/' method='POST'>
<?

$filter = array("UF_ID_COMPANY" => '');
$rsUsers = CUser::GetList(($by="NAME"), ($order="ASC"), $filter); // выбираем пользователей
while($user = $rsUsers->GetNext()) {
	if (!empty($user['PERSONAL_PHOTO']))
		$avatarFile = CFile::ResizeImageGet($user['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);
	else
		$avatarFile['src'] = EMPTY_LOGO_AVATAR_PATH;
?>
	<div class="block-default in block-shadow content-margin corpnewsblock" id='userBlock<? echo $user['ID']; ?>'>
		<div class="newsbitem clearfix">
			<div class="newsbimg floatleft">
				<img src="<? echo $avatarFile["src"]; ?>" />
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $user['~NAME'] . ' ' . $user['~LAST_NAME']; ?></div>
				<?
				/*
				<div class="newsbdescr">
					<? echo 'Логин: ' . $user['LOGIN']; ?>
				</div>
				*/
				?>
				<div class="infotvc">
					<span class="infotime">Зарегистрирован: <? echo $user['DATE_REGISTER']; ?></span>
					<span class="infoview">Последний визит: <? echo $user['LAST_LOGIN']; ?></span>
				</div>
			</div>

			<input type='checkbox' id='<? echo $user["ID"]; ?>' name='userId[]' value='<? echo $user["ID"]; ?>'>
			<label for='<? echo $user["ID"]; ?>'>
				Отметить
			</label>
		</div>
	</div>
<?
}
?>
					<input type='hidden' name='actionNum' value='addStaffFromCompany'>
					<button type='submit' class="btn btn-blue btnplus minbr fixButtonAddStaff">
						<span class="plus text-center">+</span>Добавить
					</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>