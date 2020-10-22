<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
/**
 * Bitrix vars
 *
 * @var array $arParams, $arResult
 * @var CBitrixComponentTemplate $this
 * @var CMain $APPLICATION
 * @var CUser $USER
 */
$tabIndex = 1;
?><? if ($arParams['SHOW_MINIMIZED'] == "Y")
{
	?>
	<div class="reviews-collapse reviews-minimized" style='position:relative; float:none;'>
		<a class="reviews-collapse-link" id="sw<?=$arParams["FORM_ID"]?>" onclick="BX.onCustomEvent(BX('<?=$arParams["FORM_ID"]?>'), 'onTransverse')" href="javascript:void(0);"><?=$arParams['MINIMIZED_EXPAND_TEXT']?></a>
	</div>
	<?
}
?>

<div class="block-default block-shadow content-margin addcommentblock">

<a name="review_anchor"></a>
<?
if (!empty($arResult["ERROR_MESSAGE"])):
	$arResult["ERROR_MESSAGE"] = preg_replace(array("/<br(.*?)><br(.*?)>/is", "/<br(.*?)>$/is"), array("<br />", ""), $arResult["ERROR_MESSAGE"]);
	?>
	<div class="reviews-note-box reviews-note-error">
		<div class="reviews-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"], "reviews-note-error");?></div>
	</div>
<?
endif;
?>	
<div class="block-title clearfix">
	<span><?=GetMessage("SEG_LEAVE_A_COMMENT")?></span>
	<span class="links floatright">
		<? if (!$USER->IsAuthorized()) { ?><a href="#regauth-popup" class="auth-popup-link"><?=GetMessage("SEG_TO_COME_IN")?></a>  /  <a href="#regauth-popup" class="reg-popup-link"><?=GetMessage("SEG_SIGN_UP_NOW")?></a>  /  <? } ?><a href="#"><?=GetMessage("SEG_RULES_OF_DISCUSSION")?></a>
	</span>
