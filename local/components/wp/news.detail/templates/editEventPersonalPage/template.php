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

<form name="iblock_add" action="/editelement/?edit=Y&CODE=<? echo $arResult['ID']; ?>" method="POST" enctype="multipart/form-data" class='addEventFromPersonalPage'>
	<?=bitrix_sessid_post()?>

<div class="col-xs-9 content-margin" id="article">
<?
if (isset($_GET['errorStr']) && !empty($_GET['errorStr']))
{
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['errorStr']; ?>
			</div>
		</div>
	</div>
<?	
}

if (isset($_GET['msg']) && !empty($_GET['msg'])) { ?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<? echo $_GET['msg']; ?>
			</div>
		</div>
	</div>
<?
}
//pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_ELEMENT_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => $arResult['NAME'], 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT']), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>
		</div>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateRangeEvent.php',
							array('dateBeginPropId' => $arResult['PROPERTIES']['dateBegin']['ID'],
								'dateBegin' => $arResult['PROPERTIES']['dateBegin']['VALUE'],
								'dateEndPropId' => $arResult['PROPERTIES']['dateEnd']['ID'],
								'dateEnd' => $arResult['PROPERTIES']['dateEnd']['VALUE'],
								'timePropId' => $arResult['PROPERTIES']['timeBegin']['ID'],
								'time' => $arResult['PROPERTIES']['timeBegin']['VALUE'],
								'timeEndPropId' => $arResult['PROPERTIES']['timeEnd']['ID'],
								'timeEnd' => $arResult['PROPERTIES']['timeEnd']['VALUE']),
							array());
//*********************************************************************************************************************************
?>

		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_place">Место проведения события</label>
					<input type="text" class="form-control" id="lk_place" name='PROPERTY[<? echo $arResult['PROPERTIES']['place']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['place']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group phoneList">
					<label class="control-label mainlabel" for="lk_phone">Телефон</label>
<?
						$key = 0;
						if (is_array($arResult['PROPERTIES']['phone']['VALUE']))
						{
							foreach ($arResult['PROPERTIES']['phone']['VALUE'] as $key => $phone)
							{
?>
								<input type="text" class="form-control" id="lk_phone" name='PROPERTY[<? echo $arResult['PROPERTIES']['phone']['ID']; ?>][<? echo $key; ?>]' value="<? echo $phone; ?>">
<?
							}
						}
						else
						{
?>
							<input type="text" class="form-control" id="lk_phone" name='PROPERTY[<? echo $arResult['PROPERTIES']['phone']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['phone']['VALUE']; ?>">
<?
						}
?>
				</div>
				<div class="btn btn-blue btnplus minbr addPhone">
					<span class="plus text-center">+</span>Добавить телефон
				</div>

				<div class='hide templatePhone'>
					<input type="text" class="form-control" id="<? echo $key + 1; ?>" name='PROPERTY[<? echo $arResult['PROPERTIES']['phone']['ID']; ?>][<? echo $key + 1; ?>]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_site">Сайт</label>
					<input type="text" class="form-control" id="lk_site" name='PROPERTY[<? echo $arResult['PROPERTIES']['site']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['site']['VALUE']; ?>">
				</div>
			</div>
			
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="registrationLink">Email</label>
					<input type="text" class="form-control" id="registrationLink" name='PROPERTY[<? echo $arResult['PROPERTIES']['email']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['email']['VALUE']; ?>">
				</div>
			</div>
			<?
			/*
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_source">Источник</label>
					<input type="text" class="form-control" id="lk_source" name='PROPERTY[<? echo $arResult['PROPERTIES']['source']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['source']['VALUE']; ?>">
				</div>
			</div>
			*/
			?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_text">Текст на картинке</label>
					<input type="text" class="form-control" id="lk_text" name='PROPERTY[<? echo $arResult['PROPERTIES']['text']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['text']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkVK">Ссылка Вконтакте</label>
					<input type="text" class="form-control" id="socialNetworkLinkVK" name='PROPERTY[<? echo $arResult['PROPERTIES']['socialNetworkLinkVK']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['socialNetworkLinkVK']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkGooglePlus">Ссылка Google+</label>
					<input type="text" class="form-control" id="socialNetworkLinkGooglePlus" name='PROPERTY[<? echo $arResult['PROPERTIES']['socialNetworkLinkGooglePlus']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['socialNetworkLinkGooglePlus']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkTwitter">Ссылка Twitter</label>
					<input type="text" class="form-control" id="socialNetworkLinkTwitter" name='PROPERTY[<? echo $arResult['PROPERTIES']['socialNetworkLinkTwitter']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['socialNetworkLinkTwitter']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkInstagram">Ссылка Instagram</label>
					<input type="text" class="form-control" id="socialNetworkLinkInstagram" name='PROPERTY[<? echo $arResult['PROPERTIES']['socialNetworkLinkInstagram']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['socialNetworkLinkInstagram']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkFacebook">Ссылка Facebook</label>
					<input type="text" class="form-control" id="socialNetworkLinkFacebook" name='PROPERTY[<? echo $arResult['PROPERTIES']['socialNetworkLinkFacebook']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['socialNetworkLinkFacebook']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="registrationLink">Ссылка на регистрацию</label>
					<input type="text" class="form-control" id="registrationLink" name='PROPERTY[<? echo $arResult['PROPERTIES']['registrationLink']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['registrationLink']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="block-default in block-shadow content-margin ">
					<div class="lk_companylogoblock clearfix">
						<div class="lk_companylogoimg floatleft">
