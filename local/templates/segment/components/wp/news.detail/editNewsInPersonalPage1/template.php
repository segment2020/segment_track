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
?>

<form name="iblock_add" action="/editelement/?edit=Y&CODE=<? echo $arResult['ID']; ?>" method="POST" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>

	<div class="col-xs-9 content-margin" id="article">
<?
if (isset($_GET['errorStr']) && !empty($_GET['errorStr']))
{
?>
		<div class="block-default in block-shadow content-margin">
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
// pre($arResult);
?>
	<h1><? echo GetMessage('EDIT_NEWS_TITLE'); ?></h1>
	<div class="block-default in block-shadow content-margin ">
		<div class="row">

<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('name' => $arResult['NAME'], 'previewText' => $arResult['PREVIEW_TEXT'], 'detailText' => $arResult['DETAIL_TEXT']), array());
//*********************************************************************************************************************************	

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => $arResult["ACTIVE_FROM"]), array());
//*********************************************************************************************************************************
?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_newsSource">Источник новости</label>
					<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['newsSource']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['newsSource']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_photoSource">Источник фото</label>
					<input type="text" class="form-control" id="lk_photoSource" name='PROPERTY[<? echo $arResult['PROPERTIES']['imgSource']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['imgSource']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_imgText">Текст на картинке</label>
					<input type="text" class="form-control" id="lk_imgText" name='PROPERTY[<? echo $arResult['PROPERTIES']['imgString']['ID']; ?>][0]' value="<? echo $arResult['PROPERTIES']['imgString']['VALUE']; ?>">
				</div>
			</div>

			<div class="col-xs-12">
				<div class="lk_companycatchek">
					<div class="mycheckbox">
					<?
					$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF" => "DESC", "SORT" => "ASC"), array("IBLOCK_ID" => $arResult['IBLOCK_ID'], 'CODE' => $arResult['PROPERTIES']['showLogo']['CODE']));
					if ($enumFields = $propertyEnums->GetNext())
						$propId = $enumFields['ID'];

					$checked = '';
					if (!empty($arResult['PROPERTIES']['showLogo']['VALUE']))
						$checked = 'checked';
					?>
						<label>
							<input type="checkbox" class="" <? echo $checked; ?> name='PROPERTY[<? echo $arResult['PROPERTIES']['showLogo']['ID']; ?>]' value="<? echo $propId; ?>">
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
							array());
//*********************************************************************************************************************************

$APPLICATION->IncludeFile('/tpl/include_area/tags.php', array('value' => $arResult['TAGS'], 'text' => 'size="'.$arResult["PROPERTY_LIST_FULL"]["TAGS"]["COL_COUNT"].'"'), array());

/*
?>

			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="newTag">Теги</label>
					<div class='lk_userinfobtn'>
<?
									$APPLICATION->IncludeComponent(
										"bitrix:search.tags.input",
										"tagsInAddNews",
										array(
											"VALUE" => $arResult['TAGS'],
											"NAME" => "PROPERTY[TAGS][0]",
											"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"]["TAGS"]["COL_COUNT"].'"',
										), null, array("HIDE_ICONS"=>"Y")
									);
?>
					</div>
				</div>

				<input type="text" class="newTags" id="newTag" value="">
				<div class="btn btn-blue btnplus minbr addTag" id='addNewTag'>
					<span class="plus text-center">+</span>Добавить таг
				</div>
			</div>
<?
*/
?>
		</div>

		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='updateElement' />
		<button class="btn btn-blue-full minbr previewbtn">Предварительный просмотр</button>
		<input type="hidden" name="iBlockId" value="<? echo $arResult['IBLOCK_ID']; ?>">
		<input type="hidden" name="iBlockType" value="<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
		<div class="errorBlock hide" id='errorText500'>Анонс публикации более 500 знаков</div>
	</div>
	<div class="previewBlock"></div>
	</div>
</form>

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
 