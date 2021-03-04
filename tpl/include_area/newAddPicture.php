<script>
	$("div.content-margin, div.lk_companylogobtn").on('change', 'input[type=file].fileUpload', setFileName);

	function setFileName() {
		// console.log($(this).closest('.lk_companylogoblock').html());
		var thisinput = $(this);
		var id = $(this).attr('id');
		var fileName = $(this).val().replace(/.*\\/, "");
		var elem = $("#" + id + "FileName");
		var input = this;

		$("#" + id + "FileName").text(fileName);
		// console.log(id);
		// console.log(fileName);
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				//$(this).closest('.lk_companylogoblock').find('img').attr('src', e.target.result);
				thisinput.closest('.lk_companylogoblock').find('img').attr('src', e.target.result);

			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

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
								<span class="plus text-center">+</span>Выбрать картинку анонса
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