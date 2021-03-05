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
	if ($arResult['PROPERTIES']['companyId']['VALUE'] != $arParams['COMPANY_ID']) { ?>
		<div class="col-sm-9 col-xs-12 content-margin">
			<div class="block-default in block-shadow content-margin detailblock">
				Элемент не найден.
				<a href='/personal/company/banners/' style='color: #509bc3;'>Вернуться</a>
			</div>
		</div>
<?		exit();
	}
?>

<?
	if ($arResult["PREVIEW_PICTURE"])
		$imgPreview = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width' => 640, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true); //BX_RESIZE_IMAGE_EXACT
	else
		$imgPreview['src'] = '';

	if ($arResult["DETAIL_PICTURE"])
		$imgDetail = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width' => 640, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL, true); //BX_RESIZE_IMAGE_EXACT
	else
		$imgDetail['src'] = '';

	$showCounter = showviews($arResult['ID']);

	switch ((int)$arResult['PROPERTIES']['hostingPage']['VALUE'])
	{
		case 0:
		{
			$hostingPage = 'Главная';
			break;
		}
		case IBLOCK_ID_COMPANY:
		{
			$hostingPage = 'Компании';
			break;
		}
		case IBLOCK_ID_NEWS_COMPANY:
		{
			$hostingPage = 'Новости компаний';
			break;
		}
		case IBLOCK_ID_CATALOG:
		{
			$hostingPage = 'Каталог';
			break;
		}
		case IBLOCK_ID_STOCK:
		{
			$hostingPage = 'Акции';
			break;
		}
		case IBLOCK_ID_NEWS_INDUSTRY:
		{
			$hostingPage = 'Новости индустрии';
			break;
		}
		case IBLOCK_ID_ANALYTICS:
		{
			$hostingPage = 'Аналитика';
			break;
		}
		case IBLOCK_ID_LIFE_INDUSTRY:
		{
			$hostingPage = 'Жизнь отрасли';
			break;
		}
		case IBLOCK_ID_VIEWPOINT:
		{
			$hostingPage = 'Мнения';
			break;
		}
		case IBLOCK_ID_GALLERY_PHOTO:
		{
			$hostingPage = 'Фотогалерея';
			break;
		}
		case IBLOCK_ID_GALLERY_VIDEO:
		{
			$hostingPage = 'Видеогалерея';
			break;
		}
		case IBLOCK_ID_EVENTS:
		{
			$hostingPage = 'События';
			break;
		}
		case IBLOCK_ID_PRODUCTS_REVIEW:
		{
			$hostingPage = 'Товарные обзоры';
			break;
		}
		case IBLOCK_ID_PRICE_LISTS:
		{
			$hostingPage = 'Прайс-листы';
			break;
		}
		case IBLOCK_ID_BRANDS:
		{
			$hostingPage = 'Бренды';
			break;
		}
		case IBLOCK_ID_LICENSE:
		{
			$hostingPage = 'Лицензии';
			break;
		}
		case IBLOCK_ID_NOVETLY:
		{
			$hostingPage = 'Новинки';
			break;
		}
		default:
			$hostingPage = 'Не определено';
	}

	if ('Y' == $arResult['ACTIVE'])
	{
		$blockStatus = 'status_a';
		$active = 'Активен';
	}
	else
	{
		$blockStatus = 'status_m';
		$active = 'Не активен';
	}

	// pre($arResult);
?>

<div class="col-sm-9 col-xs-12 content-margin">
	<div class="block-default in block-shadow content-margin detailblock">
		<div class="opiniontitleblock clearfix eventdate upcomingevents">
			<div class="opiniontitledescr">
				<h1><? echo $arResult["NAME"]; ?></h1>
			</div>
		</div>
<?
		if (!empty($imgPreview['src'])) { ?>
			<div class="mainphoto" style="background-image: url('<? echo $imgPreview['src']; ?>');">
			</div>
<?		}

		if (!empty($imgDetail['src'])) { ?>
			<div class="mainphoto" style="background-image: url('<? echo $imgDetail['src']; ?>');">
			</div>
<?		} ?>
		<div class="aboutevent">
			<br>
			<div class="secstatusblockStatistics <? echo $blockStatus; ?>">
				<div class="secstatusblock_title"><? echo $active; ?></div>
			</div>
			<div class="descrdate">
				<span class="dname">Показов:</span><span class="ddate datefirst"><? echo $showCounter; ?></span>
				<span class="dname">Кликов:</span><span class="ddate"><? echo 'кликов'; ?></span>
			</div>
			<div class="descrline">
				<span class="lname">Ссылка:</span><span class="ldescr"><a href='<? echo $arResult['PROPERTIES']['link']['VALUE']; ?>'><? echo $arResult['PROPERTIES']['link']['VALUE']; ?></a></span><br />
				<span class="lname">Тип:</span><span class="ldescr"><? echo $arResult['PROPERTIES']['type']['VALUE']; ?></span><br />
				<span class="lname">Страница показа:</span><span class="ldescr"><? echo $hostingPage; ?></span><br />
				<span class="lname">Зона показа:</span><span class="ldescr"><? echo $arResult['PROPERTIES']['displayingArea']['VALUE']; ?></span>
			</div>
		</div>
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