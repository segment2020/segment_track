<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);


$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);
?>

<div class="col-sm-3 col-xs-12 content-margin" id="aside1">
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
							<div>Генеральный директор</div>
							<div>«Фабер-Кастелл»</div>
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
					<a href="/personal/" class="list-group-item"><img src="/tpl/images/lkmenu1.png">Профиль пользователя</a>
					<a href="#lkmenu1" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu2.png">Профиль компании<i class="floatright icon-icons_main-13"></i></a>
						<div class="submenu collapse" id="lkmenu1">
							<a href="/personal/company/?edit=Y&CODE=<? echo $arResult['ELEMENT']['ID']; ?>" class="list-group-item">Карточка компании</a>
							<a href="/personal/company/addNews" class="list-group-item">Баннеры</a>
							<a href="/personal/company/addNews" class="list-group-item">Новости</a>
							<a href="/personal/" class="list-group-item">Новинки</a>
							<a href="/personal/" class="list-group-item">Акции</a>
							<a href="/personal/" class="list-group-item">Товары/хиты (каталог товаров)</a>
							<a href="/personal/" class="list-group-item">Бренды/лицензии</a>
							<a href="/personal/" class="list-group-item">Прайс-лист</a>
							<a href="/personal/" class="list-group-item">Каталог продукции pdf</a>
							<a href="/personal/" class="list-group-item">Фотогалерея</a>
							<a href="/personal/" class="list-group-item">Видеогалерея</a>
							<a href="/personal/" class="list-group-item">Статьи</a>
							<a href="/personal/" class="list-group-item">Интервью</a>
						</div>
					<a href="#lkmenu2" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu3.png">Подписка на рассылку</a>
					<a href="#lkmenu3" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu4.png">Вопросы в техподддержку</a>
				</div>
			</div>
		</div>
</div>

<div class="col-sm-9 col-xs-12 content-margin">
<h1>Новости</h1>

<div class='row'>
	<div class='col-xs-12 btn btn-blue-full minbr'>
		<span class="plus">+</span>
		<?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?>
			<a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a>
		<?else:?>
			<?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?>
		<?endif?>
	</div>
</div>

<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft">
<?
	if($arParams["DISPLAY_TOP_PAGER"])
		echo $arResult["NAV_STRING"] . '<br />';
?>
	</nav>
	<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
</div>


<?
//pre($arResult);
if (count($arResult["ELEMENTS"]) > 0){
	foreach ($arResult["ELEMENTS"] as $arElement){
	//pre($arElement);

	$showCounter = (isset($arElement['SHOW_COUNTER']) && !empty($arElement['SHOW_COUNTER']))? $arElement["SHOW_COUNTER"]: 0;

	if (!empty($arElement['PREVIEW_PICTURE']))
		$file = CFile::ResizeImageGet($arElement['PREVIEW_PICTURE'], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$file['src'] = '';
	
	$status = is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]];

	$dateCreate = FormatDate("d F Y", MakeTimeStamp($arElement["DATE_CREATE"]));

	//$arSelect = array("FORUM_MESSAGE_CNT");
	$arSelect = array();
	$arFilter = array("IBLOCK_ID"=>$arElement['IBLOCK_ID'], 'ID' => $arElement["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>250), $arSelect);
	while ($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		//pre($arFields);
		$arProps = $ob->GetProperties();
		//pre($arProps);
	}
?>
<div class="block-default in block-shadow content-margin corpnewsblock">
		<div class="newsbitem clearfix">
			<div>
			<? echo $status; ?>
			</div>

			<div class="newsbimg floatleft">
				<img src="<? echo $file["src"]; ?>" />
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $arElement["NAME"];?></div>
				<div class="newsbdescr">
					<?if ($arElement["PREVIEW_TEXT"])
						echo $arElement["PREVIEW_TEXT"];
					?>
				</div>
				<div class="infotvc">
					<span class="infotime"><? echo $dateCreate; ?></span>
					<span class="infoview"><i class="icon-icons_main-05"></i><? echo $showCounter; ?></span>
					<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
				</div>
			</div>
		</div>
		<div class="seporator"></div>
		<div class='textAlignRight'>
<?
		if ($arResult["CAN_EDIT"] == "Y")
		{
?>
			<a href="<? echo $arParams["EDIT_URL"] . '?edit=Y&amp;CODE=' . $arElement["ID"]; ?>" class="btn btn-blue-full minbr">
				<? echo GetMessage("IBLOCK_ADD_LIST_EDIT"); ?>
			</a>
<?		}

		if ($arResult["CAN_DELETE"] == "Y")
		{
			if ($arElement["CAN_DELETE"] == "Y")
			{
?>
				<a class="btn btn-blue-full minbr" href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')">
					<?=GetMessage("IBLOCK_ADD_LIST_DELETE")?>
				</a>
<?			}
		}
?>
		</div>
</div> <!-- end div class="block-default in block-shadow content-margin corpnewsblock"> -->
<?
	}
}
?>

<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft">
<?
if ($arParams["DISPLAY_BOTTOM_PAGER"])
	echo '<br />' . $arResult["NAV_STRING"];
?>
	</nav>
	<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
</div>

	<div class='row'>
		<div class='col-xs-12 btn btn-blue-full minbr'>
			<span class="plus">+</span>
			<?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?>
				<a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a>
			<?else:?>
				<?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?>
			<?endif?>
		</div>
	</div>
</div>




<?
$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<table class="data-table">
<?if($arResult["NO_USER"] == "N"):?>
	<thead>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
	<?if (count($arResult["ELEMENTS"]) > 0):?>
		<?foreach ($arResult["ELEMENTS"] as $arElement):?>
		<tr>
			<td><!--a href="detail.php?CODE=<?=$arElement["ID"]?>"--><?=$arElement["NAME"]?><!--/a--></td>
			<td><small><?=is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]]?></small></td>
			<?if ($arResult["CAN_EDIT"] == "Y"):?>
			<td><?if ($arElement["CAN_EDIT"] == "Y"):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=GetMessage("IBLOCK_ADD_LIST_EDIT")?><?else:?>&nbsp;<?endif?></a></td>
			<?endif?>
			<?if ($arResult["CAN_DELETE"] == "Y"):?>
			<td><?if ($arElement["CAN_DELETE"] == "Y"):?><a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a><?else:?>&nbsp;<?endif?></td>
			<?endif?>
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?></td>
		</tr>
	<?endif?>
	</tbody>
<?endif?>
	<tfoot>
		<tr>
			<td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?></td>
		</tr>
	</tfoot>
</table>
<?if (strlen($arResult["NAV_STRING"]) > 0):?><?=$arResult["NAV_STRING"]?><?endif?>