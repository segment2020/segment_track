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
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/admin_tools.php";
if (!CModule::includeModule("iblock") || !CModule::includeModule('fileman')) {
    echo 'нет нужных модулей';
}
?>

<form name="iblock_add" action="/editelement/?edit=Y&CODE=<? echo $arResult['ID']; ?>" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage' id='videoAlbum'>
	<?=bitrix_sessid_post()?>

<div class="col-sm-9 col-xs-12 content-margin" id="article">
<?
// pre($arResult);

if (isset($_GET['errorStr']) && !empty($_GET['errorStr']))
{
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
<?
	echo $_GET['errorStr'];
?>
			</div>
		</div>
	</div>
<?	
}

if (isset($_GET['msg']) && !empty($_GET['msg']))
{
?>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
<?
	echo $_GET['msg'];
?>
			</div>
		</div>
	</div>
<?
}
?>
	<h1><? echo GetMessage('EDIT_NEWS_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_name">Название альбома*</label>
					<input type="text" class="form-control" id="lk_name" name='PROPERTY[NAME][0]' value="<? echo $arResult['NAME']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_previewText">Описание альбома</label>
					<textarea class='form-control maintextarea' id="lk_previewText" name="PROPERTY[PREVIEW_TEXT][0]"><? echo $arResult['PREVIEW_TEXT']; ?></textarea>
				</div>
			</div>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>
			<div class="col-xs-12">
				<div class="lk_companylogoblock clearfix">
					<div class="lk_companylogoimg floatleft">
<?
					if ($arResult["PREVIEW_PICTURE"]["SRC"])
						$file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					else
						$file['src'] = '';
?>
						<img src="<? echo $file["src"]; ?>" border="0" />
					</div>
					<div class="lk_companylogotextEditForm ">
						<div class="lk_companylogotitle">Обложка:</div>
						<div class="lk_companylogobtn">
							<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $arResult["PREVIEW_PICTURE"]["ID"]; ?>" />							
							<input type="file" name="PROPERTY_FILE_PREVIEW_PICTURE_0" id="previewPicture" class='hide fileUpload' />
							<label for='previewPicture'>
								<div class="btn btn-blue btnplus minbr">
									<span class="plus text-center">+</span>Выбрать изображение
								</div>
							</label>
						</div>
					</div>
				</div>
				<div class="seporator lksep"></div>
			</div>

<?
$videoFilePropertyId = $arResult['PROPERTIES']['videoFile']['ID'];
$videoLinkPropertyId = $arResult['PROPERTIES']['videoiFrame']['ID'];
if (IBLOCK_ID_GALLERY_PHOTO === (int)$arResult['IBLOCK_ID'])
{
?>
		<div class="col-xs-12 ">
			<div id='fileList'>
<?
				//pre($arResult['PROPERTIES']['images']);

				_ShowPropertyField(
					'PROPERTY[33]', 
					$arResult['PROPERTIES']['images'], 
					$arResult['PROPERTIES']['images']["VALUE"], 
					false, 
					false, 
					50000, 
					'form_name'
				);
	
/*	
				$imgPropertyId = $arResult['PROPERTIES']['images']['ID'];
				foreach ($arResult['PROPERTIES']['images']['VALUE'] as $key => $fileId)
				{
					$file = CFile::ResizeImageGet($fileId, array('width'=>250, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);

					$deleteName = 'DELETE_FILE[' . $imgPropertyId . '][' . $arResult['PROPERTIES']['images']['PROPERTY_VALUE_ID'][$key] . ']';
					$idItem = 'file_delete_' . $imgPropertyId . '_' . $key;
					$hiddenName = 'PROPERTY[' . $imgPropertyId . '][' . $arResult['PROPERTIES']['images']['PROPERTY_VALUE_ID'][$key] .']';
					$inputNmae = 'PROPERTY_FILE_' . $imgPropertyId . '_' . $arResult['PROPERTIES']['images']['PROPERTY_VALUE_ID'][$key];
?>
					<img src="<? echo $file['src']; ?>">
					<input type="checkbox" name="<? echo $deleteName; ?>" id="<? echo $idItem; ?>" value="Y">
					<label for="<? echo $idItem; ?>">удалить файл</label>
					<input type="hidden" name="<? echo $hiddenName; ?>" value="<? echo $fileId; ?>">
					<input type="file" size="30" name="<? echo $inputNmae; ?>">
					<div class="btn btn-blue btnplus minbr">
						<span class="plus text-center">+</span>Заменить изображение
					</div>
					<br>
<?
					$lastFileNum = $key;
				}
			
?>
			</div>

			<div class="col-xs-12">
				<h3>Новые изображения</h3>
<?

				$begin = $lastFileNum + 1;
				$end = $lastFileNum + 5;
				for ($n = $begin; $n < $end; ++$n)
				{
?>
					<div class="lk_companylogobtn">
						<input type="hidden" name="PROPERTY[<? echo $imgPropertyId; ?>][<? echo $n; ?>]" value="" />
						<input type="file" name="PROPERTY_FILE_<? echo $imgPropertyId . '_' . $n; ?>" />
						<div class="btn btn-blue btnplus minbr">
							<span class="plus text-center">+</span>Выбрать изображение
						</div>
					</div>
<?				}
*/	
?>
			</div>
		</div>
<?
}
elseif (IBLOCK_ID_GALLERY_VIDEO === (int)$arResult['IBLOCK_ID'])
{	
	$videoFilePropertyValueId = $arResult['PROPERTIES']['videoFile']['PROPERTY_VALUE_ID'];

	if (!empty($arResult['PROPERTIES']['videoFile']['VALUE']))
	{
		echo '<div class="col-xs-12 content-margin">
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
		echo '    </div>
			  </div>';
	
?>
			<div class="col-xs-12">
				<h3>Загрузить видео</h3>
				<div class="lk_companylogobtn">
					<input type="hidden" name="PROPERTY[<? echo $videoFilePropertyId . '][' . $videoFilePropertyValueId; ?>]" value="<? echo $arResult['PROPERTIES']['videoFile']['VALUE']; ?>" />
					<input type="file" class='hide' name="PROPERTY_FILE_<? echo $videoFilePropertyId . '_' . $videoFilePropertyValueId; ?>" id='videofile' />
					<label for='videofile'>
						<div class="btn btn-blue btnplus minbr">
							<span class="plus text-center">+</span>Выбрать файл
						</div>
					</label>
					<br>
					<input type="checkbox" name="DELETE_FILE[<? echo $videoFilePropertyId . '][' . $videoFilePropertyValueId; ?>]" id="file_delete_<? echo $videoFilePropertyId . '_' . $videoFilePropertyValueId; ?>" value="Y">
					<label for="file_delete_<? echo $videoFilePropertyId . '_' . $videoFilePropertyValueId; ?>">удалить файл</label>
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="videoLinkReplacement">Заменить ссылкой на видео</label>
					<input type="text" class="form-control"  id='videoLinkReplacement' name='PROPERTY[<? echo $videoLinkPropertyId; ?>][0]' value="">
				</div>
			</div>
			
<?	} // end if (!empty($arResult['PROPERTIES']['videoFile']['VALUE']))
	elseif (!empty($arResult['PROPERTIES']['videoiFrame']['VALUE']))
	{
?>
			<div class="col-xs-12">
				<div class="form-group">
					<input type="radio" id="lk_videoLinkRadio" checked name='radio'>
					<label class="control-label mainlabel" for="lk_videoLinkRadio">Оставить ссылку</label>
					<br>
					<label class="control-label mainlabel" for="lk_videoLink">Ссылка на видео iFrame</label>
					<input type="text" class="form-control" id="lk_videoLink" name='PROPERTY[<? echo $videoLinkPropertyId; ?>][0]' value="<? echo $arResult['PROPERTIES']['videoiFrame']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<input type="radio" id="lk_videoFileRadio" name='radio'>
				<label class="control-label mainlabel" for="lk_videoFileRadio">Оставить файл</label>
				<br>
				<h3>Загрузить видео</h3>
				<div class="lk_companylogobtn">
					<input type="hidden" name="PROPERTY[<? echo $videoFilePropertyId; ?>][0]" value="" />
					<input type="file" name="PROPERTY_FILE_<? echo $videoFilePropertyId; ?>_0"  class='hide fileUpload' id='videofile' />
					<label for='videofile'>
						<div class="btn btn-blue btnplus minbr">
							<span class="plus text-center">+</span>Выбрать файл
						</div>
					</label>
					<span id='videofileFileName'></span>
				</div>
			</div>
<?
	}
	else
	{
?>
			<div class="col-xs-12">
				<div class="btn btn-blue btnplus minbr" id='uploadVideo'>
					<span class="plus text-center">+</span>Загрузить видео
				</div>
				<div class="btn btn-blue btnplus minbr" id='insertLink'>
					<span class="plus text-center">+</span>Вставить ссылку
				</div>
			</div>
	
			<div class="col-xs-12 hide" id='videoLink'>
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_videoLink">Ссылка на видео</label>
					<input type="text" class="form-control" id="lk_videoLink" name='PROPERTY[<? echo $videoLinkPropertyId; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12 hide" id='videoFile'>
				<h3>Загрузить видео</h3>
				<div class="lk_companylogobtn">
					<input type="hidden" name="PROPERTY[<? echo $videoFilePropertyId; ?>][0]" value="" />
					<input type="file" name="PROPERTY_FILE_<? echo $videoFilePropertyId; ?>_0" />
					<div class="btn btn-blue btnplus minbr">
						<span class="plus text-center">+</span>Выбрать файл
					</div>
				</div>
			</div>

			<script type="text/javascript">
				$('#uploadVideo').on('click', function()
				{
					$('#videoLink').addClass('hide');
					$('#videoFile').removeClass('hide');
					$('#videoFile').toggleClass('active');

					if ($('#videoLink').hasClass('active'))
						$('#videoLink').removeClass('active');
				});

				$('#insertLink').on('click', function()
				{
					$('#videoFile').addClass('hide');
					$('#videoLink').removeClass('hide');
					$('#videoLink').toggleClass('active');

					if ($('#videoFile').hasClass('active'))
						$('#videoFile').removeClass('active');
				});
			</script>
<?
	}
} // end elseif (IBLOCK_ID_GALLERY_VIDEO === (int)$arResult['IBLOCK_ID'])
else
{
}
?>
		</div> <!-- end div class="row"> -->
		
		<script type="text/javascript">
			$('#videoAlbum').on('submit', function(event) {
				var link = $('#videoLinkReplacement').val();
				if ('' != link)
					$('input:checkbox').prop('checked', true);

				var radioLink = $('#lk_videoLinkRadio');
				var radioFile = $('#lk_videoFileRadio');
				if (!!radioLink && radioLink.prop('checked'))
					$('#videofile').remove();
				else if (!!radioFile && radioFile.prop('checked'))
					$('#lk_videoLink').remove();
			});
		</script>

		<br>
		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" />
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
	</div>
</div>
</form>


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