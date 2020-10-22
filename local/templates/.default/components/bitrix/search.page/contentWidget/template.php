<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

// pre($arResult);


if (!empty($arResult["SEARCH"])) {

	$blockName = array_shift($arResult['DROPDOWN']);

	$tmp = explode('/', $arResult["SEARCH"][0]['URL']);
	$iBlockUrl = $tmp[1];


	$res = CIBlockElement::GetByID($arResult["SEARCH"][0]["ITEM_ID"]);
	$arItem = $res->GetNext();
	$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>$arItem["IBLOCK_TYPE_ID"], "IBLOCK_ID"=>$arItem['IBLOCK_ID'], 'ID'=>$arResult["SEARCH"][0]["ITEM_ID"]));
	if($obEl = $dbEl->GetNextElement())
		$props = $obEl->GetProperties();

	$first = true;

	foreach($arResult["SEARCH"] as $item)
	{
		$res = CIBlockElement::GetByID($item["ITEM_ID"]);
		$arItem = $res->GetNext();

		if (IBLOCK_ID_GALLERY_PHOTO == $arItem['IBLOCK_ID'])
		{
			$blockName = 'Альбомы';
			$iBlockUrl .= '/photogallery';
		}
		elseif (IBLOCK_ID_GALLERY_VIDEO == $arItem['IBLOCK_ID'])
		{
			$blockName = 'Альбомы';
			$iBlockUrl .= '/videogallery';
		}
		elseif (IBLOCK_ID_NEWS_COMPANY == $arItem['IBLOCK_ID'])
		{
			$iBlockUrl .= '/companynews';
		}

// pre($arItem);
		$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>$arItem["IBLOCK_TYPE_ID"], "IBLOCK_ID"=>$arItem['IBLOCK_ID'], 'ID'=>$item["ITEM_ID"]));
		if($obEl = $dbEl->GetNextElement())
		{   
			$props = $obEl->GetProperties();
// pre($props);
			$res = CIBlockElement::GetByID($props['companyId']['VALUE']);
			$company = $res->GetNext();
			// echo "<pre>";
			// print_r($company);
			// print_r($props);
			// echo "</pre>";
			if (IBLOCK_ID_GALLERY_PHOTO == $arItem['IBLOCK_ID'] || IBLOCK_ID_GALLERY_VIDEO == $arItem['IBLOCK_ID'])
				$arFields = $obEl->GetFields();
		}

		if (isset($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']) && !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']))
			$msgCounter = $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];
		else
			$msgCounter = 0;

		$showCounter = (isset($arItem['SHOW_COUNTER']) && !empty($arItem['SHOW_COUNTER']))? $arItem["SHOW_COUNTER"]: 0;


		$file['src'] = EMPTY_IMAGE_PATH;

		if (IBLOCK_ID_GALLERY_PHOTO != $arItem['IBLOCK_ID'] && IBLOCK_ID_GALLERY_VIDEO != $arItem['IBLOCK_ID'])
		{
			$arFields = array();
			// pre($arItem['PROPERTIES']['showLogo']);
			if (!empty($props['showLogo']['VALUE']))
			{
				if (!empty($arItem['PREVIEW_PICTURE']))
					$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				elseif (!empty($company['ID']))
				{
					if (!empty($company['PREVIEW_PICTURE']))
						$file = CFile::ResizeImageGet($company['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				}
			}

			if ($first)
			{
?>
				<div class="block-default block-shadow content-margin compnewsblock in nobgimg">
				<div class="block-title clearfix">
					<span>
						<a class="bigRed" href="/<? echo $iBlockUrl; ?>/?companyid=<? echo $props['companyId']['VALUE']; ?>">
							<? echo $blockName; ?>
						</a>
					</span>
					<a class="floatright" href="/<? echo $iBlockUrl; ?>/?companyid=<? echo $props['companyId']['VALUE']; ?>">Все <? echo $blockName; ?><i class="icon-icons_main-10"></i></a>
				</div>
				<div class="row">
<?			}
?>
			<div class="col-sm-4 col-xs-12">
				<div class="newsbitem clearfix">
					<div class="newsbimg floatleft nodisp1320">
						<a href="<? echo $item["URL"]; ?>">
							<img src="<? echo $file["src"]; ?>" width='60'>
						</a>
					</div>
					<div class="newsbtext nomarginleft1320">
						<? if ($company['NAME']) 
						{ ?>
							<div class="newsbfirm"><? echo $blockName; ?> компании <? echo $company['NAME']; ?></div>
						<? } ?>
						<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="newsbtitle"><?echo $arItem["NAME"]?></a>
						<div class="infotvc in">
							<span class="infotime"><? echo $arItem["DATE_CREATE"]; ?></span>
							<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($arItem['ID']); ?></span>
							<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
						</div>
					</div>
				</div>
			</div>
	<?
		}
		else
		{
			if ($arItem["PREVIEW_PICTURE"])
				$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>297, 'height'=>120), BX_RESIZE_IMAGE_EXACT, true);

			if (IBLOCK_ID_GALLERY_PHOTO == $arItem['IBLOCK_ID'])
				$titlename = 'Фотоальбом';
			elseif (IBLOCK_ID_GALLERY_VIDEO == $arItem['IBLOCK_ID'])
				$titlename = 'Видеоальбом';

			if ($first)
			{
?>
				<div class="block-default block-shadow content-margin innerphotoblock nobgimg">
				<div class="block-title clearfix">
					<span>
						<a class="bigRed" href="/<? echo $iBlockUrl; ?>/?companyId=<? echo $props['companyId']['VALUE']; ?>">
							<? echo $blockName; ?>
						</a>
					</span>
					<a class="floatright" href="/<? echo $iBlockUrl; ?>/?companyId=<? echo $props['companyId']['VALUE']; ?>">Все <? echo $blockName; ?><i class="icon-icons_main-10"></i></a>
				</div>
				<div class="row">
<?			}
?>
			<div class="col-sm-4 col-xs-12">
				<div class="line">
					<a href="<? echo $item["URL"]; ?>">
						<div class="centerimg" style="background-image: url('<? echo $file["src"]; ?>');">
							<? if ($company['NAME']) 
							{ ?>
								<div class="firmblock"><? echo $titlename; ?> компании <? echo $company['NAME']; ?></div>
							<? } ?>
						</div>
						<div class="bottomtext">
							<div class="infotvc">
								<span class="infotime"><? echo $arItem['DATE_CREATE']; ?></span>
								<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($arItem['ID']); ?></span>
								<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $msgCounter; ?></span>
							</div>
							<div class="titleblock"><? echo $arItem["NAME"]; ?></div>
						</div>
					</a>
				</div>
			</div>
<?
		}

		$first = false;
	}
	?>
	</div>
</div>
<? } ?>