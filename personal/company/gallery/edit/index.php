<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/admin_tools.php";
$APPLICATION->SetTitle("Добавить новость");
if (!CModule::includeModule("iblock") || !CModule::includeModule('fileman')) {
    echo 'нет нужных модулей';
}
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
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
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
	if (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
	{
		switch ($_GET['iBlockId'])
		{
			case IBLOCK_ID_GALLERY_PHOTO:
			{
				$iBlockType = 'photogallery';
				break;
			}

			case IBLOCK_ID_GALLERY_VIDEO:
			{
				$iBlockType = 'Videogallery';
				break;
			}
		}

		$APPLICATION->IncludeComponent(
			"wp:news.detail", 
			"editPhotoAlbumInPersonalPage", 
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
				"ELEMENT_CODE" => "#SITE_DIR#/personal/company/gallery/edit/#ELEMENT_CODE#/",
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
				"IBLOCK_ID" => $_GET["iBlockId"],
				"IBLOCK_TYPE" => $iBlockType,
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
				"COMPONENT_TEMPLATE" => "editPhotoAlbumInPersonalPage"
			),
			false
		);
	}
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
	//pre($arProps);
?>

	<form name="iblock_add" action="/editelement/" method="POST" id='videoAlbum' enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
		<h1>Добавить альбом</h1>
		<div class="block-default in block-shadow content-margin">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_name">Название альбома*</label>
						<input type="text" class="form-control" id="lk_name" name='PROPERTY[NAME][0]' value="">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_previewText">Подпись к альбому</label>
						<textarea class='form-control maintextarea' id="lk_previewText" name="PROPERTY[PREVIEW_TEXT][0]"></textarea>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="block-default in block-shadow content-margin ">
						<div class="lk_companylogoblock clearfix">
							<div class="lk_companylogoimg floatleft">
								<img src="" border="0" width='400px'>
							</div>
							<div class="lk_companylogotextEditForm">
								<div class="lk_companylogotitle">Обложка альбома:</div>
								<div class="lk_companylogobtn">
									<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="" />
									<input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
									<label for='previewPicture'>
										<div class="btn btn-blue btnplus minbr">
											<span class="plus text-center">+</span>Выбрать изображение
										</div>
									</label>
									<span id='previewPictureFileName'></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id='fileList'>
