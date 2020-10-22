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
<?$LINE_ELEMENT_COUNT=2;?>



<div class="mainbxslider">
<?

define (ID_BLOCK_COMPANY, '1');       	  // Компании.
define (ID_BLOCK_NEWS_COMPANY, 2);		  // Новости компании.
define (ID_BLOCK_STOCK, 4);  			  // Акции.
define (ID_BLOCK_NEWS_INDUSTRY, 5); 	  // Новости отрасли.
define (ID_BLOCK_ANALYTICS, 8); 		  // Аналитика.
define (ID_BLOCK_LIFE_INDUSTRY, 9); 	  // Жизнь отрасли.
define (ID_BLOCK_VIEWPOINT, 10); 		  // Точка зрения.
define (ID_BLOCK_EVENTS, 14); 			  // События.
define (ID_BLOCK_PRODUCTS_REVIEW, 15);    // Товарные обзоры.
define (ID_BLOCK_BRANDS, 17); 			  // Бренды.

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
		// pre($arItem, true);

		$res = CIBlockElement::GetByID($arItem['ID']);
		if($obRes = $res->GetNextElement())
		{
			$ar_res = $obRes->GetFields();
			if ($ar_res['PREVIEW_PICTURE']) {
				$pictureId = $ar_res['PREVIEW_PICTURE'];
			} elseif ($ar_res['DETAIL_PICTURE']) {
				$pictureId = $ar_res['DETAIL_PICTURE'];
			} else {
				$pictureId = '';
			}
			$previewText = $ar_res['PREVIEW_TEXT'];
// pre($pictureId);
			if ($pictureId)
				$file = CFile::ResizeImageGet($pictureId, array('width'=>640, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			else
				$file['src'] = '';

			$pictureId = false;
		}

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
		
		$name = $arItem["NAME"];
		if (strlen($arItem["NAME"]) > 106)
			$name = substr($arItem["NAME"], 0, 109) . '...';

		$tmpArray[$elNum] = array('detailUrl' => $detailPageUrl,
								  'imgSrc' => $file['src'],
								  'itemName' => $name,
								  'class' => $class,
								  'blockName' => $arIBlock["NAME"],
								  'dateCreate' => $arItem["DATE_CREATE"]);

		++$elNum;
	}
}

function dateCompare($a, $b)
{
    $time0 = strtotime($a['dateCreate']);
    $time1 = strtotime($b['dateCreate']);

    if ($time0 == $time1)
		return 0;

	return $time0 < $time1 ? 1 : -1;
}
usort($tmpArray, 'dateCompare');

//pre($tmpArray);
//exit();
for ($n = 0; $n < 4; ++$n)
{
?>
	<a href="<? echo $tmpArray[$n]['detailUrl']; ?>" class="mb_item" style="background-image: url('<? echo $tmpArray[$n]['imgSrc']; ?>');">
		<div class="mb_background">
			<div class="mb_preview">
				<? echo $tmpArray[$n]['itemName']; ?>
			</div>
			<div class="infotag <? echo $tmpArray[$n]['class']; ?> blackfont">
				<? echo $tmpArray[$n]['blockName']; ?>
			</div>
		</div>
	</a>
<?
}
?>

</div>

<div class="mb_title">
	<a class="notitlestyle" href="/actualToday/">Актуально сегодня</a>
</div>


<?
/*



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