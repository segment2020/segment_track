<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{
    $currentUserId = $USER->GetID();
    $rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
    $arUser = $rsUser->Fetch();
    //$arResult["PERSONAL_PHOTO_HTML"] = CFile::ShowImage($arUser["PERSONAL_PHOTO"], 80, 80, "border=0", "", true); //$arUser["PERSONAL_PHOTO"] - тут находится id аватарки, здесь мы получим HTML-код для вывода нужного изображения 
	if (!empty($arUser['PERSONAL_PHOTO']))
		$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);
	else
		$leftSideAvatarFile['src'] = EMPTY_LOGO_AVATAR_PATH;


// pre($arResult);
//pre($arUser);

	if (!empty($arUser['UF_ID_COMPANY']) && CModule::IncludeModule("iblock"))
	{
		$arSelect = array('ID', "NAME");
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
		if ($ob = $res->GetNextElement())
			$arFields = $ob->GetFields();
	}
}
?>
<div class="col-sm-3 col-xs-12 order-xs-1 content-margin" id="article">
    <div id="getFixed" class="lkmenuslide">
        <div class=" content-margin">
            <div class="block-default block-shadow lk_userinfo clearfix">
                <div class="lk_userinfoimg floatleft">
                    <img src="<? echo $leftSideAvatarFile["src"]; ?>">
                </div>
                <div class="lk_userinfotext">
                    <div class="lk_userinfoname">
                        <? echo (CUser::GetFirstName())?CUser::GetFirstName():CUser::GetLogin(); ?>
                    </div>
                    <div class="lk_userinfofirm">
                        <div><? echo $arUser["WORK_POSITION"]; ?></div>
                        <div id='personalPageCompanyName'><? echo !empty($arFields['NAME'])? $arFields['NAME']: 'Нет компании'; ?></div>
                    </div>
                    <div class="lk_userinfobtn">
                        <a href="/personal/" class="btn btn-blue-full btnmin minbr lk_userinfobtnf">Редактировать</a>
                        <a href="/?logout=yes" class="btn btn-blue-full btnmin minbr">Выход</a>
                    </div>
                </div>
            </div>
        </div>  
        <div class="content-margin">
            <div class="list-group block-shadow lk_lmenu clearfix" id="collapselkmenu">
                <?$APPLICATION->IncludeFile('/tpl/include_area/newPersonalPageMenu.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'companyName' => $arFields['NAME']), array());?>
            </div>
        </div>
    </div>
</div>