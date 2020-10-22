<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить новинку");
?>
<div class="container-fluid">
	<div class="row">

<?
if ($USER->IsAuthorized()) //Если пользователь авторизован 
{ 
	$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
	$arUser = $rsUser->Fetch(); 
	$arResult["PERSONAL_PHOTO_HTML"] = CFile::ShowImage($arUser["PERSONAL_PHOTO"], 80, 80, "border=0", "", true); //$arUser["PERSONAL_PHOTO"] - тут находится id аватарки, здесь мы получим HTML-код для вывода нужного изображения 
}

 // pre($arResult);
//pre($arUser);

$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);

if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("IBLOCK_ID", 'ID', "NAME");
	$arFilter = array("IBLOCK_ID" => 1, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();
}
?>
<div class="col-xs-3 content-margin" id="article">
		<div id="getFixed" class="lkmenuslide">
			<div class=" content-margin">
				<div class="block-default block-shadow lk_userinfo clearfix">
					<div class="lk_userinfoimg floatleft">
						<img src="<? echo $leftSideAvatarFile["src"]; ?>">
					</div>
					<div class="lk_userinfotext">
						<div class="lk_userinfoname">
							<? echo (CUser::GetFirstName())? CUser::GetFirstName(): CUser::GetLogin(); ?>
						</div>
						<div class="lk_userinfofirm">
							<div><? echo $arUser["WORK_POSITION"]; ?></div>
							<div><? echo $arFields['NAME']; ?></div>
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
					<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageMenu.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'companyName' => $arFields['NAME']), array());?>
				</div>
			</div>
		</div>
</div>

<?
global $arrFilter;
$arrFilter = array("ACTIVE" => array("Y", "N"), 'PROPERTY_companyId' => $arUser['UF_ID_COMPANY'], '!PROPERTY_archive_VALUE' => 1);

// Новинки компании.
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"companyNewsListEdit", 
	array(
		"COMPONENT_TEMPLATE" => "companyNewsListEdit",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => IBLOCK_ID_NOVETLY,
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "newsSource",
			2 => "imgSource",
			3 => "FORUM_MESSAGE_CNT",
			4 => "imgString",
			5 => "",
			6 => "",
		),
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "/personal/company/new/edit/?elementId=#ELEMENT_ID#&iBlockId=#IBLOCK_ID#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => "custom",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DETAIL_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"LIST_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);
?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>