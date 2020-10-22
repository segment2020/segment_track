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

$nav = $arResult['NAV_RESULT'];

$monthsName = array('01' => 'января',
    '02' => 'февраля',
    '03' => 'марта',
    '04' => 'апреля',
    '05' => 'мая',
    '06' => 'июня',
    '07' => 'июля',
    '08' => 'августа',
    '09' => 'сентября',
    '10' => 'октября',
    '11' => 'ноября',
    '12' => 'декабря');

if($arParams["DISPLAY_TOP_PAGER"])
	echo $arResult["NAV_STRING"] . '<br />';


$counter = 0;
foreach($arResult["ITEMS"] as $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if (!empty($arItem['PROPERTIES']['timeBegin']['VALUE']))
		$timeBegin = substr($arItem['PROPERTIES']['timeBegin']['VALUE'], 11, -3);
	else
		$timeBegin = '';

	if (!empty($arItem['PROPERTIES']['dateBegin']['VALUE']))
	{
		$yearBegin = ConvertDateTime($arItem['PROPERTIES']['dateBegin']['VALUE'], "YYYY", "ru");
		$dayBegin = ConvertDateTime($arItem['PROPERTIES']['dateBegin']['VALUE'], "DD", "ru");
		$monthBeginNum = ConvertDateTime($arItem['PROPERTIES']['dateBegin']['VALUE'], "MM", "ru");
	}

	if (!empty($arItem['PROPERTIES']['dateEnd']['VALUE']))
	{
		$yearEnd = ConvertDateTime($arItem['PROPERTIES']['dateEnd']['VALUE'], "YYYY", "ru");
		$dayEnd = ConvertDateTime($arItem['PROPERTIES']['dateEnd']['VALUE'], "DD", "ru");
		$monthEndNum = ConvertDateTime($arItem['PROPERTIES']['dateEnd']['VALUE'], "MM", "ru");
	}

	if ($arItem["PREVIEW_PICTURE"]["SRC"])
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>160, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$file['src'] = '';
?>
	<div class="eventitem clearfix">
		<a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>">
			<div class="dateblock floatleft text-center">
				<div class="date text-center">
					<div class="day"><? echo $dayBegin; ?></div>
					<div class="month"><? echo $monthsName[$monthBeginNum]; ?></div>
					<div class="year"><? echo $yearBegin; ?></div>
				</div>
			</div>
			<div class="descrblock clearfix">
				<div class="imgblock floatleft">
					<img src="<? echo $file['src']; ?>">
				</div>
				<div class="textblock">
					<div class="descrtitle"><? echo $arItem["NAME"]; ?></div>
					<div class="descrdate">
						<span class="dname">Начало:</span><span class="ddate datefirst"><? echo $dayBegin . ' ' . $monthsName[$monthBeginNum] . ' ' . $yearBegin; ?></span>
<?						if (!empty($arItem['PROPERTIES']['dateEnd']['VALUE']))
						{?>
							<span class="dname">Окончание:</span><span class="ddate"><? echo $dayEnd . ' ' . $monthsName[$monthEndNum] . ' ' . $yearEnd; ?></span>
<?						}?>
					</div>
					<div class="descrline clearfix">
						<?
							if (!empty($arItem['PROPERTIES']['place']['VALUE']))
							{
						?>
								<div class="lname floatleft">Место проведения:</div><div class="ldescr"><? echo $arItem['PROPERTIES']['place']['VALUE']; ?></div>
						<?	}

							if (!empty($timeBegin))
							{
						?>
								<div class="lname floatleft">Время начала:</div><div class="ldescr"><? echo $timeBegin; ?></div>
						<?	}
						?>
					</div>
				</div>
			</div>
		</a>
	</div>
<?
}?>
<input type='hidden' class='navPageCount' value='<? echo $nav->NavPageCount; ?>'>




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
