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


$showCounter = $arResult['SHOW_COUNTER']? $arResult['SHOW_COUNTER']: 0;
$msgCounter = (!empty($arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']))? $arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;
$dateCreate = FormatDate("d F Y", MakeTimeStamp($arResult["DATE_CREATE"]));


// pre($arResult);
$displayProp = false;
if (!empty($arResult['PROPERTIES']['paidOption']['VALUE']))
{
	if (!empty($arResult['PROPERTIES']['companyId']['VALUE']))
	{
		$res = CIBlockElement::GetProperty(IBLOCK_ID_COMPANY, $arResult['PROPERTIES']['companyId']['VALUE'], "sort", "asc", array("CODE" => "beginDatePL"));
		if ($ob = $res->GetNext())
			$beginDate = $ob['VALUE'];

		$res = CIBlockElement::GetProperty(IBLOCK_ID_COMPANY, $arResult['PROPERTIES']['companyId']['VALUE'], "sort", "asc", array("CODE" => "endDatePL"));
		if ($ob = $res->GetNext())
			$endDate = $ob['VALUE'];

		if (strtotime($beginDate) <= time() && strtotime($endDate) >= time())
			$displayProp = true;
	}	
}
?>

<div class="block-default in block-shadow content-margin detailblock">
	<div class="detailinfo clearfix">
		<div class="detailinfofirm floatleft">
			Лицензия
			<? if ($displayProp)
				echo $arResult['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE'];
			?>
		</div>
<?
		if (isset($arResult['PROPERTIES']['country']['VALUE']) && !empty($arResult['PROPERTIES']['country']['VALUE']))
		{
?>
			<div class="detailinfolink floatleft">
				<span>Страна <? echo GetCountryByID($arResult['PROPERTIES']['country']['VALUE']);; ?></span>
			</div>
<?		}
?>
	</div>
	<h1><? echo $arResult["~NAME"]; ?></h1>
	<div class="infotvc">
		<span class="infotime"><? echo $dateCreate; ?></span>
		<span class="infoview"><i class="icon-icons_main-05"></i><? echo $showCounter; ?></span>
		<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
	</div>
	<? 
		if ($arResult["DETAIL_PICTURE"]["SRC"] && $displayProp)
			$file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>890, 'height'=>340), BX_RESIZE_IMAGE_EXACT, true);
		else
			$file['src'] = '';

		if ('' != $file['src']) { ?>
			<div class="mainphoto" style="background-image: url('<? echo $file["src"]; ?>');">
<?
			if (isset($arResult['PROPERTIES']['imgString']['VALUE']) && !empty($arResult['PROPERTIES']['imgString']['VALUE'])) { ?>
				<div class="mainphototitle">
					<? echo $arResult['PROPERTIES']['imgString']['VALUE']; ?>
				</div>
<?			} ?>
			</div>
<?		}


	if (!empty($arResult["PREVIEW_TEXT"])) { ?>
		<div class="descrcontent">
			<? echo $arResult["PREVIEW_TEXT"]; ?>
		</div>
<?	}
?>

<?
	if (isset($arResult["DETAIL_TEXT"]) && !empty($arResult["DETAIL_TEXT"]) && $displayProp) { ?>
		<div class="detailcontent newscontent">
			<? echo $arResult["DETAIL_TEXT"]; ?>
		</div>	
<?	}

	if (isset($arResult['PROPERTIES']['newsSource']['VALUE']) && !empty($arResult['PROPERTIES']['newsSource']['VALUE']))
	{
?>
		<div class="sourceblock">
			<div class="title">Источник</div>
			<div class="link">
				<a href="<? echo $arResult['PROPERTIES']['newsSource']['VALUE']; ?>">
					<? echo $arResult['PROPERTIES']['newsSource']['VALUE']; ?>
				</a>
			</div>
		</div>
<?	}
?>

		<!-- Теги -->
<?
	if (isset($arResult['TAGS']) && !empty($arResult['TAGS']))
	{
?>
	<div class="tagblock">
		<span>Тэги:</span>
	<?
		$tags = explode(',', $arResult['TAGS']);
		foreach ($tags as $tag) { ?>
			<?
			/*
			<a href="<?=$arResult['IBLOCK']['SECTION_PAGE_URL']?>?companyfilter_ff%5BTAGS%5D=<? echo $tag; ?>&set_filter=Фильтр&set_filter=Y"><? echo $tag; ?></a>
			*/
			?>
			<a href="/search/tagSearch.php?tags=<? echo trim($tag); ?>">#<? echo trim($tag); ?></a> 
	<?	}
	?>
	</div>
<?	}
?>
</div>







<?
/*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>