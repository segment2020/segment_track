<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление/редактирование баннера");
?>

<div class="container-fluid">
	<div class="row">

<?
$APPLICATION->IncludeFile('/tpl/include_area/personalPageLeftSide.php', array(), array());

$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
?>

<?
if (isset($_REQUEST['elementId']) && !empty($_REQUEST['elementId']))
{
	$APPLICATION->IncludeComponent(
	"wp:news.detail", 
	"editBannersInPersonalPage", 
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
		"ELEMENT_CODE" => "#SITE_DIR#/personal/company/banners/edit/#ELEMENT_CODE#/",
		"ELEMENT_ID" => $_REQUEST["elementId"],
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "SHOW_COUNTER",
			6 => "",
		),
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "banners",
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
			0 => "displayingArea",
			1 => "link",
			2 => "hostingPage",
			3 => "type",
			4 => "imgString",
			5 => "SHOW_COUNTER",
			6 => "",
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
		"COMPONENT_TEMPLATE" => "editBannersInPersonalPage"
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
		<h1>Добавить баннер</h1>
		<? if (isset($_GET['errorStr']) && !empty($_GET['errorStr'])) { ?>
				<div class="block-default in block-shadow content-margin">
					<div class="row">
						<div class="col-xs-12 errorBlock">
							<? echo $_GET['errorStr']; ?>
						</div>
					</div>
				</div>
		<? } ?>

		<div class="block-default in block-shadow content-margin">
			<div class="row">

<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/defaultFields.php', array('titleName' => 'Название баннера', 'name' => $arResult['NAME'], 'previewTextTitle' => 'Описание', 'previewText' => $arResult['PREVIEW_TEXT'], 'detailTextTitle' => 'Описание', 'includePreviewText' => 'false', 'includeDetailText' => 'false', 'detailText' => $arResult['DETAIL_TEXT']), array());
//*********************************************************************************************************************************

//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/dateActiveFrom.php', array('dateActiveFrom' => ''), array());
//*********************************************************************************************************************************
?>

				<div class="col-xs-12">
					<div class="form-group">
						<div class="mycheckbox">
							<label for='lk_hostingPage90'>
								<input name='<? echo 'PROPERTY[' . PROPERTY_ID_HOSTING_PAGE_IN_BANNERS . '][]'; ?>' type="checkbox" value='90>' id='lk_hostingPage90'>
								Показать на главной
							</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12" id="pagesZones">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_place">Зона показа на главной</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_DISPLAY_AREA_IN_BANNERS . ']'; ?>" id="lk_place" tabindex="-98">
							<option value="">-</option>
							<?
								$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'displayingArea'));
								while ($enumFields = $propertyEnums->GetNext()) {
									/*if (false !== strpos($enumFields['VALUE'], 'Главная'))
									{
										$mainArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
										continue;
									}
									else
									{
										$otherArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
									}*/
									?>
									<option value="<? echo $enumFields['ID']; ?>"><? echo $enumFields['VALUE']; ?></option>
							<?	} ?>
						</select>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_hostingPage">Страница размещения</label>
<?
								$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'hostingPage'));
								while ($enumFields = $propertyEnums->GetNext()) {
									if (90 == $enumFields['ID'])
										continue;
?>
									<div class="mycheckbox">
										<label for='lk_hostingPage<? echo $enumFields['ID']; ?>'>
											<input name='<? echo 'PROPERTY[' . PROPERTY_ID_HOSTING_PAGE_IN_BANNERS . '][]'; ?>' type="checkbox" value='<? echo $enumFields['ID']; ?>' id='lk_hostingPage<? echo $enumFields['ID']; ?>'>
											<? echo $enumFields['VALUE']; ?>
										</label>
									</div>
<?
								}
