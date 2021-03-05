<?
use Bitrix\Main\Page\Asset;  

?>
<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-sm-9 col-xs-12 content-margin" id="article">
		

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
		
		if (isset($_GET['msg']) && !empty($_GET['msg']))
		{
		?>
				<div class="block-default in block-shadow content-margin ">
					<div class="row">
						<div class="col-xs-12">
							<? echo $_GET['msg']; ?>
						</div>
					</div>
				</div>
		<?
		}
		
	?>
		<h1><? echo $APPLICATION->sDocTitle;?></h1>
		<div class="block-default in block-shadow content-margin"> 
		<?  

//*********************************************************************************************************************************  
	$APPLICATION->IncludeFile('/tpl/include_area/newFields.php', array(
		'createNewMaterial' => true,  
		'iBlockId' => $_GET['iBlockId'],
		'editorDataId' => $jsonDataId,
		'moveToId' => $moveToId,
		), array()
	);  
//*********************************************************************************************************************************
 
//*********************************************************************************************************************************   
// $APPLICATION->IncludeFile('/tpl/include_area/newDateActiveFrom.php', array('dateActiveFrom' => ''), array()); 
//*********************************************************************************************************************************  
	?>  
		<div class='row'>
	<?
		if ($_GET['iBlockId'] == IBLOCK_ID_VIEWPOINT) { ?> 

		<div class="col-xs-12">
			<div class="form-group">
				<label class="control-label mainlabel" for="lk_nameAuthor">Имя автора*</label>
				<input type="text" class="form-control" id='lk_nameAuthor' name="PROPERTY[<?echo PROPERTY_ID_NAME_IN_VIEWPOINT ?>][0]" value="<?php echo $arResult['PROPERTIES']['name']['VALUE']; ?>">
			</div>
		</div>

		<? }
		if (!($_GET['iBlockId'] == IBLOCK_ID_PRODUCTS_REVIEW)) {   
			if (isset($arResult['PROPERTIES']['source'])) { ?> 
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_newsSource">Источник</label>
						<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['source']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['source']['VALUE']; ?>">
					</div>
				</div>
			<? } 
			if (isset($arResult['PROPERTIES']['imgSource'])) { ?> 
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_photoSource">Источник фото</label>
					<input type="text" class="form-control" id="lk_photoSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['imgSource']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['imgSource']['VALUE']; ?>">
				</div>
			</div>

		<? 	}   
	}  
	 	 $APPLICATION->IncludeFile('/tpl/include_area/tags.php', array(), array()); ?>
			</div> 
	</div>
 
		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
		<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
		<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
		<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
		<div class="errorBlock hide" id='errorText500'>Слишком длинный анонс</div>

		<div class="previewBlock"></div>
	</div>
	</form>
	
<?
	Asset::getInstance()->addJs('/tpl/js/jquery-ui.min.js');
?>
	<script type="text/javascript">
		var blockId = 0;

		$( function() {
			$(".autocompliteAdd").on('focus', function(){
				blockId = $(this).attr('id');
			});
		} );

		$('.addCategory').on('change', function(){
			var id = $(this).attr('id');
			var iBlockId = $(this).val();

			$('.addMat' + id).attr('id', iBlockId);
			$('.addMat' + id + 'Hide').attr('id', 'hide' + iBlockId);
			$('#addMatElem_' + id).removeClass('hide');

			$('.addMat' + id).autocomplete({
				source: function( request, response ) {
					$.ajax( {
						type: 'POST',
						url: "/ajax/additionalMaterial.php",
						dataType: "json",
						data: {
							term: request.term,
							iBlockId: blockId,
						},
						success: function( data ) {
							response(data);
						}
					} );
				},
				minLength: 3,
				select: function( event, ui ) {
					this.nextElementSibling.value = ui.item.id;
				}
			});
			
			return true;
			// $.ajax({
				// type: 'POST',
				// dataType: 'html',
				// url: '/ajax/additionalMaterial.php',
				// data: 'iBlockId=' + iBlockId,
				// beforeSend: function() {
					// $('#addMatElem_' + id).addClass('hide');
				// },
				// success: function(response) {
					// $('#el_' + id).empty();
					// $('#el_' + id).append(response);
					// $('#el_' + id).selectpicker('refresh');
					// $('#addMatElem_' + id).removeClass('hide');
				// }
			// })
		});
	</script> 