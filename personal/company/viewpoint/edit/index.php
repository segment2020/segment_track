<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить мнение");
?>
<div class="container-fluid">
	<div class="row">

<?
$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);

if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("NAME");
	$arFilter = array("IBLOCK_ID" => 1, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arFields = $ob->GetFields();

	$arSelect = array();
	$arFilter = array("IBLOCK_ID" => $_GET['iBlockId'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>21), $arSelect);
	if ($ob = $res->GetNextElement())
		$arProps = $ob->GetProperties();
}
?>

<div class="col-xs-3 content-margin" id="aside1">
	<div id="getFixed" class="lkmenuslide">
		<div class=" content-margin">
			<div class="block-default block-shadow lk_userinfo clearfix">
				<div class="lk_userinfoimg floatleft">
					<img src="<? echo $leftSideAvatarFile["src"]; ?>">
				</div>
				<div class="lk_userinfotext">
					<div class="lk_userinfoname">
						<? echo (CUser::GetFirstName())?CUser::GetFirstName():CUser::GetLogin(); ?>
					</div>
					<div class="lk_userinfofirm">
						<div><? echo $arUser["WORK_POSITION"]; ?></div>
						<div><? echo $arFields['NAME']; ?></div>
					</div>
					<div class="lk_userinfobtn">
						<a href="/personal/" class="btn btn-blue-full btnmin minbr lk_userinfobtnf">Редактировать</a>
						<a href="/?logout=yes" class="btn btn-blue-full btnmin minbr">Выход</a>
					</div>
				</div>
			</div>
		</div>
		<div class="content-margin">
			<div class="list-group block-shadow lk_lmenu clearfix" id="collapselkmenu">
				<?$APPLICATION->IncludeFile('/tpl/include_area/personalPageMenu.php', array('companyId' => $arUser['UF_ID_COMPANY'], 'companyName' => $arFields['NAME']), array());?>
			</div>
		</div>
	</div>
</div>

<?
if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
{
	$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"editViewpointInPersonalPage", 
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
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/viewpoint/edit/#ELEMENT_CODE#/",
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
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "Viewpoint",
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
			1 => "imgString",
			2 => "SHOW_COUNTER",
			3 => "",
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
		"COMPONENT_TEMPLATE" => "editViewpointInPersonalPage"
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
		<h1>Добавить мнение</h1>
		<div class="block-default in block-shadow content-margin">
			<div class="row">
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => '', 'previewText' => '', 'detailText' => ''), array());
//*********************************************************************************************************************************

	
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_nameAuthor">Имя автора*</label>
						<input type="text" class="form-control" id='lk_nameAuthor' name="PROPERTY[<? echo $arProps['name']['ID']; ?>][0]" value="">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_newsSource">Источник</label>
						<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arProps['source']['ID']; ?>][0]' value="">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_photoSource">Источник фото</label>
						<input type="text" class="form-control" id="lk_photoSource" name='PROPERTY[<? echo $arProps['imgSource']['ID']; ?>][0]' value="">
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
?>
			</div>
		</div>

		<? $APPLICATION->IncludeFile('/tpl/include_area/addMaterial.php', array(), array()); ?>

		<div class='block-default in block-shadow content-margin'>
				<div class='row'>
					<? $APPLICATION->IncludeFile('/tpl/include_area/tags.php', array(), array()); ?>
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
	</div>
	</form>

	<script type="text/javascript">
		$('.addCategory').on('change', function(){
			var id = $(this).attr('id');
			var iBlockId = $(this).val();

			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '/ajax/additionalMaterial.php',
				data: 'iBlockId=' + iBlockId,
				beforeSend: function() {
					$('#addMatElem_' + id).addClass('hide');
				},
				success: function(response) {
					$('#el_' + id).empty();
					$('#el_' + id).append(response);
					$('#el_' + id).selectpicker('refresh');
					$('#addMatElem_' + id).removeClass('hide');
				}
			})
		});

		// $('.addElement').on('change', function(){
			// var id = $(this).attr('id');
			// var elInputCopy = $('#' + id + '_copy');
			// var val = $(this).val();
			// elInputCopy.val(val);
		// });

		/*
		var list = document.getElementById("addMaterial");

		list.addEventListener("change", function() {
			var selectedIndex = list.options.selectedIndex;
			var iBlockId = list.options[selectedIndex].value;

			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '/ajax/additionalMaterial.php',
				data: 'iBlockId=' + iBlockId,
				beforeSend: function() {
					$('#addMatElem').addClass('hide');
				},
				success: function(response) {
					$('#lk_el').append(response);
					$('#lk_el').selectpicker('refresh');
					$('#addMatElem').removeClass('hide');
				}
			})
		});
		*/
	</script>
<?
}
?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>