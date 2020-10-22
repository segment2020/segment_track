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


<h1><? echo $arResult['NAME']; ?></h1>

<div class="block-default block-shadow content-margin fliteralphabetblock clearfix show_rus">
	<div class="langselect btn-group floatleft" data-toggle="buttons">
	  <label class="btn btn-light-blue minbr active">
		<input type="radio" name="options" id="option1" value="show_rus" autocomplete="off" checked>Rus</label>
	  <label class="btn btn-light-blue minbr">
		<input type="radio" name="options" id="option2" value="show_eng" autocomplete="off">Eng</label>
	</div>
	<div class="fliteralphabetshowall floatright">
		<a href="/license/list/"><i class="icon-icons_main-05"></i>Показать все</a>
	</div>
	<div class="fliteralphabet">
		<div class="btn btn-light-blue minbr prewslid"><i class="icon-icons_main-09"></i></div>
		<div class="paginationbox">
			<? $APPLICATION->IncludeFile('/tpl/include_area/firstLetterFilter.php', array(), array()); ?>
		</div>
		<div class="btn btn-light-blue minbr nextslid"><i class="icon-icons_main-08"></i></div>
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

<div class="block-default in block-shadow content-margin corpnewsblock">
<?
foreach($arResult["ITEMS"] as $arItem)
{
	//pre($arItem);

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if (isset($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']) && !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']))
		$msgCounter = $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];
	else
		$msgCounter = 0;

	$showCounter = (isset($arItem['SHOW_COUNTER']) && !empty($arItem['SHOW_COUNTER']))? $arItem["SHOW_COUNTER"]: 0;
	
	if ($arItem["PREVIEW_PICTURE"]["SRC"])
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$file['src'] = '';

	$dateCreate = FormatDate("d F Y", MakeTimeStamp($arItem["DATE_CREATE"]));

	if ('1' === $arItem['PROPERTIES']['paidOption']['VALUE'])
	{
		$arSelect = array("NAME", 'PROPERTY_paidLicensesNum', 'PROPERTY_beginDatePL', 'PROPERTY_endDatePL');
		$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arItem['PROPERTIES']['companyId']['VALUE'], "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
		if ($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			if ('' != $arFields['PROPERTY_PAIDLICENSESNUM_VALUE'])
			{
				$curStrDate = strtotime('now');
				if (strtotime($arFields['PROPERTY_BEGINDATEPL_VALUE']) <= $curStrDate && strtotime($arFields['PROPERTY_ENDDATEPL_VALUE']) >= $curStrDate)
					$companyName = strip_tags($arItem['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']);
				else
					$companyName = 'Не указана';
			}
		}
	}
	else
	{
		// $companyName = strip_tags($arItem['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE']);
		$companyName = 'Не указана';
	}
?>
		<div class="newsbitem clearfix">
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
				<div class="newsbimg floatleft">
					<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])){ ?>
						<img src="<? echo $file["src"]; ?>" />
					<?}?>
				</div>
				<div class="newsbtext">
					<div class="newsbtitle"><?echo $arItem["~NAME"]?></div>
					<div class="newsbdescr">
						<?if ($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"])
							echo $arItem["PREVIEW_TEXT"];
						?>
					</div>
					<div class="infotvc">
						<span class="infotime"><? echo $dateCreate; ?></span>
						<span class="infoview"><i class="icon-icons_main-05"></i><? echo $showCounter; ?></span>
						<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
<?
						if (isset($arItem['PROPERTIES']['country']['VALUE']) && !empty($arItem['PROPERTIES']['country']['VALUE']))
						{
?>
							<span class="infocomment">Страна <? echo $arItem['DISPLAY_PROPERTIES']['country']['VALUE']; ?></span>
<?						}
?>
					</div>
				</div>
			</a>

			<div class="newsbfirm">Лицензия компании: <? echo $companyName; ?></div>

		</div>
		<div class="seporator"></div>

<?
}
?>
</div> <!-- end div class="block-default in block-shadow content-margin corpnewsblock"> -->
	<div class="paginationblock clearfix">
		<nav aria-label="Page navigation" class="floatleft">
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
		echo $arResult["NAV_STRING"];
?>
		</nav>
		<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
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
