<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Page\Asset;
$APPLICATION->SetTitle("Добавить акцию");
?>
<div class="container-fluid">
	<div class="row">

<?
if (CModule::IncludeModule("iblock"))
{
	$arSelect = array();
	$arFilter = array("IBLOCK_ID" => $_GET['iBlockId'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arProps = $ob->GetProperties();
}
?>
	
<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());?>

<?
if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
{
	$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"editStocksInPersonalPage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/stock/edit/#ELEMENT_CODE#/",
		"ELEMENT_ID" => $_REQUEST["elementId"],
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "TAGS",
			2 => "PREVIEW_TEXT",
			3 => "PREVIEW_PICTURE",
			4 => "DETAIL_TEXT",
			5 => "DETAIL_PICTURE",
			6 => "SHOW_COUNTER",
			7 => "",
		),
		"IBLOCK_ID" => IBLOCK_ID_STOCK,
		"IBLOCK_TYPE" => "Stock",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "newsSource",
			2 => "imgSource",
			3 => "imgString",
			4 => "SHOW_COUNTER",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "editStocksInPersonalPage"
	),
	false
);
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
		<h1>Добавить акцию</h1>
		<div class="block-default in block-shadow content-margin ">
			<div class="row">
<?
$APPLICATION->IncludeFile('/tpl/include_area/marked.php', array('iBlockId' => $arProps['inTheTop']['IBLOCK_ID'],
																			'code' => $arProps['inTheTop']['CODE'],
																			'propInTopId' => PROPERTY_ID_MARKED_IN_NEWS_STOCK,
																			'propMarkedToId' => PROPERTY_ID_MARKED_TO_IN_NEWS_STOCK), array());

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => '', 'previewText' => '', 'detailText' => ''), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
//*********************************************************************************************************************************
?>
				<div class="col-xs-12">
					<div class="lk_companycatchek">
						<div class="mycheckbox">
						<?
						$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $arProps['showLogo']['IBLOCK_ID'], 'CODE' => $arProps['showLogo']['CODE']));
						if ($enumFields = $propertyEnums->GetNext())
							$propId = $enumFields['ID'];
						?>
							<label>
								<input type="checkbox" class="" checked name='PROPERTY[<? echo $arProps['showLogo']['ID']; ?>]' value="<? echo $propId; ?>">
								Показывать логотип компании на главной
							</label>
						</div>
					</div>
				</div>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
							array('previewPictureSrc' => '',
									'previewPictureId' => '',
									'detailPictureSrc' => '',
									'detailPictureId' => ''),
							array());
//*********************************************************************************************************************************

$APPLICATION->IncludeFile('/tpl/include_area/tags.php', array(), array());
?>
			</div>
		</div>

		<? $APPLICATION->IncludeFile('/tpl/include_area/addMaterial.php', array('propertyId' => 'PROPERTY[' . $arProps['addmore']['ID'] . ']'), array()); ?>

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
}
?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>