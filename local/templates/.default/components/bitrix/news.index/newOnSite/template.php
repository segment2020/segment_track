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
$index__N_C=0;
$index__STOCK=0;
$index__N_I=0;
$index__A=0;
$index__L_I=0;
$index__V=0;
$index__E=0;
$index__P_R=0;
$index__BRANDS=0;

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
		// pre($arItem);

		if (IBLOCK_ID_COMPANY != $arItem['IBLOCK_ID'])
		{
			$res = CIBlockElement::GetByID($arItem['ID']);
			if ($obRes = $res->GetNextElement())
			{
				// $ar_res = $obRes->GetFields();
				$arProp = $obRes->GetProperties(false, array('CODE' => 'companyId'));
			}
		}

		$pictureId = $arItem['PREVIEW_PICTURE'];
		$previewText = $arItem['PREVIEW_TEXT'];
		$file['src'] = EMPTY_IMAGE_PATH;
/*
		if ($pictureId)
			$file = CFile::ResizeImageGet($pictureId, array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		elseif (!empty($arProp['companyId']['VALUE']))
		{
			// pre($arProp);
			$arSelect = array('PREVIEW_PICTURE');
			$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arProp['companyId']['VALUE']);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
			if ($ob = $res->GetNextElement())
				$arFields = $ob->GetFields();

			if (!empty($arFields['PREVIEW_PICTURE']))
				$file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}

*/
		$file['src'] = EMPTY_IMAGE_PATH;
		$arFields = array();

		if (IBLOCK_ID_COMPANY == $arItem['IBLOCK_ID'] || IBLOCK_ID_STOCK == $arItem['IBLOCK_ID'] || IBLOCK_ID_VIEWPOINT == $arItem['IBLOCK_ID'] || IBLOCK_ID_NEWS_INDUSTRY == $arItem['IBLOCK_ID'] || IBLOCK_ID_NEWS_COMPANY == $arItem['IBLOCK_ID'] || IBLOCK_ID_ANALYTICS == $arItem['IBLOCK_ID'] || IBLOCK_ID_LIFE_INDUSTRY == $arItem['IBLOCK_ID'])
		{
			if (!empty($pictureId))
				$file = CFile::ResizeImageGet($pictureId, array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}
		else
		{  
			$arSelect = array('PREVIEW_PICTURE');
			$arFilter = array("IBLOCK_ID" => IBLOCK_ID_COMPANY, 'ID' => $arProp['companyId']['VALUE']);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect); 
			if ($ob = $res->GetNextElement())
				$arFields = $ob->GetFields();
				  

			if (!empty($arItem['PREVIEW_PICTURE']["ID"])) {
				$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			} elseif (!empty($arFields['PREVIEW_PICTURE'])) {
				$file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);  
			}   
		}
		
		
		
		
		$dateCreate = FormatDate("d F Y", MakeTimeStamp($arItem["DATE_CREATE"]));

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
								  'detailUrl' => $detailPageUrl,
								  'imgSrc' => $file['src'],
								  'class' => $class,
								  'blockName' => $arIBlock["NAME"],
								  'itemName' => $arItem["NAME"],
								  'dateCreate' => $arItem["DATE_CREATE"],
								  'showCounter' => $showCounter,
								  'msgCounter' => $msgCounter);

		++$elNum;
	}
} 

if (!function_exists('date_compare')) {
	function date_compare($a, $b)
	{
		$time0 = strtotime($a['dateCreate']);
		$time1 = strtotime($b['dateCreate']);
	
		if ($time0 == $time1)
			return 0;
	
		return $time0 < $time1 ? 1 : -1;
	}
	usort($tmpArray, 'date_compare');
 } 
?>

<?
foreach ($tmpArray as $key => $value) { ?>
 
    <!--   костыль: 
        минимум 3 "новости компаний"
        максимум 1 "акция"   -->
    <? if ($value["blockName"] == "Акции") {
            $index__STOCK++;
            if ($index__STOCK > 1) { 
                continue;
            } 
        } 

        if ($value["blockName"] == "Новости отрасли") {
            $index__N_I++;
            if ($index__N_I > 2) { 
                continue;
            } 
        } 

        if ($value["blockName"] == "Аналитика") {
            $index__A++;
            if ($index__A > 2) { 
                continue;
            } 
        } 
        
        if ($value["blockName"] == "Жизнь отрасли") {
            $index__L_I++;
            if ($index__L_I > 2) { 
                continue;
            } 
        } 
        
        if ($value["blockName"] == "Точка зрения") {
            $index__V++;
            if ($index__V > 2) { 
                continue;
            } 
        } 
        
        if ($value["blockName"] == "События") {
            $index__E++;
            if ($index__E > 2) { 
                continue;
            } 
        } 
        
        if ($value["blockName"] == "Товарные обзоры") {
            $index__P_R++;
            if ($index__P_R > 2) { 
                continue;
            } 
        } 
        if ($value["blockName"] == "Бренды") {
            $index__BRANDS++;
            if ($index__BRANDS > 2) { 
                continue;
            } 
        }   
    ?>   
    <!-- / костыль -->

	<div class="newsbitem clearfix">
		<a href="<? echo $value["detailUrl"]; ?>">
			<div class="newsbimg floatleft">
				<img src="<? echo $value['imgSrc']; ?>" width='100'>
			</div>
			<div class="newsbtext">
				<div class="infotagfull <? echo $value['class']; ?>">
					<? echo $value["blockName"]; ?>
				</div>
				<div class="newsbtitle">
					<? echo $value["itemName"]; ?>
				</div>
				<div class="infotvc">
					<span class="infotime"><? echo FormatDate("d F Y", MakeTimeStamp($value['dateCreate'])); ?></span>
					<span class="infoview"><i class="icon-icons_main-05"></i><? echo showviews($value['ID']); ?></span>
					<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $value['msgCounter']; ?></span>
				</div>
			</div>
		</a>
	</div>
<?}?>	



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