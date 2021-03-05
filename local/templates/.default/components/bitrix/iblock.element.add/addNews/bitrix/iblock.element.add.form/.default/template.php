<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);


$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
$arUser = $rsUser->Fetch(); 
$leftSideAvatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>80, 'height'=>80), BX_RESIZE_IMAGE_EXACT, true);
?>

<div class="col-sm-3 col-xs-12 content-margin" id="aside1">
	<div id="getFixed" class="lkmenuslide">
		<div class=" content-margin">
			<div class="block-default block-shadow lk_userinfo clearfix">
				<div class="lk_userinfoimg floatleft">
					<img src="<? echo $leftSideAvatarFile[" src"]; ?>">
				</div>
				<div class="lk_userinfotext">
					<div class="lk_userinfoname">
						<? echo (CUser::GetFirstName())?CUser::GetFirstName():CUser::GetLogin(); ?>
					</div>
					<div class="lk_userinfofirm">
						<div>Генеральный директор</div>
						<div>«Фабер-Кастелл»</div>
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
				<a href="/personal/" class="list-group-item"><img src="/tpl/images/lkmenu1.png">Профиль пользователя</a>
				<a href="#lkmenu1" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu2.png">Профиль компании<i class="floatright icon-icons_main-13"></i></a>
				<div class="submenu collapse" id="lkmenu1">
					<a href="/personal/company/?edit=Y&CODE=<? echo $arResult['ELEMENT']['ID']; ?>" class="list-group-item">Карточка компании</a>
					<a href="/personal/company/addNews" class="list-group-item">Баннеры</a>
					<a href="/personal/company/addNews" class="list-group-item">Новости</a>
					<a href="/personal/" class="list-group-item">Новинки</a>
					<a href="/personal/" class="list-group-item">Акции</a>
					<a href="/personal/" class="list-group-item">Товары/хиты (каталог товаров)</a>
					<a href="/personal/" class="list-group-item">Бренды/лицензии</a>
					<a href="/personal/" class="list-group-item">Прайс-лист</a>
					<a href="/personal/" class="list-group-item">Каталог продукции pdf</a>
					<a href="/personal/" class="list-group-item">Фотогалерея</a>
					<a href="/personal/" class="list-group-item">Видеогалерея</a>
					<a href="/personal/" class="list-group-item">Статьи</a>
					<a href="/personal/" class="list-group-item">Интервью</a>
				</div>
				<a href="#lkmenu2" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu3.png">Подписка на рассылку</a>
				<a href="#lkmenu3" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu4.png">Вопросы в техподддержку</a>
			</div>
		</div>
	</div>
</div>


<form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
	<?= bitrix_sessid_post() ?>

	<div class="col-sm-9 col-xs-12 content-margin" id="article">
		<h1>Добавление новости</h1>
		<?
//pre($arResult);
if ( (!empty($arResult["ERRORS"])) || (strlen($arResult["MESSAGE"]) > 0) )
{
?>
		<div class="block-default in block-shadow content-margin ">
			<div class="block-title clearfix">Уведомления</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<?
						if (!empty($arResult["ERRORS"]))
							ShowError(implode("<br />", $arResult["ERRORS"]));

						if (strlen($arResult["MESSAGE"]) > 0)
							ShowNote($arResult["MESSAGE"]);
?>
					</div>
				</div>
			</div>
		</div>
		<?}?>
		<div class="block-default in block-shadow content-margin ">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<?
								if (in_array('NAME', $arResult["PROPERTY_REQUIRED"]))
									$required = '*';
								else
									$required = '';

								if (strlen($arResult["ELEMENT"]['NAME']) > 0)
									$value = $arResult["ELEMENT"]['NAME'];
								else
									$value = "";
							?>
						<label class="control-label mainlabel" for="lk_name">Заголовок публикации
							<? echo $required; ?></label>
						<input type="text" class="form-control" id="lk_name" name='PROPERTY[NAME][0]' value="<? echo $value; ?>">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<?	
								if (strlen($arResult["ELEMENT"]['PREVIEW_TEXT']) > 0)
									$value = $arResult["ELEMENT"]['PREVIEW_TEXT'];
								else
									$value = "";
