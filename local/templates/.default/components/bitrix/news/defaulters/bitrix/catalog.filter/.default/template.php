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




$currentPage = $APPLICATION->GetCurPage();
//pre($currentPage);
if ('/defaulters/ex/' == $currentPage)
	$hidden = '<input type="hidden" name="arrFilter_pf[debtIsPaid]" value="1" />';
else
	$hidden = '';
?>
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

	<div class="block-default block-shadow content-margin nonpayersfindblock">
		<div class="table-block">
			<div class="form-group table-text">
				<input type="text" class="form-control" value="<? echo $arResult["ITEMS"]['NAME']['INPUT_VALUE']; ?>" name="arrFilter_ff[NAME]" placeholder="Фильтр по неплательщикам...">
			</div>
			<? echo $hidden; ?>
			<input type='submit' name="set_filter" class="btn red-blue-full minbr table-button marginR20" value="Фильтр">
			<input type="hidden" name="set_filter" value="Y" />
			<input type="submit" name="del_filter" class="btn red-blue minbr table-button" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>">
		</div>
	</div>


	<?
	/*
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" align="center"><?=GetMessage("IBLOCK_FILTER_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top"><?=$arItem["NAME"]?>:</td>
					<td valign="top"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
				<input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
				<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>
		</tr>
	</tfoot>
	</table>
*/
?>
</form>
