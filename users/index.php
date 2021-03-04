<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользователи");
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-xs-12 content-margin">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/newitems.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>		
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/developments.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/licenses.php', array(), array());?>	
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/pricelists.php', array(), array());?>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
		<h1>
			Список пользователей
		</h1>
<?
$filter = Array
(
    "GROUPS_ID" => Array(5,6,7)
);
$rsUsers = CUser::GetList(($by="NAME"), ($order="ASC"), $filter); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
$rsUsers->NavStart(500); // разбиваем постранично по 50 записей
// echo $rsUsers->NavPrint(GetMessage("PAGES"), false, 'text', '/local/templates/.default/components/bitrix/system.pagenavigation/custom/template.php'); // печатаем постраничную навигацию
echo $rsUsers->GetPageNavStringEx($navComponentObject, 'Заголовок', 'custom', 'Y');
while ($rsUsers->NavNext(true, "f_")) {
	// pre($rsUsers);
	
	if ($f_PERSONAL_PHOTO)
	{
		$file = CFile::ResizeImageGet($f_PERSONAL_PHOTO, array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);
		$avatar = '<img src="' . $file['src'] . '" />';
	}
	else
	{
		$avatar = '<img src="' . EMPTY_LOGO_AVATAR_PATH . '" />';
	}
?>
	<div class="block-default in block-shadow content-margin corpnewsblock" id='userBlock<? echo $f_ID; ?>'>
		<div class="newsbitem clearfix">
			<div class="newsbimg floatleft">
				<? echo $avatar; ?>
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $f_NAME . ' ' . $f_LAST_NAME; ?></div>
				<div class="infotvc">
					<span class="infotime">Зарегистрирован: <? echo $f_DATE_REGISTER; ?></span>
					<span class="infoview">Последний визит: <? echo $f_LAST_LOGIN; ?></span>
				</div>
			</div>
		</div>
	</div>
	<?
	
    //echo "[".$f_ID."] (".$f_LOGIN.") ".$f_NAME." ".$f_LAST_NAME."<br>";	
}



/*
	$APPLICATION->IncludeComponent(
	"bitrix:forum.user.list", 
	"usersList", 
	array(
		"COMPONENT_TEMPLATE" => "usersList",
		"SHOW_USER_STATUS" => "Y",
		"URL_TEMPLATES_MESSAGE_SEND" => "message_send.php?TYPE=#TYPE#&UID=#UID#",
		"URL_TEMPLATES_PM_EDIT" => "pm_edit.php?FID=#FID#&MID=#MID#&UID=#UID#&mode=#mode#",
		"URL_TEMPLATES_PROFILE_VIEW" => "profile_view.php?UID=#UID#",
		"URL_TEMPLATES_USER_POST" => "user_post.php?UID=#UID#&mode=#mode#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0",
		"USERS_PER_PAGE" => "2",
		"SET_NAVIGATION" => "Y",
		"DATE_FORMAT" => "d.m.Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"PAGE_NAVIGATION_TEMPLATE" => "custom",
		"SET_TITLE" => "N",
		"SEO_USER" => "N"
	),
	false
);
*/


/*
$APPLICATION->IncludeComponent(
	"bitrix:blog.user", 
	"userinfo", 
	array(
		"COMPONENT_TEMPLATE" => "userinfo",
		"ID" => $_REQUEST['USER_ID'],
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"PATH_TO_BLOG" => "",
		"PATH_TO_USER" => "",
		"PATH_TO_USER_EDIT" => "",
		"PATH_TO_SEARCH" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_ID_COMPANY",
			1 => "UF_NICKNAME",
			2 => "UF_NAME_OR_LOGIN",
		),
		"BLOG_VAR" => "",
		"PAGE_VAR" => "",
		"USER_VAR" => ""
	),
	false
);
*/
?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>