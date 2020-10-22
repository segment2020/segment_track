<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список сотрудников");
?>
<div class="container-fluid">
	<div class="row">

<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<div class="col-xs-9 content-margin">
	<? if (!empty($_GET['message'])) { ?>
		<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['message']; ?>
			</div>
		</div>
	</div>
	<?}?>

	<h1>Список сотрудников</h1>

	<div class='row'>
		<div class="col-xs-12 content-margin">
			<a href="/personal/company/staff/add/">
				<div class='col-xs-12 btn btn-blue-full minbr'>
					<span class="plus">+</span>
					<?=GetMessage("ADD_ELEMENT")?>
				</div>
			</a>
		</div>
	</div>

<?
$currentUserId = $USER->GetID();
$rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch();

// Проверим, является ли сотрудник админок компании.
$res = \Bitrix\Main\UserGroupTable::getList(array('filter' => array('USER_ID' => $currentUserId, 'GROUP_ID' => array(ID_GROUP_COMPANY_ADMIN))));
if ($row = $res->fetch())
	$admin = true;

$statusArray = array(ID_GROUP_COMPANY_ADMIN => 'администратор', ID_GROUP_COMPANY_STAFF => 'сотрудник', ID_GROUP_USER => 'пользователь');
$statusCount = count($statusArray);

// Выберем пользователей у которых в свойствах ID компании текущего пользователя.
$filter = array("ACTIVE" => "Y", "UF_ID_COMPANY" => $arUser['UF_ID_COMPANY']);
$select = array('GROUP_ID');
$by = 'id';
$order = 'asc';
$rsUsers = CUser::GetList($by, $order, $filter, $select);
while ($user = $rsUsers->GetNext())
{
	$res = CUser::GetUserGroupList($user['ID']);
	while ($arGroup = $res->Fetch())
	{
		if (ID_GROUP_COMPANY_ADMIN === (int)$arGroup['GROUP_ID'])
		{
			$statusId = ID_GROUP_COMPANY_ADMIN;
			break;
		}
		elseif (ID_GROUP_COMPANY_STAFF === (int)$arGroup['GROUP_ID'])
		{
			$statusId = ID_GROUP_COMPANY_STAFF;
			break;
		}
		elseif (ID_GROUP_USER === (int)$arGroup['GROUP_ID'])
		{
			$statusId = ID_GROUP_USER;
			break;
		}
	}

	//pre($user);
	if (!empty($user['PERSONAL_PHOTO']))
		$avatarFile = CFile::ResizeImageGet($user['PERSONAL_PHOTO'], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_EXACT, true);
	else
		$avatarFile['src'] = EMPTY_LOGO_AVATAR_PATH;
?>
	<div class="block-default in block-shadow content-margin corpnewsblock" id='userBlock<? echo $user['ID']; ?>'>
		<div class="newsbitem clearfix">
			<div>
				<h3>
<?
				$newStaff = false;
				if (ID_GROUP_USER == $statusId) {
					$newStaff = true;
					echo 'Новый';
				}
?>
				</h3>
			</div>

			<div class="newsbimg floatleft">
				<img src="<? echo $avatarFile["src"]; ?>" />
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $user['NAME'] . ' ' . $user['LAST_NAME']; ?></div>
				<div class="newsbdescr">
					<? echo 'Логин: ' . $user['LOGIN']; ?>
				</div>
				<div class="infotvc">
					<span class="infotime">Зарегистрирован: <? echo $user['DATE_REGISTER']; ?></span>
					<span class="infoview">Последний визит: <? echo $user['LAST_LOGIN']; ?></span>
					<?
						if ($currentUserId != $user['ID'] && $admin)
						{?>
							<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="s<? echo $user['ID']; ?>" name="groupId" tabindex="-98">
								<?
									foreach ($statusArray as $sId => $status)
									{
										if (!$newStaff && ID_GROUP_USER == $sId)
											continue;

										$selected = '';

										if ($statusId == $sId)
											$selected = 'selected';

										echo '<option value="' . $sId .'" ' . $selected . '>' . $status . '</option>';
									}
								?>
							</select>
					<?	}
						else
						{
?>
							<span class="infocomment">Статус: <? echo $statusArray[$statusId]; ?></span>
<?
						}?>
				</div>
			</div>
		</div>
		<div class="seporator"></div>
		<div class='textAlignRight'>
			<? 	if ($currentUserId != $user['ID'] && $admin)
				{?>
					<div class="btn hideElement" id='statusOk<? echo $user['ID']; ?>'>
						Статус изменён
					</div>
					<div class="btn btn-blue-full minbr apply" id="<? echo $user['ID']; ?>">
						Сменить статус
					</div>
					<div class="btn btn-blue-full minbr fire" id='<? echo $user['ID']; ?>'>
						Уволить
					</div>
			<?	}

				if ($currentUserId != $user['ID'])
				{
?>
					<a href='/personal/messages/new/?PAGE_NAME=pm_edit&FID=1&MID=0&mode=new&by=post_date&order=desc&recipientName=<? echo $user['LOGIN']; ?>' class="btn btn-blue-full minbr" id='<? echo $user['ID']; ?>'>
						Написать
					</a>
<?
				}
			?>
		</div>
</div> <!-- end div class="block-default in block-shadow content-margin corpnewsblock"> -->
<?
} // end while ($user = $rsUsers->GetNext())
?>
</div>
			<script>
				
			</script>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>