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
?>


<?
$frame = $this->createFrame("subscribe-form", false)->begin();
?>
<div class="block-default in block-shadow content-margin">
	<form action="<?=$arResult["FORM_ACTION"]?>" method='POST'>
		<!--<div class="block-title clearfix">Доступные рубрики</div>-->
		<div class="row">
		<?
		/*
			<div class="col-xs-12">
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
					<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
						<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
					</label><br />
				<?endforeach;?>
			</div>
			*/
			?>
			<div class="col-xs-6">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_email"><? echo GetMessage("subscr_form_email_title"); ?></label>
					<input type="text" class="form-control" id="lk_email" name='sf_EMAIL' value="<? echo $arResult["EMAIL"]; ?>" title="<?=GetMessage("subscr_form_email_title")?>">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="seporator lksep"></div>
				<input type="hidden" name="sub" value="OK">
				<input type="submit" name="OK" value="<? echo GetMessage("subscr_form_button"); ?>" class="btn btn-blue-full minbr" />
			</div>
		</div>
	</form>
</div>
<?
$frame->beginStub();
?>
<div class="block-default in block-shadow content-margin">
	<form action="<?=$arResult["FORM_ACTION"]?>">
		<!--<div class="block-title clearfix">Доступные рубрики</div>-->
		<div class="row">
				<?
		/*
			<div class="col-xs-12">
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
					<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
						<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" /> <?=$itemValue["NAME"]?>
					</label><br />
				<?endforeach;?>
			</div>
			*/
			?>
			<div class="col-xs-6">
				<div class="form-group">
					<label class="control-label mainlabel" for="lk_email"><? echo GetMessage("subscr_form_email_title"); ?></label>
					<input type="text" class="form-control" id="lk_email" name='sf_EMAIL' value="<? echo $arResult["EMAIL"]; ?>" title="<?=GetMessage("subscr_form_email_title")?>">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="seporator lksep"></div>
				<input type="submit" name="OK" value="<? echo GetMessage("subscr_form_button"); ?>" class="btn btn-blue-full minbr" />
			</div>
		</div>
	</form>
</div>
<?
$frame->end();
?>




<?
/*

<div class="subscribe-form"  id="subscribe-form">
<?
$frame = $this->createFrame("subscribe-form", false)->begin();
?>
	<form action="<?=$arResult["FORM_ACTION"]?>">

	<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
			<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
		</label><br />
	<?endforeach;?>

		<table border="0" cellspacing="0" cellpadding="2" align="center">
			<tr>
				<td><input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" /></td>
			</tr>
			<tr>
				<td align="right"><input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
			</tr>
		</table>
	</form>
<?
$frame->beginStub();
?>
	<form action="<?=$arResult["FORM_ACTION"]?>">

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
				<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" /> <?=$itemValue["NAME"]?>
			</label><br />
		<?endforeach;?>

		<table border="0" cellspacing="0" cellpadding="2" align="center">
			<tr>
				<td><input type="text" name="sf_EMAIL" size="20" value="" title="<?=GetMessage("subscr_form_email_title")?>" /></td>
			</tr>
			<tr>
				<td align="right"><input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
			</tr>
		</table>
	</form>
<?
$frame->end();
?>
</div>
