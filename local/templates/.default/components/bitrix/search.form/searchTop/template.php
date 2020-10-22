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
$this->setFrameMode(true);?>



<form class="searchblockform" role="form" action='<?=$arResult["FORM_ACTION"]?>'>
	<div class="input-group searchblock">
		<span class="searchinputblock clearfix">
			<input type="text" class="form-control" name="q" placeholder="Поиск по сайту">
			<button type="submit" name="s" class="searchbutton"><i class="icon-icons_main-14"></i></button>
		</span>
		<select name="where" class="selectpicker selectboxbtn">
			<option value=""><?=GetMessage("SEARCH_ALL")?></option>
			<option value='iblock_News'>Новости</option>
			<option value='iblock_Catalog'>Каталог</option>
			<option value='iblock_Catalog'>Фото / Видео</option>
		</select>
	</div> 
	<div class="btn-mobile-nav visible-xs visible-sm">
		<button title="Close (Esc)" type="button" class="mfp-close" onclick="$('.search-form_top').hide(300);">×</button>
	</div>
</form>





<?
/*
<div class="search-form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<table border="0" cellspacing="0" cellpadding="2" align="center">
		<tr>
			<td align="center"><?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?><?else:?><input type="text" name="q" value="" size="15" maxlength="50" /><?endif;?></td>
		</tr>
		<tr>
			<td align="right"><input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" /></td>
		</tr>
	</table>
</form>
</div>