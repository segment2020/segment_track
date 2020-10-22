<?
	$title1 = isset($title1)? $title1: 'Изображение для анонса:';
	$title2 = isset($title2)? $title2: 'Изображение для детальной страницы:';
?>
<div class="col-xs-12">
	<div class="block-default in block-shadow content-margin" id='previewPictureBlock'>
		<div class="lk_companylogoblock clearfix">
			
<?
			if (isset($page) && 'banners' === $page) {
				if (!empty($previewPictureId))
				{
					$arFile = CFile::GetFileArray($previewPictureId);
					if ($arFile)
					{
						$name = $arFile['ORIGINAL_NAME'];
						$src = $arFile['SRC'];
					}
				}
				else
				{
					$previewPictureId = 0;
				}
?>

				<div class="lk_companylogoimg lk_companylogoimgEditForm floatleft">
					<? if (0 !== $previewPictureId) { ?>
						<object type="application/x-shockwave-flash" data="<? echo $src; ?>" width="310" height="175" id='flashBanner'>
							<param name="move" value="<? echo $src; ?>">
						</object>
					<?	} else {
					?>
						<img src="" border="0" />
					<?}?>
				</div>

				<div class="lk_companylogotextEditForm">
					<div class="lk_companylogotitle"><? echo $title1; ?></div>
					<div class="lk_companylogobtn">
						<input type="hidden" name="PROPERTY[<? echo PROPERTY_ID_FLASH_IN_BANNERS; ?>][<? echo $previewPictureId; ?>]" value="<? /*echo $previewPictureId;*/ ?>" />
						<input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_<? echo PROPERTY_ID_FLASH_IN_BANNERS; ?>_<? echo $previewPictureId; ?>" />
						<label for='previewPicture'>
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать flash
							</div>
						</label>
						<span id='previewPictureFileName'><? echo $name; ?></span>
					</div>
				</div>

<?			} else { ?>
				<div class="lk_companylogoimg lk_companylogoimgEditForm floatleft">
<?
				if ($previewPictureSrc)
					$file = CFile::ResizeImageGet($previewPictureId, array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				else
					$file['src'] = '';
?>
					<img src="<? echo $file["src"]; ?>" border="0" />
				</div>
				<div class="lk_companylogotextEditForm">
					<div class="lk_companylogotitle"><? echo $title1; ?></div>
					<div class="lk_companylogobtn">
						<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $previewPictureId; ?>" />
						<input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
						<label for='previewPicture'>
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</label>
						<span id='previewPictureFileName'></span>
					</div>
				</div>
<?
			}
?>
			
			
			
		</div>
	</div>
</div>

<div class="col-xs-12">
	<div class="block-default in block-shadow content-margin">
		<div class="lk_companylogoblock clearfix">
			<div class="lk_companylogoimg lk_companylogoimgEditForm floatleft">
<?
			if ($detailPictureSrc)
				$file = CFile::ResizeImageGet($detailPictureId, array('width'=>310, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			else
				$file['src'] = '';
?>
				<img src="<? echo $file["src"]; ?>" border="0" />
			</div>
			<div class="lk_companylogotextEditForm">
				<div class="lk_companylogotitle"><? echo $title2; ?></div>
				<div class="lk_companylogobtn">
					<input type="hidden" name="PROPERTY[DETAIL_PICTURE][0]" value="<? echo $detailPictureId; ?>" />
					<input type="file" class='hide fileUpload' id='detailPicture' name="PROPERTY_FILE_DETAIL_PICTURE_0" />
					<label for='detailPicture'>
						<div class="btn btn-blue btnplus minbr">
							<span class="plus text-center">+</span>Выбрать изображение
						</div>
					</label>
					<span id='detailPictureFileName'></span>
				</div>
			</div>
		</div>
		<? if ('' != $file['src']) { ?>
			<br>
			<br>
			<input type="checkbox" name="DELETE_FILE[DETAIL_PICTURE][0]" id="file_delete_DETAIL_PICTURE_0" value="Y">
			<label for="file_delete_DETAIL_PICTURE_0">удалить изображение</label>
		<?}?>
	</div>
</div>