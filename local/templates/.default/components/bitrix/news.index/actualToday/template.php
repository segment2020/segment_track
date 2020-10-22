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

// pre($arResult);
?>


<h1>Актуальное сегодня</h1>
<div class="paginationblock clearfix">
	<nav aria-label="Page navigation" class="floatleft">
<?
	if($arParams["DISPLAY_TOP_PAGER"])
		echo $arResult["NAV_STRING"] . '<br />';
?>
	</nav> 
</div>
<div class="block-default in block-shadow content-margin corpnewsblock">

<?
$tmpArray = array();
$elNum = 0;

foreach($arResult["IBLOCKS"] as $arIBlock)
{
	switch ($arIBlock['ID'])
	{
		case ID_BLOCK_COMPANY:
		case ID_BLOCK_STOCK:
		case ID_BLOCK_VIEWPOINT:
		{
			$class = 'livetag';
			break;
		}

		case ID_BLOCK_NEWS_INDUSTRY:
		case ID_BLOCK_ANALYTICS:
		case ID_BLOCK_LIFE_INDUSTRY:
		{
			$class = 'newstag';
			break;
		}

		case ID_BLOCK_NEWS_COMPANY:
		case ID_BLOCK_EVENTS:
		case ID_BLOCK_PRODUCTS_REVIEW:
		case ID_BLOCK_BRANDS:
		{
			$class = 'newscomptag';
			break;
		}

		default:
			$class = 'newstag';
	}

	foreach($arIBlock["ITEMS"] as $arItem)
	{
		$res = CIBlockElement::GetByID($arItem['ID']);
		if($obRes = $res->GetNextElement())
		{
			$ar_res = $obRes->GetFields();
			$pictureId = $ar_res['PREVIEW_PICTURE'];
			$previewText = $ar_res['PREVIEW_TEXT'];

			if ($pictureId)
				$file = CFile::ResizeImageGet($pictureId, array('width'=>160, 'height'=>160), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			else
				$file['src'] = '';

			$pictureId = false;
		}

		$showCounter = (isset($arItem['SHOW_COUNTER']) && !empty($arItem['SHOW_COUNTER']))? $arItem["SHOW_COUNTER"]: 0;

		$msgCounter = !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

		$detailPageUrl = $arItem["DETAIL_PAGE_URL"];

		if (IBLOCK_ID_EVENTS == $arItem['IBLOCK_ID'])
		{			
			if (strtotime(date('d.m.Y')) <= strtotime($arItem['PROPERTIES']['dateBegin']['VALUE']))
				$link = '/futureevents/';
			else
				$link = '/pastevents/';

			$tmp = explode('/', $arItem["DETAIL_PAGE_URL"]);
			$detailPageUrl = '/' . $tmp[1] . $link . $tmp[2] . '/';
		}

		$tmpArray[$elNum] = array('ID' => $arItem["ID"],
								  'previewText' => $previewText,
								  'detailUrl' => $detailPageUrl,
								  'imgSrc' => $file['src'],
								  'itemName' => $arItem["NAME"],
								  'dateCreate' => $arItem["DATE_CREATE"],
								  'showCounter' => $showCounter,
								  'msgCounter' => $msgCounter);

		++$elNum;
	}
}

function date_compare($a, $b)
{
    $time0 = strtotime($a['dateCreate']);
    $time1 = strtotime($b['dateCreate']);

    if ($time0 == $time1)
		return 0;

	return $time0 < $time1 ? 1 : -1;
}
usort($tmpArray, 'date_compare');


foreach ($tmpArray as $key => $value) { ?>
	<div class="newsbitem clearfix">
		<a href="<? echo $value["detailUrl"]; ?>">
			<div class="newsbimg floatleft">
				<?if ('' !== $value['imgSrc']){?>
					<img src="<? echo $value['imgSrc']; ?>" />
				<?}?>
			</div>
			<div class="newsbtext">
				<div class="newsbtitle"><? echo $value["itemName"]; ?></div>
				<div class="newsbdescr">
					<?if (isset($value['previewText']) && !empty($value['previewText']))
						echo $value['previewText']; ?>
				</div>
				<div class="infotvc">
					<span class="infotime"><? echo FormatDate("d F Y", MakeTimeStamp($value['dateCreate'])); ?></span>
					<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($value['ID']); ?></span>
					<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $value['msgCounter']; ?></span>
				</div>
			</div>
		</a>
	</div>
	<div class="seporator"></div>
<?
}
?>

</div>


<?
// Старый default шаблон...
/*

<?$LINE_ELEMENT_COUNT=2;?>
<div class="news-index">
<table cellpadding="10" cellspacing="0" border="0" width="100%">
	<tr>
<?
$cell = 0;
foreach($arResult["IBLOCKS"] as $arIBlock):?>
		<td valign="top" width="<?=round(100/$LINE_ELEMENT_COUNT)?>%">
			<table class="data-table" cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead>
				<?
				$this->AddEditAction('iblock_'.$arIBlock['ID'], $arIBlock['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arIBlock["ID"], "ELEMENT_ADD"));
				?>
				<tr valign="top" id="<?=$this->GetEditAreaId('iblock_'.$arIBlock['ID']);?>">
					<td colspan="2"><a href="<?=$arIBlock["LIST_PAGE_URL"]?>"><?=$arIBlock["NAME"]?></a></td>
				</tr>
			</thead>
				<?foreach($arIBlock["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNI_ELEMENT_DELETE_CONFIRM')));
				?>
				<tr valign="top" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<td class="news-date-time" style="border:0" nowrap id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?=$arItem["DISPLAY_ACTIVE_FROM"]?>&nbsp;
					</td>
					<td style="border:0">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>&nbsp;
					</td>
				</tr>
				<?endforeach;?>
			</table>
		</td>
	<?
	if((++$cell)>=$LINE_ELEMENT_COUNT):
		$cell = 0;
	?></tr><tr><?
	endif; // if($n%$LINE_ELEMENT_COUNT == 0):
endforeach;
		while ($cell<$LINE_ELEMENT_COUNT):
			$cell++;
		?><td>&nbsp;</td><?
		endwhile;
		?>
	</tr>
</table>
</div>