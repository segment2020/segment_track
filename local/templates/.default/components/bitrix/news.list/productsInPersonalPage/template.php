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


<? if ('OK' == $_GET['msg']) { ?>
	<div class="block-default in block-shadow content-margin corpnewsblock">
		Благодарим вас за размещение материала. Он будет доступен после модерации.
	</div>
<?}?>

<div class='row'>
	<div class="col-xs-12 content-margin">
		<a href="/personal/company/products/edit/?iBlockId=<? echo $arResult['ID']; ?>&iBlockType=<? echo $arResult['IBLOCK_TYPE_ID']; ?>">
			<div class='col-xs-12 btn btn-blue-full minbr'>
				<span class="plus">+</span>
				<?=GetMessage("ADD_ELEMENT")?>
			</div>
		</a>
	</div>
</div>

<?
if ($arParams["DISPLAY_TOP_PAGER"]) {
?>
	<div class="paginationblock clearfix" data-pagination-num="<?=$navParams['NavNum']?>">
		<nav aria-label="Page navigation" class="floatleft">
			<!-- pagination-container -->
			<?=$arResult['NAV_STRING']?>
			<!-- pagination-container -->
		</nav>
		<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
	</div>
<?
}
?>

<div class="hitssecblock">
	<div class="row">
<?
foreach($arResult["ITEMS"] as $arItem) {
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if (!empty($arItem['PREVIEW_PICTURE']))
		$fileImg = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width'=>270, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$fileImg['src'] = '/tpl/images/160х160.jpg';

	$ppID = false;
	$res = CPrice::GetList(array(), array("PRODUCT_ID" => $arItem['ID'], "CATALOG_GROUP_ID" => 1));
	if ($arr = $res->Fetch())
		$price = $arr["PRICE"];


	$hit = '';
	if ('Y' == $arItem['PROPERTIES']['hit']['VALUE'])
		$hit = 'ХИТ';

	$tmp = explode('.', $price);
	if ('00' == $tmp[1])
		$price = number_format($tmp[0], 0, ',', ' ');
?>
		<div class="col-xs-4 content-margin">
			<div class="block-default block-shadow hitssecitem text-center">
				<div class="hitssecimg" style="background-image: url('<? echo $fileImg['src']; ?>');">
					<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"></a>
				</div>
				<div class="hitssectext">
					<div class="hitssecfirm">
						<? echo $hit; ?>
					</div>
					<div class="hitssectitle">
						<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">"<? echo $arItem['NAME']; ?>"</a>
					</div>
					<div class="hitssecfirm">
						<? echo $arItem['DISPLAY_PROPERTIES']['brand']['DISPLAY_VALUE']; ?>
					</div>
					<div class="hitssecprice">
						<? echo $price; ?> <span>руб</span>
					</div>
					<div class="text-center buttonblock">
						<a class="btn minbr btn-blue-full" href="/personal/company/products/edit/?elementId=<? echo $arItem['ID']; ?>">
							<span class="arrow text-center"><i class="icon-icons_main-10"></i></span><span class="text">Редактировать</span>
						</a>
					</div>
				</div>
			</div>
		</div>
<?}?>
	</div>
</div> <!-- end div class="hitssecblock"> -->

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
	<div class="paginationblock clearfix" data-pagination-num="<?=$navParams['NavNum']?>">
		<nav aria-label="Page navigation" class="floatleft">
			<!-- pagination-container -->
			<? echo $arResult['NAV_STRING']; ?>
			<!-- pagination-container -->
		</nav>
		<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['CURRENT_BASE_PAGE'], 'elemNum' => $arParams['PAGE_ELEMENT_COUNT']), array());?>
	</div>
<?  } ?>


<?
/*

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
