<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="lk_name"><? echo isset($titleName)? $titleName: 'Заголовок*'; ?></label>
		<input type="text" class="form-control" id="lk_name" name='PROPERTY[NAME][0]' value="<? echo $name; ?>">
	</div>
</div>

<?
if ('false' !== $includePreviewText) {
	$additionalText = ' (не более 500 знаков)';
	$id = 'lk_previewText';
	if ($catalog)
	{
		$additionalText = '';
		$id = 'productDescription';
	}
?>
<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="<? echo $id; ?>"><? echo isset($previewTextTitle)? $previewTextTitle: 'Анонс публикации'; echo $additionalText; ?></label>

		<textarea class='form-control maintextarea' id="<? echo $id; ?>" name="PROPERTY[PREVIEW_TEXT][0]"><? echo $previewText; ?></textarea>

		<?
		/*
			$LHE = new CHTMLEditor;
			$LHE->Show(array(
				'name' => "PROPERTY[PREVIEW_TEXT][0]",
				'id' => "lk_previewText",
				'inputName' => "PROPERTY[PREVIEW_TEXT][0]",
				'content' => $previewText,
				'width' => '100%',
				'minBodyWidth' => 248,
				'normalBodyWidth' => 555,
				'height' => '200',
				'bAllowPhp' => false,
				'limitPhpAccess' => false,
				'autoResize' => true,
				'autoResizeOffset' => 40,
				'useFileDialogs' => false,
				'saveOnBlur' => true,
				'showTaskbars' => false,
				'showNodeNavi' => false,
				'askBeforeUnloadPage' => true,
				'bbCode' => false,
				'siteId' => SITE_ID,
				'controlsMap' => array(
					array('id' => 'Bold', 'compact' => true, 'sort' => 80),
					array('id' => 'Italic', 'compact' => true, 'sort' => 90),
					array('id' => 'Underline', 'compact' => true, 'sort' => 100),
					array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
					array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
					array('id' => 'Color', 'compact' => true, 'sort' => 130),
					array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
					array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
					array('separator' => true, 'compact' => false, 'sort' => 145),
					array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
					array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
					array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
					array('separator' => true, 'compact' => false, 'sort' => 200),
					array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
					array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
					array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
					array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
					array('separator' => true, 'compact' => false, 'sort' => 290),
					array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
					array('id' => 'More', 'compact' => true, 'sort' => 400)
				),
			));
			*/
		?>
		<input type="hidden" name='PROPERTY[PREVIEW_TEXT_TYPE][0]' value="html">
	</div>
</div>
<?
}
?>


<?
/*
<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="lkpreviewTextTypeHtml">html</label>
		<input type="radio" class="" id="lk_previewTextTypeHtml" name='PROPERTY[PREVIEW_TEXT_TYPE][0]' value="html">
		<label class="control-label mainlabel" for="lk_previewTextTypeText">text</label>
		<input type="radio" class="" id="lk_previewTextTypeText" name='PROPERTY[PREVIEW_TEXT_TYPE][0]' value="text" checked>
	</div>
</div>
*/
?>
<?
if ('false' !== $includeDetailText) { ?>
<?/*
<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="lk_detailText"><? echo isset($detailTextTitle)? $detailTextTitle: 'Полный текст публикации'; ?></label>
		
			$LHE = new CHTMLEditor;
			$LHE->Show(array(
				'name' => "PROPERTY[DETAIL_TEXT][0]",
				'id' => "lk_detailText",
				'bodyClass' => 'form-control',
				'inputName' => "PROPERTY[DETAIL_TEXT][0]",
				'content' => $detailText,
				'width' => '100%',
				'minBodyWidth' => 350,
				'normalBodyWidth' => 555,
				'height' => '200',
				'bAllowPhp' => false,
				'limitPhpAccess' => false,
				'autoResize' => true,
				'autoResizeOffset' => 40,
				'useFileDialogs' => false,
				'saveOnBlur' => true,
				'showTaskbars' => false,
				'showNodeNavi' => false,
				'askBeforeUnloadPage' => true,
				'bbCode' => false,
				'siteId' => SITE_ID,
				'controlsMap' => array(
					array('id' => 'Bold', 'compact' => true, 'sort' => 80),
					array('id' => 'Italic', 'compact' => true, 'sort' => 90),
					array('id' => 'Underline', 'compact' => true, 'sort' => 100),
					array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
					array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
					array('id' => 'Color', 'compact' => true, 'sort' => 130),
					array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
					array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
					array('separator' => true, 'compact' => false, 'sort' => 145),
					array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
					array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
					array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
					array('separator' => true, 'compact' => false, 'sort' => 200),
					array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
					array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
					array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
					array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
					array('separator' => true, 'compact' => false, 'sort' => 290),
					array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
					array('id' => 'More', 'compact' => true, 'sort' => 400)
				),
			));
		
		<input type="hidden" name='PROPERTY[DETAIL_TEXT_TYPE][0]' value="html">
	</div>
</div>
*/
?>

<?
/*
<script src="/tpl/ckeditor/ckeditor.js"></script>
*/
?>
<script src="https://cdn.ckeditor.com/4.7.3/standard-all/ckeditor.js"></script>
<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="lk_detailText"><? echo isset($detailTextTitle)? $detailTextTitle: 'Полный текст публикации'; ?></label>
		<textarea name="PROPERTY[DETAIL_TEXT][0]" id="editor1" rows="10" cols="80">
			<? echo $detailText; ?>
        </textarea>
		<input type="hidden" name='PROPERTY[DETAIL_TEXT_TYPE][0]' value="html">
		<script>
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			
			 // CKEDITOR.replace( 'editor1' );
					// CKEDITOR.replace('PROPERTY[DETAIL_TEXT][0]');
					CKEDITOR.replace('PROPERTY[DETAIL_TEXT][0]', {filebrowserUploadUrl: '/imgload/imgload.php', extraPlugins: 'image2'});
			// CKEDITOR.replace('PROPERTY[DETAIL_TEXT][0]', {filebrowserImageUploadUrl: '/uploader/uploader.php'});
			// CKEDITOR.replace('PROPERTY[DETAIL_TEXT][0]', {filebrowserBrowseUrl: '/uploader/uploader.php',
														  // filebrowserUploadUrl: '/uploader/uploader.php'});
														  
														  
			// ClassicEditor
				// .create( document.querySelector( '#editor1' ) )
				// .then( editor => {
					// console.log( editor );
				// } )
				// .catch( error => {
					// console.error( error );
				// } );
		</script>
	</div>
</div>
<?
} // end if ('false' !== $includeDetailText)
?>


<?
/*
<div class="col-xs-12">
	<div class="form-group">
		<label class="control-label mainlabel" for="lk_detailTextTypeHtml">html</label>
		<input type="radio" class="" id="lk_detailTextTypeHtml" name='PROPERTY[DETAIL_TEXT_TYPE][0]' value="html">
		<label class="control-label mainlabel" for="lk_detailTextTypeText">text</label>
		<input type="radio" class="" id="lk_detailTextTypeText" name='PROPERTY[DETAIL_TEXT_TYPE][0]' value="text" checked>
	</div>
</div>
*/
?>