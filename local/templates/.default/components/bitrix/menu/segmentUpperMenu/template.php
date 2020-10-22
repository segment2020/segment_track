<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>



<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<span><a class="turquoiselink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span>
	<?else:?>
		<span><a class="turquoiselink" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></span>
	<?endif?>
	
<?endforeach?>



<?endif?>