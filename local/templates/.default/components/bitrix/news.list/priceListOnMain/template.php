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

<div class="block-default pricelistblock mainblock block-shadow">
	<div class="block-title clearfix">
		 <a class="notitlestyle" href="<? echo $arResult["SECTION_PAGE_URL"]; ?>"><? echo $arResult['NAME']; ?></a><a class="floatright" href="<? echo $arResult['SECTION_PAGE_URL']; ?>">Все прайс-листы<i class="icon-icons_main-10"></i></a>
	</div>
	<div class="row">
		<? foreach($arResult["ITEMS"] as $arItem) 
		{
			$fileSize = round($arItem['DISPLAY_PROPERTIES']['file']['FILE_VALUE']['SRC'] / 1000);
			$fileSize = (1 > $fileSize)? 1: $fileSize;
		?>
		<div class="col-sm-4 col-xs-12">
			<div class="pricelisttitle">
				 <?=$arItem['DISPLAY_PROPERTIES']['companyID']['DISPLAY_VALUE']?>
			</div>
			<div class="pricelistdown">
				<div class="pricelistimg xls floatleft">
					<a target="_blank" href="<?=$arItem['DISPLAY_PROPERTIES']['file']['FILE_VALUE']['SRC']?>">
						<!--<i class="icon-icons_main-03"></i> -->
						<img src='/tpl/images/excelDownload.svg'>
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