<?
if (IBLOCK_ID_GALLERY_PHOTO === (int)$_REQUEST['iBlockId'])
{
	_ShowPropertyField(
	'PROPERTY[' . PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO . ']', 
	Array(
		'ID' => PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO,
		//'TIMESTAMP_X' => '2017-05-05 14:45:56',
		'IBLOCK_ID' => IBLOCK_ID_GALLERY_PHOTO,
		'NAME' => 'Изображения',
		'ACTIVE' => 'Y',
		'SORT' => 500,
		'CODE' => 'images',
		'DEFAULT_VALUE' => '',
		'PROPERTY_TYPE' => 'F',
		'ROW_COUNT' => 1,
		'COL_COUNT' => 30,
		'LIST_TYPE' => 'L',
		'MULTIPLE' => 'Y',
		'XML_ID' => '',
		'FILE_TYPE' => '',
		'MULTIPLE_CNT' => 5,
		'TMP_ID' => '',
		'LINK_IBLOCK_ID' => 0,
		'WITH_DESCRIPTION' => 'N',
		'SEARCHABLE' => 'N',
		'FILTRABLE' => 'N',
		'IS_REQUIRED' => 'N',
		'VERSION' => 1,
		'USER_TYPE' => '',
		'USER_TYPE_SETTINGS' => '',
		'HINT' => '',
		'VALUE' => Array(),
		'~VALUE' => Array()
	),
	array(), 
	false, 
	false, 
	50000, 
	'form_name'
	);	


/*
	$id = 'photo';

	for ($n = 0; $n < 10; ++$n)
	{
?>
		<div class="lk_companylogobtn">
			<input type="hidden" name="PROPERTY[<? echo $arProps['images']['ID']; ?>][<? echo $n; ?>]" value="" />
			<input type="file" class='hide fileUpload' id='previewPicture_<? echo $n; ?>' name="PROPERTY_FILE_<? echo $arProps['images']['ID'] . '_' . $n; ?>" />
			<label for='previewPicture_<? echo $n; ?>'>
				<div class="btn btn-blue btnplus minbr">
					<span class="plus text-center">+</span>Выбрать изображение
				</div>
			</label>
			<span id='previewPicture_<? echo $n; ?>FileName'></span>
		</div>
<?	}
*/
}
elseif (IBLOCK_ID_GALLERY_VIDEO === (int)$_REQUEST['iBlockId'])
{
	$id = 'video';
	$videoFilePropertyId = $arProps['videoFile']['ID'];
	$videoLinkPropertyId = $arProps['videoiFrame']['ID'];
?>
	<div class="row">
		<div class="col-xs-12">
			<div class="btn btn-blue btnplus minbr" id='uploadVideo'>
				<span class="plus text-center">+</span>Загрузить видео
			</div>
			<div class="btn btn-blue btnplus minbr" id='insertLink'>
				<span class="plus text-center">+</span>вставить код iFrame
			</div>
		</div>

		<div class="col-xs-12 marginTop15px hide" id='videoLink'>
			<div class="form-group">
				<label class="control-label mainlabel" for="lk_videoLink">Ссылка на видео</label>
				<input type="text" class="form-control" id="lk_videoLink" name='PROPERTY[<? echo $videoLinkPropertyId; ?>][0]' value="">
			</div>
		</div>

		<div class="col-xs-12 lk_companylogobtn marginTop15px hide" id='videoFile'>
			<?
			/*
			<input type="hidden" name="PROPERTY[<? echo $videoFilePropertyId; ?>][0]" value="" />
			<input type="file" name="PROPERTY_FILE_<? echo $videoFilePropertyId;?>_0" />
			<div class="btn btn-blue btnplus minbr">
				<span class="plus text-center">+</span>Выбрать файл
			</div>
			*/
			?>
			<input type="hidden" name="PROPERTY[<? echo $videoFilePropertyId; ?>][0]" value="<? echo $previewPictureId; ?>" />
			<input type="file" class='hide fileUpload' id='videoFileSelect' name="PROPERTY_FILE_<? echo $videoFilePropertyId;?>_0" />
			<label for='videoFileSelect'>
				<div class="btn btn-blue btnplus minbr">
					<span class="plus text-center">+</span>Выбрать файл
				</div>
			</label>
			<span id='videoFileSelectFileName'></span>
		</div>
	</div>
<?
}
?>
</div>
<? /* ?>
		<div class='row'>
			<div class="col-xs-12" >
				<div class="btn btn-blue-full minbr" id='addFileInAlbum'>
					Добавить файл
				</div>
			</div>
		</div>
<? */ ?>
		<div class='hidden' id='photoTemplate'>
			<div class="lk_companylogobtn">
				<input type="hidden" name="PROPERTY[<? echo $arProps['images']['ID']; ?>][<? echo $n; ?>]" value="" id='<? echo $n; ?>' />
				<input type="file" class='hide fileUpload' id='PROPERTY_FILE_<? echo $arProps['images']['ID'] . '_' . $n; ?>' name="PROPERTY_FILE_<? echo $arProps['images']['ID'] . '_' . $n; ?>" />
				<label for='PROPERTY_FILE_<? echo $arProps['images']['ID'] . '_' . $n; ?>'>
					<div class="btn btn-blue btnplus minbr">
						<span class="plus text-center">+</span>Выбрать изображение
					</div>
				</label>
				<span id='PROPERTY_FILE_<? echo $arProps['images']['ID'] . '_' . $n; ?>FileName'></span>
			</div>
		</div>
			<div class="row">
				<div class="col-xs-12 marginTop15px">		
					<? /* ?><div class="submitimg">Сохранить</div><? */ ?>
					<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" />
					<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
					<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
				</div>
			</div>
		</div>
	</div>
	</form>

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

	$('#videoAlbum').on('submit', function()
	{
		if ($('#videoFile').hasClass('active'))
			$('#videoLink').remove();
		else if ($('#videoLink').hasClass('active'))
			$('#videoFile').remove();
		
		// return false;
	});
/*
	document.getElementById('addFileInAlbum').addEventListener('click', function(e){ // Вешаем обработчик клика
		// var id = e.target.id; // Получили ID, т.к. в e.target содержится элемент по которому кликнули
		var elem = document.getElementById('photoTemplate').firstElementChild.cloneNode(true);
		var elemInputId = document.getElementById('photoTemplate').children[0].children[0].id;
		var elemInputName = document.getElementById('photoTemplate').children[0].children[0].name;
		var elemHiddenInputName = document.getElementById('photoTemplate').children[0].children[1].name;
		var index = elemInputName.lastIndexOf('[');

		++elemInputId;
		
		elemInputName = elemInputName.substr(0, index + 1);
		elemInputName += elemInputId + ']';

		index = elemHiddenInputName.lastIndexOf('_');
		elemHiddenInputName = elemHiddenInputName.substr(0, index + 1);
		elemHiddenInputName += elemInputId;

		document.getElementById('photoTemplate').children[0].children[0].id = elemInputId;
		document.getElementById('photoTemplate').children[0].children[0].name = elemInputName;
		document.getElementById('photoTemplate').children[0].children[1].name = elemHiddenInputName;
		document.getElementById('photoTemplate').children[0].children[1].id = elemHiddenInputName;
		document.getElementById('photoTemplate').children[0].children[2].setAttribute('for', elemHiddenInputName);
		document.getElementById('photoTemplate').children[0].children[3].id = elemHiddenInputName + 'FileName';
		document.getElementById('fileList').appendChild(elem);
	});
*/
	$('.addFileInAlbum').on('click', function(){
		var id = $(this).attr('id');
	});
</script>
<?
}
?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>