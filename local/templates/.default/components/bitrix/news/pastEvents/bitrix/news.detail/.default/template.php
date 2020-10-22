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
?>

<?
//pre($arResult);
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

	if (!empty($arResult['PROPERTIES']['timeBegin']['VALUE']))
		$timeBegin = substr($arResult['PROPERTIES']['timeBegin']['VALUE'], 11, -3);
	else
		$timeBegin = '';

	if (!empty($arResult['PROPERTIES']['dateBegin']['VALUE']))
	{
		$yearBegin = ConvertDateTime($arResult['PROPERTIES']['dateBegin']['VALUE'], "YYYY", "ru");
		$dayBegin = ConvertDateTime($arResult['PROPERTIES']['dateBegin']['VALUE'], "DD", "ru");
		$monthBeginNum = ConvertDateTime($arResult['PROPERTIES']['dateBegin']['VALUE'], "MM", "ru");
	}

	if (!empty($arResult['PROPERTIES']['dateEnd']['VALUE']))
	{
		$yearEnd = ConvertDateTime($arResult['PROPERTIES']['dateEnd']['VALUE'], "YYYY", "ru");
		$dayEnd = ConvertDateTime($arResult['PROPERTIES']['dateEnd']['VALUE'], "DD", "ru");
		$monthEndNum = ConvertDateTime($arResult['PROPERTIES']['dateEnd']['VALUE'], "MM", "ru");
	}
	
	if ($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"]))
		$file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width' => 890, 'height' => 340), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$file['src'] = '';

	$msgCounter = isset($arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;
?>

<div class="block-shadow content-margin eventssecblock upcomingevents">

<div class="block-default in block-shadow content-margin detailblock">
	<div class="detailinfo clearfix">
		<div class="detailinfofirm floatleft">
			Мнение компании <a href="#">Рельеф - Центр</a>
		</div>
		<div class="detailinfolink floatleft">
			<a href="#"><i class="icon-icons_main-10"></i><span>Все мнения компании</span></a>
		</div>
	</div>
	<div class="opiniontitleblock clearfix eventdate upcomingevents">
		<div class="opiniontitleimg floatleft">
			<div class="date text-center">
				<div class="day"><? echo $dayBegin; ?></div>
					<div class="month"><? echo $monthsName[$monthBeginNum]; ?></div>
					<div class="year"><? echo $yearBegin; ?></div>
			</div>
		</div>
		<div class="opiniontitledescr">
			<div class="infotvc">
				<span class="infotime"><? echo $arResult["DATE_CREATE"]; ?></span>
				<span class="infoview"><i class="icon-icons_main-05"></i><? echo $arResult['SHOW_COUNTER']; ?></span>
				<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
			</div>						
			<h1><? echo $arResult["NAME"]; ?></h1>
		</div>
	</div>
	<div class="mainphoto" style="background-image: url('<? echo $file['src']; ?>');">
		<? if (!empty($arResult['PROPERTIES']['text']['VALUE'])){?>
			<div class="mainphototitle">
				<? echo $arResult['PROPERTIES']['text']['VALUE']; ?>
			</div>
		<?}?>
	</div>					
	<div class="aboutevent">
		<div class="title">О событии</div>
		<div class="descrdate">
			<span class="dname">Начало:</span><span class="ddate datefirst"><? echo $dayBegin . ' ' . $monthsName[$monthBeginNum] . ' ' . $yearBegin; ?></span>
<?			if (!empty($arResult['PROPERTIES']['dateEnd']['VALUE']))
			{?>
				<span class="dname">Окончание:</span><span class="ddate"><? echo $dayEnd . ' ' . $monthsName[$monthEndNum] . ' ' . $yearEnd; ?></span>
<?			}?>
		</div>
		<div class="descrline">
<?			if (!empty($arResult['PROPERTIES']['place']['VALUE']))
			{?>
				<span class="lname">Место проведения:</span><span class="ldescr"><? echo $arResult['PROPERTIES']['place']['VALUE']; ?></span><br />
<?			}

			if (!empty($timeBegin) && isset($timeBegin))
			{?>
				<span class="lname">Время начала:</span><span class="ldescr"><? echo $timeBegin; ?></span><br />
<?			}

			if (!empty($arResult['PROPERTIES']['phone']['VALUE']))
			{?>
				<span class="lname">Телефон:</span><span class="ldescr"><? echo $arResult['PROPERTIES']['phone']['VALUE']; ?></span><br />
<?			}

			if (!empty($arResult['PROPERTIES']['site']['VALUE']))
			{?>
				<span class="lname">Сайт:</span><span class="ldescr"><a target="_blank" href="<? echo $arResult['PROPERTIES']['site']['VALUE']; ?>"><? echo $arResult['PROPERTIES']['site']['VALUE']; ?></a></span>
<?			}?>
		</div>
		<a class="btn btn-blue">Зарегистрироваться</a><a class="btn btn-blue lastbtn">Схема выставки</a>
	</div>
	<div class="detailcontent newscontent">
<?
		if (strlen($arResult["DETAIL_TEXT"])>0)
			echo $arResult["DETAIL_TEXT"];
?>
	</div>
	<div class="sourceblock">
<? 		if (!empty($arResult['PROPERTIES']['source']['VALUE']))
		{
?>
			<div class="title">Источник</div>
			<div class="link"><a href="<? echo $arResult['PROPERTIES']['source']['VALUE']; ?>"><? echo $arResult['PROPERTIES']['source']['VALUE']; ?></a></div>
<?		}
?>
	</div>


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