?>
<?
								/*
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_HOSTING_PAGE_IN_BANNERS . ']'; ?>" id="lk_hostingPage" tabindex="-98">
								<option value="">-</option>
								<option value="0">Главная</option>
<?

							// Выберем все активные информационные блоки для текущего сайта
								$res = CIBlock::GetList(array(), array('SITE_ID' => SITE_ID, 'ACTIVE'=>'Y'), true);
								while ($ar_res = $res->Fetch()) {
									if (IBLOCK_ID_CITY == $ar_res['ID'] || IBLOCK_ID_INFOBLOCKS_LIST == $ar_res['ID'] || IBLOCK_ID_BANNERS == $ar_res['ID'])
										continue; ?>
									<option value="<? echo $ar_res['ID']; ?>"><? echo $ar_res['NAME']; ?></option>
<?
								}
?>
								<option value="<? echo PAGE_TOP_100; ?>">Топ 100</option>
								<option value="<? echo PAGE_ACTUAL_TODAY; ?>">Актуально сегодня</option>
						</select>
						*/
						?>
					</div>
				</div>
				<div class="col-xs-12" id="pagesZones">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_place_other">Зона показа на внутренней странице</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_DISPLAY_AREA_OTHER_PAGE_IN_BANNERS . ']'; ?>" id="lk_place_other" tabindex="-98">
							<option value="">-</option>
							<?
								$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'displayingAreaOtherPage'));
								while ($enumFields = $propertyEnums->GetNext()) {
									/*if (false !== strpos($enumFields['VALUE'], 'Главная'))
									{
										$mainArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
										continue;
									}
									else
									{
										$otherArr[] = array('ID' => $enumFields['ID'], 'VALUE' => $enumFields['VALUE']);
									}*/
									?>
									<option value="<? echo $enumFields['ID']; ?>"><? echo $enumFields['VALUE']; ?></option>
							<?	} ?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 hide">
					<select id="mainPageZones" tabindex="-98">
						<?
							foreach ($mainArr as $key => $value) { ?>
								<option value="<? echo $value['ID']; ?>"><? echo $value['VALUE']; ?></option>
						<?	} ?>
					</select>
				</div>
				<div class="col-xs-12 hide">
					<select id="otherPagesZones" tabindex="-98">
						<?
							foreach ($otherArr as $key => $value) { ?>
								<option value="<? echo $value['ID']; ?>"><? echo $value['VALUE']; ?></option>
						<?	} ?>
					</select>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_bannerType">Тип</label>
						<select class="selectpicker selectboxbtn form-control minbr typeselect" name="<? echo 'PROPERTY[' . PROPERTY_ID_TYPE_IN_BANNERS . ']'; ?>" id="lk_bannerType" tabindex="-98">
						<?  
							$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'CODE' => 'type'));
							while ($enumFields = $propertyEnums->GetNext()) {
								?>
								<option value="<? echo $enumFields['ID']; ?>"><? echo $enumFields['VALUE']; ?></option>
						<?	} ?>
						</select>
					</div>
				</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var typeSelect = document.getElementById('lk_bannerType');
	// var pageSelect = document.getElementById('lk_hostingPage');
 
	function changeOption() {
		var selectedOption = typeSelect.options[typeSelect.selectedIndex].text;
		if ('html' == selectedOption)
		{
			document.getElementById('normal').classList.add('hide');
			document.getElementById('html').classList.remove('hide');
		}
		else if ('обычный' == selectedOption)
		{
			document.getElementById('html').classList.add('hide');
			document.getElementById('normal').classList.remove('hide');
		}
	}

	function changeZones() {
		var selectedOption = pageSelect.options[pageSelect.selectedIndex].text;
		if ('Главная' == selectedOption)
		{
			var options = document.getElementById('mainPageZones').innerHTML;
			var current = document.getElementById('lk_place');
			current.options.length = 0;
			current.innerHTML = options;
			$('.selectpicker').selectpicker('refresh');
		}
		else
		{
			var options = document.getElementById('otherPagesZones').innerHTML;
			var current = document.getElementById('lk_place');
			current.options.length = 0;
			current.innerHTML = options;
			$('.selectpicker').selectpicker('refresh');
		}
	}

	typeSelect.addEventListener("change", changeOption);
	// pageSelect.addEventListener("change", changeZones);
});
</script>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="control-label mainlabel" for="lk_link">Ссылка (с http:// или https://)</label>
						<input type="text" class="form-control" id="lk_link" name='PROPERTY[<? echo PROPERTY_ID_LINK_IN_BANNERS; ?>][0]' value="" placeholder='http://ya.ru или https://ya.ru'>
					</div>
				</div>

				<div id='normal'>
<?
//*********************************************************************************************************************************
$APPLICATION->IncludeFile('/tpl/include_area/addPicture.php',
							array('previewPictureSrc' => $arResult["PREVIEW_PICTURE"]["SRC"],
									'previewPictureId' => $arResult['PROPERTIES']["flash"]["ID"],
									'detailPictureSrc' => $arResult["DETAIL_PICTURE"]["SRC"],
									'detailPictureId' => $arResult["DETAIL_PICTURE"]["ID"],
									'title1' => 'Основной баннер (jpg, gif, png, swf (FLASH))',
									'title2' => 'Альтернативный баннер (JPG, Если первый был swf)',
									'page' => 'banners'),
							array());
//*********************************************************************************************************************************
?>
				</div>

				<div id='html' class='hide'>
					<div class="col-xs-12">
						<div class="form-group">
							<label class="control-label mainlabel" for="lk_htmlCode">HTML код</label>
							<textarea class='form-control maintextarea' id="lk_htmlCode" name="PROPERTY[<? echo PROPERTY_ID_HTML_CODE_IN_BANNERS; ?>][0]"></textarea>
						</div>
					</div>
				</div>
			</div>

			<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" id='addElement' />
			<input type="hidden" name="iBlockId" value="<? echo $_GET['iBlockId']; ?>">
			<input type="hidden" name="iBlockType" value="<? echo $_GET['iBlockType']; ?>">
			<div class="errorBlock hide" id='errorText'>Имеются пустые поля</div>
			<div class="errorBlock hide" id='errorPage'>Выберите страницу размещения</div>
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