<?
						if (!empty($arResult['PROPERTIES']['schemeExhibitionFile']['VALUE']))
							$file = CFile::ResizeImageGet($arResult['PROPERTIES']['schemeExhibitionFile']['VALUE'], array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						else
							$file['src'] = '';
?>
							<img src="<? echo $file["src"]; ?>" border="0" />
						</div>
						<div class="lk_companylogotextEditForm">
							<div class="lk_companylogotitle">Схема выставки:</div>
							<div class="lk_companylogobtn">
								<input type="hidden" name="PROPERTY[<? echo $arResult['PROPERTIES']['schemeExhibitionFile']['ID']; ?>][<? echo $arResult['PROPERTIES']['schemeExhibitionFile']['PROPERTY_VALUE_ID']; ?>]" value="<? echo $arResult['PROPERTIES']['schemeExhibitionFile']['VALUE']; ?>" />
								<input type="file" class='hide fileUpload' id='scheme' name="PROPERTY_FILE_<? echo $arResult['PROPERTIES']['schemeExhibitionFile']['ID']; ?>_<? echo $arResult['PROPERTIES']['schemeExhibitionFile']['PROPERTY_VALUE_ID']; ?>" />
								<label for='scheme'>
									<div class="btn btn-blue btnplus minbr">
										<span class="plus text-center">+</span>Выбрать изображение
									</div>
								</label>
								<span id='schemeFileName'></span>
							</div>
						</div>
					</div>
				</div>
			</div>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
							array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
									'previewPictureId' => $arResult["PREVIEW_PICTURE"]["ID"],
									'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"]),
							array());
//*********************************************************************************************************************************

$APPLICATION->IncludeFile('/tpl/include_area/tags.php', array('value' => $arResult['TAGS'], 'text' => 'size="'.$arResult["PROPERTY_LIST_FULL"]["TAGS"]["COL_COUNT"].'"'), array());

?>


		
		</div>
		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" />
		<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
	</div>
	<div class="previewBlock"></div>
</div>
</form>
<script type="text/javascript">
	$('#addNewTag').on('click', function(){
		var newTag = $('#newTag').val();
		if ('' != newTag && ' ' != newTag && !!newTag[0] && ' ' != newTag[0])
		{
			var existsTags = $('.search-tags').val();
			$('#newTag').val('');
			$('.tagsList').append('<span class="tag btn btn-blue-full minbr">' + newTag + '</span>');

			console.log('et', existsTags[0]);
			if ('' != existsTags && ' ' != existsTags && !!existsTags[0] && ' ' != existsTags[0])
				$('.search-tags').val(existsTags + ', ' + newTag);
			else
				$('.search-tags').val(newTag);
		}
	});

	$('.tagsList').on('click', '.tag', function(){
		var tag = $(this).text() + ',';
		var existsTags = $('.search-tags').val() + ',';

		existsTags = existsTags.replace (new RegExp (tag, 'g'), '');
		var pos = existsTags.lastIndexOf(',');
		$('.search-tags').val(existsTags.slice(0, pos));
		$(this).remove();
	});
</script>

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