?>
						<label class="control-label mainlabel" for="lk_companyName">Анонс публикации</label>
						<textarea class='form-control maintextarea' name="PROPERTY[PREVIEW_TEXT][0]"><? echo $value; ?></textarea>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<?	
								if (strlen($arResult["ELEMENT"]['DETAIL_TEXT']) > 0)
									$value = $arResult["ELEMENT"]['DETAIL_TEXT'];
								else
									$value = "";
?>
						<label class="control-label mainlabel" for="lk_detailText">Полный текст публикации</label>
						<textarea class='form-control maintextarea' id='lk_detailText' name="PROPERTY[DETAIL_TEXT][0]"><? echo $value; ?></textarea>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<?	
								if (strlen($arResult["ELEMENT_PROPERTIES"][3][0]['VALUE']) > 0)
									$value = $arResult["ELEMENT_PROPERTIES"][3][0]['VALUE'];
								else
									$value = "";
?>
						<label class="control-label mainlabel" for="lk_newsSource">Источник новости</label>
						<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[3][0]' value="<? echo $value; ?>">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<?	
								if (strlen($arResult["ELEMENT_PROPERTIES"][95][0]['VALUE']) > 0)
									$value = $arResult["ELEMENT_PROPERTIES"][95][0]['VALUE'];
								else
									$value = "";
?>
						<label class="control-label mainlabel" for="lk_newsSource">Источник фото</label>
						<input type="text" class="form-control" id="lk_newsSource" name='PROPERTY[95][0]' value="<? echo $value; ?>">
					</div>
				</div>

				<div class="lk_companylogoblock clearfix">
					<div class="lk_companylogoimg floatleft">
						<?
								$value = $arResult["ELEMENT"]['PREVIEW_PICTURE'];
								$logoFile = CFile::ResizeImageGet($arResult["ELEMENT_FILES"][$value], array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_EXACT , true);

								if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
								{
									if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
									{
	?>
						<img src="<? echo $logoFile[" src"]; ?>" border="0" />
						<?
									}
								}
	?>
					</div>
					<div class="lk_companylogotext ">
						<div class="lk_companylogotitle">Изображение:</div>
						<div class="lk_companylogobtn">
							<input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $value; ?>" />
							<input type="file" size="<?= $arResult["PROPERTY_LIST_FULL"]['PREVIEW_PICTURE']["COL_COUNT"] ?>" name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
							<div class="btn btn-blue btnplus minbr">
								<span class="plus text-center">+</span>Выбрать изображение
							</div>
						</div>
					</div>
					<div class="seporator lksep"></div>
				</div>

				<!-- <div class="col-xs-12">
							<div class="form-group">
<?	
								// if (strlen($arResult["ELEMENT"]['DETAIL_TEXT']) > 0)
								// 	$value = $arResult["ELEMENT"]['DETAIL_TEXT'];
								// else
								// 	$value = "";
?>
								<label class="control-label mainlabel" for="lk_companyName">Теги</label>
								<div class='lk_userinfobtn'>
<?
									// $APPLICATION->IncludeComponent(
									// 	"bitrix:search.tags.input",
									// 	"tagsInAddNews",
									// 	array(
									// 		"VALUE" => $arResult["ELEMENT"]['TAGS'],
									// 		"NAME" => "PROPERTY[TAGS][0]",
									// 		"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"]["TAGS"]["COL_COUNT"].'"',
									// 	), null, array("HIDE_ICONS"=>"Y")
									// );
?>
								</div>
							</div>
							Этот инпут пригодится  
							 <input type="text" class="newTags" id="newTag" value="">  
							 <div class="btn btn-blue btnplus minbr addTag" id='addNewTag'>
								<span class="plus text-center">+</span>Добавить таг
							</div> -->
			</div>
		</div>

		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" value="Сохранить" class="btn btn-blue-full minbr" />
	</div>
	</div>
