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
<h1><? echo $arResult['NAME']; ?></h1>
<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft">
<?
	if($arParams["DISPLAY_TOP_PAGER"])
		echo $arResult["NAV_STRING"] . '<br />';
?>
	</nav> 
</div>

<div class="block-default pricelistblock block-shadow content-margin">
<?
$page = $APPLICATION->GetCurPage();
if ('/priceList/' !== $page) { ?>
	<div class="block-title clearfix">
		 <? echo $arResult['NAME']; ?><a class="floatright" href="<? echo $arResult['SECTION_PAGE_URL']; ?>">Все прайс-листы<i class="icon-icons_main-10"></i></a>
	</div>
<?}?>
	<div class="row">
		<? foreach($arResult["ITEMS"] as $arItem) 
		{
			// pre($arItem);
			$fileSize = round($arItem['DISPLAY_PROPERTIES']['file']['FILE_VALUE']['SRC'] / 1000);
			$fileSize = (1 > $fileSize)? 1: $fileSize;
		?>
		<div class="col-xs-4">
			<div class="pricelisttitle">
				 <?=$arItem['DISPLAY_PROPERTIES']['companyID']['DISPLAY_VALUE']?>
			</div>
			<div class="pricelistdown">
				<div class="pricelistimg xls floatleft">
					<a target="_blank" href="<?=$arItem['DISPLAY_PROPERTIES']['file']['FILE_VALUE']['SRC']?>">
						<img src='/tpl/images/excelDownload.svg'>
						<!-- <i class="icon-icons_main-03-svg"></i> -->
					</a>
				</div>
				<div class="pricelisttext">
					<div class="pricelistlink">
						<a target="_blank" href="<?=$arItem['DISPLAY_PROPERTIES']['file']['FILE_VALUE']['SRC']?>">Скачать прайс</a>
					</div>
					<div class="pricelistsize">
						 <? echo $fileSize; ?> Кб
					</div>
				</div>
			</div>
		</div>
		<? } ?>
	</div>
</div>
<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft">
<?
if ($arParams["DISPLAY_BOTTOM_PAGER"])
	echo '<br />' . $arResult["NAV_STRING"];
?>
	</nav>
	<?$APPLICATION->IncludeFile('/tpl/include_area/elementsNumber.php', array('action' => $arParams['SECTION_URL'], 'elemNum' => $arParams['NEWS_COUNT']), array());?>
</div>