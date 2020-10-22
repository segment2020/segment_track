<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить новинку");
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
	$arFilter = array("IBLOCK_ID" => IBLOCK_ID_NOVETLY, "ACTIVE"=>"Y");
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
		"editNewsInPersonalPage",
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
			"ELEMENT_CODE" => "#SITE_DIR#/personal/company/new/edit/#ELEMENT_CODE#/",
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
			"IBLOCK_ID" => IBLOCK_ID_NOVETLY,
			"IBLOCK_TYPE" => "new",
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
				0 => "newsSource",
				1 => "imgSource",
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
			"COMPONENT_TEMPLATE" => "editNewsInPersonalPage"
		),
		false
	);
}
elseif (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
{
	if (isset($_GET['errorStr'])) { ?>
		<div class="col-xs-9 content-margin" id="article">
			<div class="block-default in block-shadow content-margin">
				<?	echo $_GET['errorStr']; ?>
			</div>
		</div>
<?	} ?>

	<form name="iblock_add" action="/editelement/" method="POST" enctype="multipart/form-data" class='addItemFromPersonalPage'>
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
	<h1>Добавить новинку</h1>
	<div class="block-default in block-shadow content-margin">
		<div class="row">
			<?
			$APPLICATION->IncludeFile('/tpl/include_area/marked.php', array('iBlockId' => $arProps['inTheTop']['IBLOCK_ID'],
																			'code' => $arProps['inTheTop']['CODE'],
																			'propInTopId' => PROPERTY_ID_MARKED_IN_NEWS_NOVETLY,
																			'propMarkedToId' => PROPERTY_ID_MARKED_TO_IN_NEWS_NOVETLY), array());

			//*********************************************************************************************************************************
			$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array(), array());										     
			//*********************************************************************************************************************************

			//*********************************************************************************************************************************
			$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
			//*********************************************************************************************************************************
			?>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_newsSource">Источник новости</label>
					<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arProps['newsSource']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_newsSource">Источник фото</label>
					<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arProps['imgSource']['ID']; ?>][0]' value="">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_imgText">Текст на картинке на детальной странице</label>
					<input type="text" class="form-control" id="lk_imgText" name='PROPERTY[<? echo $arProps['imgString']['ID']; ?>][0]' value="">
				</div>
			</div>

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
					array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
							'previewPictureId' => $arResult["PREVIEW_PICTURE"]["ID"],
							'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
							'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"]),
					array()
				);
			//*********************************************************************************************************************************
			?>
			<div class="col-xs-12">
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
			<div class="seporator lksep"></div>
			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
			<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
			<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
			<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>
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