<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)) {
	$previousLevel = 0;
	$first = true;
	foreach ($arResult as $arItem) {
		if ($first) { ?>
			<div class="col-xs-6">
<?			$first = false;
		}
// pre($arItem);

$res = CIBlockSection::GetByID($arItem['PARAMS']['SECTION_ID']); 
if ($ar_res = $res->GetNext())
{
	// pre($ar_res);
	$src = CFile::GetPath($ar_res['PICTURE']);
}
	
		if ($arItem["IS_PARENT"]) {
			if ($arItem["DEPTH_LEVEL"] == 1) { ?>
				<div class="catalogmainitem clearfix">
					<div class="catalogmainico floatleft">
						<img src="<? echo $src; ?>">
					</div>
					<div class="catalogmaintext">
						<div class="catalogmaintitle"><a href="#">Школьные принадлежности</a><span>(2341)</span></div>
						<div class="catalogmainallpages cmiclose">
						
						</div> <!-- end div class="catalogmainallpages cmiclose"> -->
					</div> <!-- end div class="catalogmaintext"> -->
				</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
			}
		}
	} // end foreach($arResult as $arItem)
}?>











<?if (!empty($arResult)):?>
<ul id="vertical-multilevel-menu">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="root-item">
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>