</form>

<script type="text/javascript">
	$('#addNewTag').on('click', function() {
		var newTag = $('#newTag').val();
		var existsTags = $('.search-tags').val();
		$('#newTag').val('');
		$('.tagsList').append('<span class="tag btn btn-blue-full minbr">' + newTag + '</span>');
		$('.search-tags').val(existsTags + ', ' + newTag);
	});
</script>


<? -->
/*

<?
if (!empty($arResult["ERRORS"])):?>
<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
	<?= bitrix_sessid_post() ?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?= $arParams["MAX_FILE_SIZE"] ?>" />
	<?endif?>
	<table class="data-table" style="width: 90%">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
			<tr>
				<td>
					<?if (intval($propertyID) > 0):?><?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>
					<?else:?><?= !empty($arParams["CUSTOM_TITLE_" . $propertyID]) ? $arParams["CUSTOM_TITLE_" . $propertyID] : GetMessage("IBLOCK_FIELD_" . $propertyID) ?>
					<?endif?>
					<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span>
					<?endif?>
				</td>
				<td>
					<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br />
					<?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CHTMLEditor;
								$LHE->Show(array(
									'name' => "PROPERTY[".$propertyID."][0]",
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
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
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
					<textarea cols="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>" rows="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] ?>" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= $value ?></textarea>
					<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
					<input type="text" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]" size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>" value="<?= $value ?>" /><br />
					<?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?>
					<?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small>
					<?
								endif
								?><br />
					<?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
					<input type="hidden" name="PROPERTY[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]" value="<?= $value ?>" />
					<input type="file" size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>" name="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>" /><br />
					<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]" id="file_delete_<?= $propertyID ?>_<?= $i ?>" value="Y" /><label for="file_delete_<?= $propertyID ?>_<?= $i ?>"><?= GetMessage("IBLOCK_FORM_FILE_DELETE") ?></label><br />
					<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>" height="<?= $arResult["ELEMENT_FILES"][$value]["HEIGHT"] ?>" width="<?= $arResult["ELEMENT_FILES"][$value]["WIDTH"] ?>" border="0" /><br />
					<?
										}
										else
										{
											?>
					<?= GetMessage("IBLOCK_FORM_FILE_NAME") ?>: <?= $arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"] ?><br />
					<?= GetMessage("IBLOCK_FORM_FILE_SIZE") ?>: <?= $arResult["ELEMENT_FILES"][$value]["FILE_SIZE"] ?> b<br />
					[<a href="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"><?= GetMessage("IBLOCK_FORM_FILE_DOWNLOAD") ?></a>]<br />
					<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
					<input type="<?= $type ?>" name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>" value="<?= $key ?>" id="property_<?= $key ?>" <?= $checked ? " checked=\"checked\"" : "" ?> /><label for="property_<?= $key ?>"><?= $arEnum["VALUE"] ?></label><br />
					<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
					<select name="PROPERTY[<?= $propertyID ?>]<?= $type == "multiselect" ? "[]\" size=\"" . $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] . "\" multiple=\"multiple" : "" ?>">
						<option value="">
							<?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?>
						</option>
						<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
						<option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
						<?
										}
									?>
					</select>
					<?
									break;

								endswitch;
							break;
						endswitch;?>
				</td>
			</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
			<tr>
				<td><?= GetMessage("IBLOCK_FORM_CAPTCHA_TITLE") ?></td>
				<td>
					<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA" />
				</td>
			</tr>
			<tr>
				<td><?= GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT") ?><span class="starrequired">*</span>:</td>
				<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
			</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?= GetMessage("IBLOCK_FORM_SUBMIT") ?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
					<input type="submit" name="iblock_apply" value="<?= GetMessage("IBLOCK_FORM_APPLY") ?>" />
					<input type="button" name="iblock_cancel" value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>" onclick="location.href='<? echo CUtil::JSEscape($arParams[" LIST_URL"])?>';"
					>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>