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
 
$IBlocksList =  $arParams["SETTINGS_LIST"]; 
$tmpArray = null; 

for ($i = 0; $i <= count($IBlocksList); $i++) {
 
	$arFilter = Array(
		"IBLOCK_ID"=>IntVal($IBlocksList[$i]["iBlock__id"]),  
		"ACTIVE"=>"Y" 
		);
	$arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE", "ACTIVE_FROM", "DATE_CREATE", "DETAIL_PAGE_URL", "SHOW_COUNTER", "PROPERTIES");
	$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, $arSelect, Array ("nTopCount" => $IBlocksList[$i]["iBlock__limit"])); 
 
	while($ob = $res->GetNextElement())
	{   
		$ar_res = $ob->GetFields();
		if ($ar_res["ACTIVE_FROM"] == null) {
			$date_for_sort = strtotime($ar_res["DATE_CREATE"]);
			$date_for_display = $ar_res["DATE_CREATE"];
		}
		else { 
			$date_for_sort = strtotime($ar_res["ACTIVE_FROM"]);
			$date_for_display = $ar_res["ACTIVE_FROM"];  
		}  
		$IBlock_res = CIBlock::GetByID($IBlocksList[$i]["iBlock__id"]); 
		if($arIBlock_res = $IBlock_res->GetNext()):  
			$iblock_name = $arIBlock_res["NAME"]; 
			$iblock_url = $arIBlock_res["SECTION_PAGE_URL"]; 
		endif;
		$pictureId 		= $ar_res['PREVIEW_PICTURE'];
		$file 			= CFile::ResizeImageGet($pictureId, array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$iblock_el_img 	= $file["src"];
		$showCounter 	= (isset($ar_res['SHOW_COUNTER']) && !empty($ar_res['SHOW_COUNTER']))? $ar_res["SHOW_COUNTER"]: 0; 
		$msgCounter 	= !empty($ar_res['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $ar_res['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0; 
		++$elNum;
		$tmpArray[$elNum] = array(
			'ID' 				=> $ar_res["ID"],
			'DETAIL_PAGE_URL' 	=> $ar_res["DETAIL_PAGE_URL"],
			'NAME' 				=> $ar_res["NAME"],
			'IBLOCK_ID' 		=> $ar_res["IBLOCK_ID"], 
			'DATE_CREATE' 		=> $ar_res["DATE_CREATE"],
			'iblock_name' 		=> $iblock_name,
			'iblock_el_img' 	=> $iblock_el_img,
			'iblock_url'		=> $iblock_url,
			'showCounter' 		=> $showCounter,
			'msgCounter' 		=> $msgCounter,
			'csstag' 			=> $IBlocksList[$i]['csstag'],
			'dateSort' 			=> $date_for_sort,
			'dateDisplay' 		=> $date_for_display
		);   
	} 
	$tmpArray = $tmpArray + $tmpArray;
}   
uasort($tmpArray, 'sort_FeedOnMain');
	if (uasort($tmpArray, 'sort_FeedOnMain')) { 
		foreach ($tmpArray as $key => $sorted_arItem) { ?>
	<div class="newsbitem clearfix">
		<div class="newsbimg floatleft">
			<a href="<? echo $sorted_arItem['DETAIL_PAGE_URL'] ?>">
				<img src="<? echo $sorted_arItem['iblock_el_img'] ?>" width="100">
			</a>
		</div>
		<div class="newsbtext">
			<a class="infotagfull <? echo $sorted_arItem['csstag']?>" href="<? echo $sorted_arItem['iblock_url'] ?>">
				<? echo $sorted_arItem["iblock_name"] ?>
			</a>
			<a href="<? echo $sorted_arItem['DETAIL_PAGE_URL'] ?>">
				<div class="newsbtitle">
					<? echo $sorted_arItem["NAME"] ?>
				</div>
				<div class="infotvc">
					<span class="infotime">
						<? echo FormatDate("d F Y", MakeTimeStamp($sorted_arItem["dateDisplay"])); ?>
					</span>
					<span class="infoview"><i class="icon-icons_main-05"></i>
						<? echo $sorted_arItem['showCounter']; ?>
					</span>
					<span class="infocomment"><i class="icon-icons_main-04"></i>
						<? echo $sorted_arItem['msgCounter']; ?>
					</span>
				</div>
			</a>
		</div>
		</a>
	</div>
<?}
}
?>
<!-- end div class="block-default compnewsblock block-shadow"> -->