</div>
<form name="<?=$arParams["FORM_ID"] ?>" id="<?=$arParams["FORM_ID"]?>" action="<?=POST_FORM_ACTION_URI?>#postform"<?
?> method="POST" enctype="multipart/form-data" class="reviews-form">
	<script type="text/javascript">
		BX.ready(function(){
			BX.Forum.Init({
				id : <?=CUtil::PhpToJSObject(array_keys($arResult["MESSAGES"]))?>,
				form : BX('<?=$arParams["FORM_ID"]?>'),
				preorder : '<?=$arParams["PREORDER"]?>',
				pageNumber : <?=intval($arResult['PAGE_NUMBER']);?>,
				pageCount : <?=intval($arResult['PAGE_COUNT']);?>,
				bVarsFromForm : '<?=$arParams["bVarsFromForm"]?>',
				ajaxPost : '<?=$arParams["AJAX_POST"]?>',
				lheId : 'REVIEW_TEXT'
			});
			<? if ($arParams['SHOW_MINIMIZED'] == "Y")
			{
			?>
			BX.addCustomEvent(BX('<?=$arParams["FORM_ID"]?>'), 'onBeforeHide', function() {
				var link = BX('sw<?=$arParams["FORM_ID"]?>');
				if (link) {
					link.innerHTML = BX.message('MINIMIZED_EXPAND_TEXT');
					BX.removeClass(BX.addClass(link.parentNode, "reviews-expanded"), "reviews-minimized");
				}
			});
			BX.addCustomEvent(BX('<?=$arParams["FORM_ID"]?>'), 'onBeforeShow', function() {
				var link = BX('sw<?=$arParams["FORM_ID"]?>');
				if (link) {
					link.innerHTML = BX.message('MINIMIZED_MINIMIZE_TEXT');
					BX.removeClass(BX.addClass(link.parentNode, "reviews-minimized"), "reviews-expanded");
				}
			});
			<?
			}
			?>
		});
	</script>
	<input type="hidden" name="index" value="<?=htmlspecialcharsbx($arParams["form_index"])?>" />
	<input type="hidden" name="back_page" value="<?=$arResult["CURRENT_PAGE"]?>" />
	<input type="hidden" name="ELEMENT_ID" value="<?=$arParams["ELEMENT_ID"]?>" />
	<input type="hidden" name="SECTION_ID" value="<?=$arResult["ELEMENT_REAL"]["IBLOCK_SECTION_ID"]?>" />
	<input type="hidden" name="save_product_review" value="Y" />
	<input type="hidden" name="preview_comment" value="N" />
	<input type="hidden" name="AJAX_POST" value="<?=$arParams["AJAX_POST"]?>" />
	<?=bitrix_sessid_post()?>
	<?
	if ($arParams['AUTOSAVE'])
		$arParams['AUTOSAVE']->Init();
	?>
	<?
	/* GUEST PANEL */
	if (!$arResult["IS_AUTHORIZED"]) 
	{
	?>
		<div class="reviews-reply-fields">
			<div class="reviews-reply-field-user">
				<div class="reviews-reply-field reviews-reply-field-author"><label for="REVIEW_AUTHOR<?=$arParams["form_index"]?>"><?=GetMessage("OPINIONS_NAME")?><?
						?><span class="reviews-required-field">*</span></label>
					<span><input name="REVIEW_AUTHOR" id="REVIEW_AUTHOR<?=$arParams["form_index"]?>" size="30" type="text" value="<?=$arResult["REVIEW_AUTHOR"]?>" tabindex="<?=$tabIndex++;?>" /></span></div>
				<?
				if ($arResult["FORUM"]["ASK_GUEST_EMAIL"]=="Y") 
				{
					?>
					<div class="reviews-reply-field-user-sep">&nbsp;</div>
					<div class="reviews-reply-field reviews-reply-field-email"><label for="REVIEW_EMAIL<?=$arParams["form_index"]?>"><?=GetMessage("OPINIONS_EMAIL")?></label>
						<span><input type="text" name="REVIEW_EMAIL" id="REVIEW_EMAIL<?=$arParams["form_index"]?>" size="30" value="<?=$arResult["REVIEW_EMAIL"]?>" tabindex="<?=$tabIndex++;?>" /></span></div>
				<?
				}
				?>
				<div class="reviews-clear-float"></div>
			</div>
		</div>
	<?
	}


	$currentUserId = $USER->GetID();
    $rsUser = CUser::GetByID($currentUserId); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
    $arUser = $rsUser->Fetch();
    //$arResult["PERSONAL_PHOTO_HTML"] = CFile::ShowImage($arUser["PERSONAL_PHOTO"], 80, 80, "border=0", "", true); //$arUser["PERSONAL_PHOTO"] - тут находится id аватарки, здесь мы получим HTML-код для вывода нужного изображения 
	if (!empty($arUser['PERSONAL_PHOTO']))
		$avatarFile = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
	else
		$avatarFile['src'] = EMPTY_LOGO_AVATAR_PATH;
	?>
	<div class="addcommenttext clearfix">
		<div class="addcommentimg floatleft">
			<img src="<? echo $avatarFile['src']; ?>" />
		</div>
		<div class="addcommenttextarea">
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:main.post.form",
				"",
				Array(
					"FORM_ID" => $arParams["FORM_ID"],
					"SHOW_MORE" => "Y",
					"PARSER" => forumTextParser::GetEditorToolbar(array("forum" => $arResult["FORUM"])),

					"LHE" => array(
						'id' => 'REVIEW_TEXT',
						'bSetDefaultCodeView' => ($arParams['EDITOR_CODE_DEFAULT'] === "Y"),
						'bResizable' => true,
						'bAutoResize' => true,
						"documentCSS" => "body {color:#434343; font-size: 14px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 20px;}",
						'setFocusAfterShow' => false
					),

					"ADDITIONAL" => array(),

					"TEXT" => Array(
						"ID" => "REVIEW_TEXT",
						"NAME" => "REVIEW_TEXT",
						"VALUE" => isset($arResult["REVIEW_TEXT"]) ? $arResult["REVIEW_TEXT"] : "",
						"SHOW" => "Y",
						"HEIGHT" => "200px"),

					"SMILES" => COption::GetOptionInt("forum", "smile_gallery_id", 0),
					"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
		</div>
	</div>
	<?

	/* CAPTHCA */
	if (strLen($arResult["CAPTCHA_CODE"]) > 0) 
	{
		?>
		<div class="reviews-reply-field reviews-reply-field-captcha">
			<input type="hidden" name="captcha_code" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
			<div class="reviews-reply-field-captcha-label">
				<label for="captcha_word"><?=GetMessage("F_CAPTCHA_PROMT")?><span class="reviews-required-field">*</span></label>
				<input type="text" size="30" name="captcha_word" tabindex="<?=$tabIndex++;?>" autocomplete="off" />
			</div>
			<div class="reviews-reply-field-captcha-image">
				<img src="/bitrix/tools/captcha.php?captcha_code=<?=$arResult["CAPTCHA_CODE"]?>" alt="<?=GetMessage("F_CAPTCHA_TITLE")?>" />
			</div>
		</div>
	<?
	}
	?>

	<? /* ?>
	<div class="reviews-reply-buttons">
		<input name="send_button" type="submit" value="<?=GetMessage("OPINIONS_SEND")?>" tabindex="<?=$tabIndex++;?>" <?
		?>onclick="this.form.preview_comment.value = 'N';" />
		<input name="view_button" type="submit" value="<?=GetMessage("OPINIONS_PREVIEW")?>" tabindex="<?=$tabIndex++;?>" <?
		?>onclick="this.form.preview_comment.value = 'VIEW';" />
	</div>
	<? */ ?>
	<div class="addcommentbuttons clearfix">
		<?
		/* SMILES */
		if ($arResult["FORUM"]["ALLOW_SMILES"] == "Y") 
		{
			?>
			<div class="reviews-reply-field-setting">
				<input type="checkbox" name="REVIEW_USE_SMILES" id="REVIEW_USE_SMILES<?=$arParams["form_index"]?>" <?
				?>value="Y" <?=($arResult["REVIEW_USE_SMILES"]=="Y") ? "checked=\"checked\"" : "";?> <?
				?>tabindex="<?=$tabIndex++;?>" /><?
				?>&nbsp;<label for="REVIEW_USE_SMILES<?=$arParams["form_index"]?>"><?=GetMessage("F_WANT_ALLOW_SMILES")?></label></div>
		<?
		}
		/* SUBSCRIBE */
		if ($arResult["SHOW_SUBSCRIBE"] == "Y") 
		{
			?>
			<div class="reviews-reply-field-setting">
				<input type="checkbox" name="TOPIC_SUBSCRIBE" id="TOPIC_SUBSCRIBE<?=$arParams["form_index"]?>" value="Y" <?
				?><?=($arResult["TOPIC_SUBSCRIBE"] == "Y")? "checked disabled " : "";?> tabindex="<?=$tabIndex++;?>" /><?
				?>&nbsp;<label for="TOPIC_SUBSCRIBE<?=$arParams["form_index"]?>"><?=GetMessage("F_WANT_SUBSCRIBE_TOPIC")?></label></div>
		<?
		}
		?>		
	</div>
	<div class="addcommentbuttons clearfix">
		<div class="addfilesblock clearfix floatleft">
			<div class="addfilestitle floatleft"><?=GetMessage("SEG_ATTACH")?></div>
			<?
			/* ATTACH FILES */
			if ($arResult["SHOW_PANEL_ATTACH_IMG"] == "Y") 
			{
				?>
				<div class="reviews-reply-field reviews-reply-field-upload floatleft">
					<?
					$iCount = 0;
					if (!empty($arResult["REVIEW_FILES"])) 
					{
						foreach ($arResult["REVIEW_FILES"] as $key => $val) 
						{
							$iCount++;
							$sFileSize = CFile::FormatSize(intval($val["FILE_SIZE"]));
							?>
							<div class="reviews-uploaded-file">
								<input type="hidden" name="FILES[<?=$key?>]" value="<?=$key?>" />
								<input type="checkbox" name="FILES_TO_UPLOAD[<?=$key?>]" id="FILES_TO_UPLOAD_<?=$key?>" value="<?=$key?>" checked="checked" />
								<label for="FILES_TO_UPLOAD_<?=$key?>"><?=$val["ORIGINAL_NAME"]?> (<?=$val["CONTENT_TYPE"]?>) <?=$sFileSize?>
									( <a href="/bitrix/components/bitrix/forum.interface/show_file.php?action=download&amp;fid=<?=$key?>"><?=GetMessage("F_DOWNLOAD")?></a> )
								</label>
							</div>
						<?
						}
					}
					if ($iCount < $arParams["FILES_COUNT"]) 
					{
						$sFileSize = CFile::FormatSize(intVal(COption::GetOptionString("forum", "file_max_size", 5242880)));
						?>
						<div class="reviews-upload-info" style="display:none;" id="upload_files_info_<?=$arParams["form_index"]?>">
							<?
							if ($arParams["FORUM"]["ALLOW_UPLOAD"] == "F"):
								?>
								<span><?=str_replace("#EXTENSION#", $arParams["FORUM"]["ALLOW_UPLOAD_EXT"], GetMessage("F_FILE_EXTENSION"))?></span>
							<?
							endif;
							?>
							<span><?=str_replace("#SIZE#", $sFileSize, GetMessage("F_FILE_SIZE"))?></span>
						</div>
						<?

						for ($ii = $iCount; $ii < $arParams["FILES_COUNT"]; $ii++) 
						{
							?>

							<div class="reviews-upload-file" style="display:none;" id="upload_files_<?=$ii?>_<?=$arParams["form_index"]?>">
								<input name="FILE_NEW_<?=$ii?>" type="file" value="" size="30" />
							</div>
						<?
						}
						?>
						<div class="file_upload addphoto floatleft">
							<a class="forum-upload-file-attach btn btn-blue" href="javascript:void(0);" onclick="AttachFile('<?=$iCount?>', '<?=($ii - $iCount)?>', '<?=$arParams["form_index"]?>', this); return false;">
								<span class="plus text-center">+</span><?=($arResult["FORUM"]["ALLOW_UPLOAD"]=="Y") ? GetMessage("F_LOAD_IMAGE") : GetMessage("F_ADD_FILE") ?>
							</a>
						</div>
					<?
					}
					?>
				</div>
			<?
			}
			?>			
			
			<? /* ?>
			<div class="file_upload addphoto floatleft">
				<button type="button" class="btn btn-blue"><span class="plus text-center">+</span>Фото</button>
				<input type="file">
			</div>
			
			<div class="file_upload addvideo floatleft">
				<button type="button" class="btn btn-blue"><span class="plus text-center">+</span>Видео</button>
				<input type="file">
			</div>	
			<?*/?>
			
		</div>
		<div class="floatright">
			<button class="btn btn-blue-full" name="send_button" type="submit" onclick="this.form.preview_comment.value = 'N';">
				<?=GetMessage("SEG_LEAVE_A_COMMENT")?><i class="icon-icons_main-10"></i>
			</button>
		</div>
	</div>		
		
		
</form>
<?
if ($arParams['AUTOSAVE'])
	$arParams['AUTOSAVE']->LoadScript(array(
		"formID" => CUtil::JSEscape($arParams["FORM_ID"]),
		"controlID" => "REVIEW_TEXT"
	));
?>
</div>