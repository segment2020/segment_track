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



// pre($arParams);
// pre($arResult);

$res = CIBlockElement::GetByID($arResult["ID"]);
if ($ar_res = $res->GetNext()) 
	$previewPicPath = CFile::GetPath($ar_res["PREVIEW_PICTURE"]); 

$showCounter = $arResult['SHOW_COUNTER']? $arResult['SHOW_COUNTER']: 0;
$msgCounter = isset($arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

if ($arResult["DETAIL_PICTURE"]["SRC"])
	$file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>890, 'height'=>340), BX_RESIZE_IMAGE_PROPORTIONAL, true);
else if (!empty($previewPicPath)) { 
	$file = CFile::ResizeImageGet($ar_res["PREVIEW_PICTURE"], array('width'=>890, 'height'=>340), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}
else 
	$file['src'] = '';
?>

<div class="block-default in block-shadow content-margin detailblock analyticsdet clearfix">
	<h1><?=$arResult["~NAME"]?></h1>
	<div class="infotvc">
		<span class="infotime"><? echo $arResult["DATE_CREATE"]; ?></span>
		<span class="infoview"><i class="icon-icons_main-05"></i><? echo $arParams['VIEWSCOUNT']; ?></span>
		<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
	</div>
	
<?
	if ($file['src'])
	{
?>
		<div class="mainphoto" style="background-image: url('<? echo $file['src']; ?>');">
<?
		if (isset($arResult['PROPERTIES']['imgString']['VALUE']) && !empty($arResult['PROPERTIES']['imgString']['VALUE']))
		{
?>
			<div class="mainphototitle">
				<? echo $arResult['PROPERTIES']['imgString']['VALUE']; ?>
			</div>
<?
		}
?>
	</div>
<?
	}


	if (isset($arResult['PREVIEW_TEXT']) && !empty($arResult['PREVIEW_TEXT'])) { ?>
		<div class="descrcontent">
			<? echo $arResult["PREVIEW_TEXT"]; ?>
		</div>
<?	}
?>

	<div class="detailcontent newscontent">
		<? echo $arResult["DETAIL_TEXT"]; ?>
	</div>

<!-- Источники. -->
	
<?	
	if (isset($arResult['PROPERTIES']['source']['VALUE']) && !empty($arResult['PROPERTIES']['source']['VALUE']))
	{
		if (parse_url($arResult['PROPERTIES']['source']['VALUE'], PHP_URL_SCHEME) != "") { 
			$domainSource = parse_url($arResult['PROPERTIES']['source']['VALUE'], PHP_URL_HOST);
			$source = $arResult['PROPERTIES']['source']['VALUE'];
		} else { 
			$domainSource = parse_url("http://".$arResult['PROPERTIES']['source']['VALUE'], PHP_URL_HOST);
			$source = "http://".$arResult['PROPERTIES']['source']['VALUE'];
		}
		
?>
	<noindex>
		<div class="sourceblock">
			<div class="title">Источник</div>
			<a class="link" href="<? echo $source; ?>" target="_blank" rel="noopener noreferrer">
				<? echo $domainSource ?>
			</a> 
		</div>
		<br>
	</noindex> 
<?	
	}
?>

<?
	if (isset($arResult['PROPERTIES']['imgSource']['VALUE']) && !empty($arResult['PROPERTIES']['imgSource']['VALUE']))
	{
		if (parse_url($arResult['PROPERTIES']['imgSource']['VALUE'], PHP_URL_SCHEME) != "") { 
			$domainSource = parse_url($arResult['PROPERTIES']['imgSource']['VALUE'], PHP_URL_HOST);
			$source = $arResult['PROPERTIES']['imgSource']['VALUE'];
		} else { 
			$domainSource = parse_url("http://".$arResult['PROPERTIES']['imgSource']['VALUE'], PHP_URL_HOST);
			$source = "http://".$arResult['PROPERTIES']['imgSource']['VALUE'];
		}
		;
?>
		 <noindex>
			<div class="sourceblock">
				<div class="title">Источник фото</div>
				<a class="link" href="<? echo $source; ?>" target="_blank" rel="noopener noreferrer">
					<? echo $domainSource ?>
				</a> 
			</div>
		</noindex> 
<?	
	}
?>

<?	 
	if (isset($arResult['PROPERTIES']['name']['VALUE']) && !empty($arResult['PROPERTIES']['name']['VALUE']))
	{
?>
		<div class="sourceblock">
			<div class="title">Автор</div>
			<div class="link">
				<? echo $arResult['PROPERTIES']['name']['VALUE']; ?>
			</div>
		</div>
<?	
	}


	if (isset($arResult['TAGS']) && !empty($arResult['TAGS']))
	{
?>
	<div class="tagblock">
		<span>Тэги:</span>
	<?
		$tags = explode(',', $arResult['TAGS']);
		foreach ($tags as $tag) { ?>
			<a href="/search/tagSearch.php?tags=<? echo trim($tag); ?>">#<? echo trim($tag); ?></a> 
	<?	} ?>
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