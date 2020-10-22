<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить событие");
?>
<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 

if (CModule::IncludeModule("iblock"))
{
	$arSelect = array("NAME");
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arUser['UF_ID_COMPANY'], "ACTIVE"=>"Y");
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


<?
	if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
	{
		$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"editEventPersonalPage", 
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
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/events/edit/#ELEMENT_CODE#/",
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
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "Events",
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
			1 => "email",
			2 => "imgString",
			3 => "SHOW_COUNTER",
			4 => "",
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
		"COMPONENT_TEMPLATE" => "editEventPersonalPage"
	),
	false
);
	}
	elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
	{
?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addEventFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
		<h1>Добавить событие</h1>
		<div class="block-default in block-shadow content-margin ">
			<div class="row">
			<?
			//*********************************************************************************************************************************
			$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => '', 'previewText' => '', 'detailText' => ''), array());
			//*********************************************************************************************************************************	

			//*********************************************************************************************************************************
			$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
			//*********************************************************************************************************************************
?>
			</div>
<?
			//*********************************************************************************************************************************
			$APPLICATION->IncludeFile('/tpl/include_area/dateRangeEvent.php',
										array('dateBeginPropId' => $arProps['dateBegin']['ID'],
											'dateBegin' => '',
											'dateEndPropId' => $arProps['dateEnd']['ID'],
											'dateEnd' => '',
											'timePropId' => $arProps['timeBegin']['ID'],
											'time' => '',
											'timeEndPropId' => $arProps['timeEnd']['ID'],
											'timeEnd' => ''),
										array());
			//*********************************************************************************************************************************
			?>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_place">Место проведения события</label>
						<input type="text" class="form-control" id="lk_place" name='PROPERTY[<? echo $arProps['place']['ID']; ?>][0]' value="">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group phoneList">
						<label class="control-label mainlabel" for="lk_phone">Телефон</label>
						<input type="text" class="form-control" id="lk_phone" name='PROPERTY[<? echo $arProps['phone']['ID']; ?>][0]' value="">
					</div>
					<div class="btn btn-blue btnplus minbr addPhone">
						<span class="plus text-center">+</span>Добавить телефон
					</div>

					<div class='hide templatePhone'>
						<input type="text" class="form-control" id="1" name='PROPERTY[<? echo $arProps['phone']['ID']; ?>][1]' value="">
					</div>
				</div>

				<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_site">Сайт (обязательно с http://)</label>
					<input type="text" class="form-control" id="lk_site" name='PROPERTY[<? echo $arProps['site']['ID']; ?>][0]' value="" placeholder='http://exaple.com'>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="registrationLink">Email</label>
					<input type="text" class="form-control" id="registrationLink" name='PROPERTY[<? echo $arProps['email']['ID']; ?>][0]' value="">
				</div>
			</div>
			<?
			/*
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_source">Источник</label>
					<input type="text" class="form-control" id="lk_source" name='PROPERTY[<? echo $arProps['source']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['source']['VALUE']; ?>">
				</div>
			</div>
			*/
			?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_text">Текст на картинке</label>
					<input type="text" class="form-control" id="lk_text" name='PROPERTY[<? echo $arProps['text']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkVK">Ссылка Вконтакте</label>
					<input type="text" class="form-control" id="socialNetworkLinkVK" name='PROPERTY[<? echo $arProps['socialNetworkLinkVK']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkGooglePlus">Ссылка Google+</label>
					<input type="text" class="form-control" id="socialNetworkLinkGooglePlus" name='PROPERTY[<? echo $arProps['socialNetworkLinkGooglePlus']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkTwitter">Ссылка Twitter</label>
					<input type="text" class="form-control" id="socialNetworkLinkTwitter" name='PROPERTY[<? echo $arProps['socialNetworkLinkTwitter']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkInstagram">Ссылка Instagram</label>
					<input type="text" class="form-control" id="socialNetworkLinkInstagram" name='PROPERTY[<? echo $arProps['socialNetworkLinkInstagram']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="socialNetworkLinkFacebook">Ссылка Facebook</label>
					<input type="text" class="form-control" id="socialNetworkLinkFacebook" name='PROPERTY[<? echo $arProps['socialNetworkLinkFacebook']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="registrationLink">Ссылка на регистрацию</label>
					<input type="text" class="form-control" id="registrationLink" name='PROPERTY[<? echo $arProps['registrationLink']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="lk_companylogotextEditForm">
					<div class="lk_companylogotitle">Схема выставки</div>
					<div class="lk_companylogobtn">
						<input type="hidden" name="PROPERTY[<? echo $arProps['schemeExhibitionFile']['ID']; ?>][0]" value="" />
						<input type="file" class='hide fileUpload' id='scheme' name="PROPERTY_FILE_<? echo $arProps['schemeExhibitionFile']['ID']; ?>_0" />
						<label for='scheme'>
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</label>
						<span id='schemeFileName'></span>
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
?>
				<div class="col-xs-12 content-margin">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_companyName">Теги</label>
						<div class='lk_userinfobtn'>
							<?
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"tagsInAddNews",
									array(
										"VALUE" => '',
										"NAME" => "PROPERTY[TAGS][0]",
										"TEXT" => '',
									), null, array("HIDE_ICONS"=>"Y")
								);
							?>
						</div>
					</div>

					<input type="text" class="newTags" id="newTag" value="">
					<div class="btn btn-blue btnplus minbr addTag" id='addNewTag'>
						<span class="plus text-center">+</span>Добавить таг
					</div>
					
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
				</div>
			</div>

			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
			<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
			<div class="previewBlock hide" id='errorText'>Имеются пустые поля</div>
		</div>
		<div class="previewBlock"></div>
	</div>
	</form>
<?
}
?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>