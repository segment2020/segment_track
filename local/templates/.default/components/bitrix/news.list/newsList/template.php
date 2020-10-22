<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);

//pre($arResult);
?>

<div class="col-xs-6 cell-12-xs content-margin">
	<div class="block-default compnewsblock block-shadow">
		<div class="block-title clearfix">
			<a class="notitlestyle" href="<? echo $arResult['SECTION_PAGE_URL']; ?>"><? echo $arResult['NAME']; ?></a><a class="floatright" href="<? echo $arResult['SECTION_PAGE_URL']; ?>">Все новости<i class="icon-icons_main-10"></i></a>
		</div>
<?
foreach ($arResult["ITEMS"] as $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));


	$arSelect = Array("SHOW_COUNTER");
	$arFilter = Array("IBLOCK_ID"=>IntVal($arItem['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();

	$msgCounter = !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

	$file['src'] = EMPTY_IMAGE_PATH;
	$arFields = array(); 
		if (!empty($arItem['PREVIEW_PICTURE']["ID"]))
			$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		elseif (!empty($arItem['PROPERTIES']['companyId']['VALUE']))
		{
			$arSelect = array('PREVIEW_PICTURE');
			$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arItem['PROPERTIES']['companyId']['VALUE']);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
			if ($ob = $res->GetNextElement())
				$arFields = $ob->GetFields();

			if (!empty($arFields['PREVIEW_PICTURE']))
				$file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		} 

	$class = '';
	if (!empty($arItem['PROPERTIES']['inTheTop']['VALUE']))
		$class = 'marked';
?>
				<div class="newsbitem clearfix">
<?
				if ('441743' == $arItem["ID"])
				{
?>
					<a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>" class='viewCalc' id='<? echo $arItem['ID']; ?>' onclick="yaCounter2131294.reachGoal('newsClick');">
<?
				}
				else
				{
?>
					<a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>" class='viewCalc' id='<? echo $arItem['ID']; ?>'>
<?				}
?>
						<div class="newsbimg floatleft text-center"><img src="<? echo $file["src"]; ?>" width='60px' /></div>
						<div class="newsbtext <? echo $class; ?>">
							<div class="newsbtitle"><?echo $arItem["NAME"]?></div>
							<div class="infotvc in">
								<span class="infotime"><? echo $arItem["DATE_CREATE"]; ?></span>
								<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($arItem['ID']); ?></span>
								<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
							</div>
						</div>
					</a>
				</div>
<?
}
?>
				<div class="text-center buttonblock">
<? if (isset($arResult["SECTION_PAGE_URL"]) && !empty($arResult["SECTION_PAGE_URL"])) {
?>
					<a class="btn btn-blue" href="<? echo $arResult["SECTION_PAGE_URL"]; ?>">Все новости<i class="icon-icons_main-10"></i></a>
<?}?>
				</div>
			</div> <!-- end div class="block-default compnewsblock block-shadow"> -->
		</div> <!-- end div class="col-xs-6 content-margin"> -->









<?/*








<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
