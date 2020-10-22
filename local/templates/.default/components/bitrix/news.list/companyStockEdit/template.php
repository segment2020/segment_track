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

// pre($arResult);
//pre($arParams);
?>


<div class="col-xs-9 content-margin">
<h1><? echo $arResult['NAME']; ?></h1>

<? if ('OK' == $_GET['msg']) { ?>
	<div class="block-default in block-shadow content-margin corpnewsblock">
		Благодарим вас за размещение материала. Он будет доступен после модерации.
	</div>
<?}?>

<div class='row'>
	<div class="col-xs-12 content-margin">
		<a href="/personal/company<? echo $arResult['SECTION_PAGE_URL']; ?>edit/?iBlockId=<? echo $arResult['ID']; ?>&iBlockType=<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
			<div class='col-xs-12 btn btn-blue-full minbr'>
				<span class="plus">+</span>
				<?=GetMessage("ADD_ELEMENT")?>
			</div>
		</a>
	</div>
</div>

<div class="paginationblock clearfix">
<?
	if($arParams["DISPLAY_TOP_PAGER"])
	{
?>
		<nav aria-label="Page navigation" class="floatleft">
			<? echo $arResult["NAV_STRING"] . '<br />'; ?>
		</nav>
<?	
		$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());
	}
?>
</div>


<?
//pre($arResult);
if (count($arResult["ITEMS"]) > 0){
	foreach ($arResult["ITEMS"] as $arElement){
	// pre($arElement);

	// $money = false;
	// if (!empty($arElement['PROPERTIES']['paidOption']['VALUE']) && !$money)
	// {
		// TODO: добавить проверку на наличие бабла у пользователя.
		// continue;
	// }


	$showCounter = (isset($arElement['SHOW_COUNTER']) && !empty($arElement['SHOW_COUNTER']))? $arElement["SHOW_COUNTER"]: 0;
	$msgCounter = !empty($arElement['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arElement['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

	if (!empty($arElement['PREVIEW_PICTURE']))
	{
		$file = CFile::ResizeImageGet($arElement['PREVIEW_PICTURE'], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}
	elseif (!empty($arElement['PROPERTIES']['companyId']['VALUE']))
	{
		$arSelect = array('PREVIEW_PICTURE');
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arElement['PROPERTIES']['companyId']['VALUE']);
		$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
		if ($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}
	}
	else
	{
		$file['src'] = '/tpl/images/pdfIcon90x90.png';
	}
	
	$status = is_array($arResult["WF_STATUS"]) ? $arResult["WF_STATUS"][$arElement["WF_STATUS_ID"]] : $arResult["ACTIVE_STATUS"][$arElement["ACTIVE"]];

	$dateCreate = FormatDate("d F Y", MakeTimeStamp($arElement["DATE_CREATE"]));

	$arSelect = array();
	$arFilter = array("IBLOCK_ID"=>$arElement['IBLOCK_ID'], 'ID' => $arElement["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>250), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();


// pre($arElement);
	$rejMessage = '';
	if ('Y' == $arElement['PROPERTIES']['rejected']['VALUE']) {
		$status = 'Отклонена';
		$statusblock = 'status_r';
		$rejMessage = $arElement['PROPERTIES']['reasonRejection']['VALUE']['TEXT'];
		$statusdescr = 'Материал отклонен модератором';
	}
	else
	{
		$rejMessage = '';
		if ('N' == $arFields['ACTIVE']) {
			$statusblock = 'status_m';
			$status = 'На модерации';
			$statusdescr = 'Материал на проверке у модератора';
		} elseif ('Y' == $arFields['ACTIVE']) {
			$statusblock = 'status_a';
			$status = 'Активна';
			$statusdescr = 'Материал успешно размещен на портале';
		}
	}
?>
<div class="block-default in block-shadow content-margin corpnewsblock">
		<div class="newsbitem clearfix">
			<div class="secstatusblock <?=$statusblock?>">
				<div class="secstatusblock_title"><? echo $status; ?></div>
				<div class="secstatusblock_descr"><? echo $statusdescr; ?></div>
			</div>
			<? if ($rejMessage) { ?>
			<div class="secrejblock clearfix">
				<? echo $rejMessage; ?>
			</div>
			<? } ?>

			<div class="newsbimg floatleft">
				<img src="<? echo $file["src"]; ?>" />
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $arElement["NAME"]; ?></div>
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
			if ($statusblock == 'status_a') {
				$res = CIBlockElement::GetByID($arElement["ID"]);
				if ($ar_res = $res->GetNext()) {
					if ($arParams['IBLOCK_ID'] == 14) {
						if (strtotime($arElement['PROPERTIES']['dateEnd']['VALUE']) >= strtotime(date('Y-m-d')))
							$path = $arResult['SECTION_PAGE_URL'] . 'futureevents/' . $arElement['CODE'] . '/';
						else
							$path = $arResult['SECTION_PAGE_URL'] . 'pastevents/' . $arElement['CODE'] . '/';						
					?>	
						<a href="<? echo $path; ?>" class="btn btn-blue-full minbr">Просмотреть</a>
					
					 <? } else { ?>
						<a href="<? echo $ar_res["DETAIL_PAGE_URL"]; ?>" class="btn btn-blue-full minbr">Просмотреть</a>					
					<? }
				}
			}
?>
			<a href="<? echo $arElement["DETAIL_PAGE_URL"]; ?>" class="btn btn-blue-full minbr">
				<? echo GetMessage("EDIT_ELEMENT"); ?>
			</a>
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
	echo $arResult["NAV_STRING"];
?>
	</nav>
	<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
</div>

	<div class='row'>
		<div class="col-xs-12 content-margin">
			<a href="/personal/company<? echo $arResult['SECTION_PAGE_URL']; ?>edit/?iBlockId=<? echo $arResult['ID']; ?>&iBlockType=<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
				<div class='col-xs-12 btn btn-blue-full minbr'>
					<span class="plus">+</span>
					<?=GetMessage("ADD_ELEMENT")?>
				</div>
			</a>
		</div>
	</div>
</div>



<?
/*
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
