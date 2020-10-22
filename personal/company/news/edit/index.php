<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить новость");
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
	if (isset($_GET['iBlockId']) && !empty($_GET['iBlockId']))
	{
		$APPLICATION->IncludeComponent("wp:news.detail", "editNewsInPersonalPage1", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/news/edit/#ELEMENT_CODE#/",	// Код новости
		"ELEMENT_ID" => $_REQUEST["elementId"],	// ID новости
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "TAGS",
			2 => "PREVIEW_TEXT",
			3 => "PREVIEW_PICTURE",
			4 => "DETAIL_TEXT",
			5 => "DETAIL_PICTURE",
			6 => "SHOW_COUNTER",
			7 => "",
		),
		"IBLOCK_ID" => $_GET["iBlockId"],	// Код информационного блока
		"IBLOCK_TYPE" => "News",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Страница",	// Название категорий
		"PROPERTY_CODE" => array(	// Свойства
			0 => "newsSource",
			1 => "imgSource",
			2 => "imgString",
			3 => "SHOW_COUNTER",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа элемента
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
		"COMPONENT_TEMPLATE" => "editNewsInPersonalPage"
	),
	false
);
	}
	else
	{
?>
		<div class="col-xs-3 content-margin" id="article">
			<a href="/personal/company/news?iBlockId=<? echo IBLOCK_ID_NEWS_COMPANY; ?>" class="list-group-item">Новости компании</a>
			<a href="/personal/company/news?iBlockId=<? echo IBLOCK_ID_NEWS_INDUSTRY; ?>" class="list-group-item">Новости отрасли</a>
		</div>
<?
	}
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
	<h1>Добавить новость</h1>
	<div class="block-default in block-shadow content-margin">
		<div class="row">
<?
if (IBLOCK_ID_NEWS_COMPANY == $_GET['iBlockId'])
	$propMarkedToId = PROPERTY_ID_MARKED_TO_IN_NEWS_COMPANY;
else
	$propMarkedToId = PROPERTY_ID_MARKED_TO_IN_NEWS_INDUSTRY;

			$APPLICATION->IncludeFile('/tpl/include_area/marked.php', array('iBlockId' => $arProps['inTheTop']['IBLOCK_ID'],
																			'code' => $arProps['inTheTop']['CODE'],
																			'propInTopId' => $arProps['inTheTop']['ID'],
																			'propMarkedToId' => $propMarkedToId), array());

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
					<label class="control-label mainlabel" for="lk_photoSource">Источник фото</label>
					<input type="text" class="form-control" id="lk_photoSource" name='PROPERTY[<? echo $arProps['imgSource']['ID']; ?>][0]' value="">
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
						<label for='showLogo'>
							<input type="checkbox" id='showLogo' class="" name='PROPERTY[<? echo $arProps['showLogo']['ID']; ?>]' value="<? echo $propId; ?>">
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
					<span class="plus text-center">+</span>Добавить тег
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