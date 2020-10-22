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
// pre($arResult['IBLOCK']['DESCRIPTION']);
$tmp = explode(',', $arResult['IBLOCK']['DESCRIPTION']);
$text = $tmp[0];
?>
<div class="photogaldetblock block-default in block-shadow content-margin detailblock">
<?
	if ($arResult['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE'])
	{
?>
		<div class="detailinfo clearfix">
			<div class="detailinfofirm floatleft">
				<? echo 'Альбом компании ' . $arResult['DISPLAY_PROPERTIES']['companyId']['DISPLAY_VALUE'] . '</a>'; ?>
			</div>
			<div class="detailinfolink floatleft">
				<a href="<?=$arResult['IBLOCK']['SECTION_PAGE_URL']?>?companyId=<? echo $arResult['PROPERTIES']['companyId']['VALUE']; ?>">
					<i class="icon-icons_main-10"></i>
					<span>Все <? echo $text; ?> компании</span>
				</a>
			</div>
		</div>
<?	}

	if (!empty($arResult['PROPERTIES']['images']['VALUE']))
	{
?>
	<div class="row">
		<h1><? echo $arResult['~NAME']; ?></h1>
<? 		if (!empty($arResult["PREVIEW_TEXT"]))
		{
?>
			<div class="descrcontent">
				<? echo $arResult["PREVIEW_TEXT"]; ?>
			</div>
<?		}

		$arraySrc = array();
		foreach ($arResult['PROPERTIES']['images']['VALUE'] as $key => $value)
		{
			$arrayQ = CFile::GetFileArray($value);
			
			$arrayQsmall = CFile::ResizeImageGet($value, array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_EXACT, true); 
			
			//pre($arrayQ);
	?>
			<div class="col-lg-3 col-sm-4 col-xs-6 cell-12-xs content-margin">
				<div class="block-default block-shadow">
					<a class="open-gallery" href="<? echo $arrayQ["SRC"]; ?>">
						<img src="<? echo $arrayQsmall["src"]; ?>" alt="">
					</a>
				</div>
			</div>
	<?	}	?>
	</div>
<?
	}
?>

<?
//*********************** Пример парсинга ***********************************
// $arrString = explode('src=', $arResult['PROPERTIES']['videoLink']['VALUE']);
// $arrString = explode(' ', $arrString[1]);
// $src = substr(htmlspecialchars_decode($arrString[0]), 1, -1);	
//***************************************************************************
	
	
	if (!empty($arResult['PROPERTIES']['videoiFrame']['VALUE']))
	{
		$arrString = explode('src=', $arResult['PROPERTIES']['videoiFrame']['VALUE']);
		$arrString = explode(' ', $arrString[1]);
		$src = substr(htmlspecialchars_decode($arrString[0]), 1, -1);
		$arrString = explode('embed/', $arResult['PROPERTIES']['videoiFrame']['VALUE']);
		$arrString = explode('?', $arrString[1]);
		$src0 = $arrString[0];
	?>
		<div class="row">
			<h1><? echo $arResult['~NAME']; ?></h1>
<? 			if (!empty($arResult["PREVIEW_TEXT"]))
			{
?>
				<div class="descrcontent">
					<? echo $arResult["PREVIEW_TEXT"]; ?>
				</div>
<?			}
?>
			<div class="col-xs-12 content-margin">
				<div class="block-default block-shadow">
					<div class="videoifame">
						<? echo $arResult["PROPERTIES"]["videoiFrame"]["~VALUE"]; ?>
					</div>
				</div>
			</div>
		</div>
		<? /* ?>
		<? echo 'Превью iFrame - оптимизация скорости заргузки'; ?>
		<div class="youtube" id="<? echo $src0; ?>" style="width:400px; height:200px;"></div>
		<script src="/tpl/js/youtube.js" type="text/javascript"></script>
		<? */ ?>
	<?}?>


	<?
	if (!empty($arResult['PROPERTIES']['videoFile']['VALUE']))
	{
		echo '<div class="row">
				<div class="col-xs-12 content-margin">
					<div class="block-default block-shadow">';
						$arrayQ = CFile::GetFileArray($arResult['PROPERTIES']['videoFile']['VALUE']);

						$APPLICATION->IncludeComponent(
							"bitrix:player", 
							".default", 
							array(
								"ADVANCED_MODE_SETTINGS" => "N",
								"AUTOSTART" => "N",
								"COMPONENT_TEMPLATE" => ".default",
								"HEIGHT" => "300",
								"MUTE" => "N",
								"PATH" => $arrayQ["SRC"],
								"PLAYBACK_RATE" => "1",
								"PLAYER_ID" => "",
								"PLAYER_TYPE" => "auto",
								"PRELOAD" => "N",
								"REPEAT" => "none",
								"SHOW_CONTROLS" => "Y",
								"SIZE_TYPE" => "fluid",
								"SKIN" => "",
								"SKIN_PATH" => "/bitrix/components/bitrix/player/videojs/skins",
								"START_TIME" => "0",
								"VOLUME" => "90",
								"WIDTH" => "400"
							),
							false
						);
		
		echo '		</div>
				</div>
			</div>';
		
	}?>
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
*/
?>