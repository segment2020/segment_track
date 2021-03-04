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

<div class="col-sm-9 col-xs-12 content-margin" id="article">
	<h1><? echo $APPLICATION->sDocTitle;?></h1>  
		<?
		$tmpArray = null; 

		foreach($arResult["IBLOCKS"] as $arIBlock) { 
		
			if ($arIBlock["ID"] == IBLOCK_ID_NEWS_COMPANY || 
				$arIBlock["ID"] == IBLOCK_ID_EVENTS || 
				$arIBlock["ID"] == IBLOCK_ID_PRODUCTS_REVIEW || 
				$arIBlock["ID"] == IBLOCK_ID_NOVETLY)
				$csstag = "newscomptag";
			if ($arIBlock["ID"] == IBLOCK_ID_VIEWPOINT || 
				$arIBlock["ID"] == IBLOCK_ID_STOCK)
				$csstag = "livetag";
			if ($arIBlock["ID"] == IBLOCK_ID_NEWS_INDUSTRY || 
				$arIBlock["ID"] == IBLOCK_ID_ANALYTICS || 
				$arIBlock["ID"] == IBLOCK_ID_LIFE_INDUSTRY)
				$csstag = "newstag";	

			
			$arFilter = Array(
				"IBLOCK_ID"=>IntVal($arIBlock["ID"]),
			);
			$arSelect = Array(
				"ID", 
				"IBLOCK_ID", 
				"CODE", 
				"NAME", 
				"PREVIEW_PICTURE", 
				"PREVIEW_TEXT",  
				"ACTIVE",
				"ACTIVE_FROM", 
				"DATE_CREATE", 
				"DETAIL_PAGE_URL", 
				"SHOW_COUNTER", 
				"PROPERTIES"
			);
			$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, $arSelect, Array ("nTopCount" => $arParams["NEWS_COUNT"])); 
		
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
				$IBlock_res = CIBlock::GetByID($arIBlock["ID"]); 
				if($arIBlock_res = $IBlock_res->GetNext()):  
					$iblock_name = $arIBlock_res["NAME"]; 
					$iblock_url = $arIBlock_res["SECTION_PAGE_URL"]; 
				endif;
				$pictureId 		= $ar_res['PREVIEW_PICTURE'];
				$file 			= CFile::ResizeImageGet($pictureId, array('width'=>100, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$iblock_el_img 	= $file["src"];
				$showCounter 	= (isset($ar_res['SHOW_COUNTER']) && !empty($ar_res['SHOW_COUNTER']))? $ar_res["SHOW_COUNTER"]: 0; 
				$msgCounter 	= !empty($ar_res['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $ar_res['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0; 
				
				$rejMessage = '';

				if ('Y' == $ar_res['PROPERTIES']['rejected']['VALUE']) {
					$status = 'Отклонена';
					$statusblock = 'status_r';
					$rejMessage = $ar_res['PROPERTIES']['reasonRejection']['VALUE']['TEXT'];
					$statusdescr = 'Материал отклонен модератором';
				}
				else
				{ 
					if ('N' == $ar_res['ACTIVE']) {
						$statusblock = 'status_m';
						$status = 'На модерации';
						$statusdescr = 'Материал на проверке у модератора';
					} elseif ('Y' == $ar_res['ACTIVE']) {
						$statusblock = 'status_a';
						$status = 'Активна';
						$statusdescr = 'Материал успешно размещен на портале';
					}
				}
				
				++$elNum;

				$tmpArray[$elNum] = array(
					'ID' 				=> $ar_res["ID"],
					'DETAIL_PAGE_URL' 	=> $ar_res["DETAIL_PAGE_URL"],
					'NAME' 				=> $ar_res["NAME"],
					'IBLOCK_ID' 		=> $ar_res["IBLOCK_ID"], 
					'DATE_CREATE' 		=> $ar_res["DATE_CREATE"],
					'PREVIEW_TEXT'			=> $ar_res["PREVIEW_TEXT"],
					'iblock_name' 		=> $iblock_name,
					'iblock_el_img' 	=> $iblock_el_img,
					'iblock_url'		=> $iblock_url,
					'showCounter' 		=> $showCounter,
					'msgCounter' 		=> $msgCounter,
					'csstag' 			=> $csstag,
					'dateSort' 			=> $date_for_sort,
					'dateDisplay' 		=> $date_for_display,
					'status' 				=> $status,
					'statusblock' 			=> $statusblock,
					'statusdescr' 			=> $statusdescr,
					'rejMessage' 			=> $rejMessage, 
				);   
			} 
			$tmpArray = $tmpArray + $tmpArray;
		}   
		uasort($tmpArray, 'sort_FeedOnMain');
		if (uasort($tmpArray, 'sort_FeedOnMain')) { 
			foreach ($tmpArray as $key => $sorted_arItem) { ?>
				<div class="block-default in block-shadow content-margin corpnewsblock">
					<div class="newsbitem clearfix">
						<div class="secstatusblock <?=$sorted_arItem["statusblock"]?>">
							<div class="secstatusblock_title"><? echo $sorted_arItem["status"]; ?></div>
							<div class="secstatusblock_descr"><? echo $sorted_arItem["statusdescr"]; ?></div>
						</div>
						<? if ($rejMessage) { ?>
						<div class="secrejblock clearfix">
							<? echo $rejMessage; ?>
						</div>
						<? } ?>

						<div class="newsbimg floatleft">
							<img src="<? echo $sorted_arItem['iblock_el_img'] ?>" />
						</div>
						<div class="newsbtext">
							<div class="newsbtitle"><? echo $sorted_arItem["NAME"] ?></div>
							<a class="infotagfull <? echo $sorted_arItem['csstag']?>" href="<? echo $sorted_arItem['iblock_url'] ?>">
								<? echo $sorted_arItem["iblock_name"] ?>
							</a>
							<div class="newsbdescr">
								<?if ($sorted_arItem["PREVIEW_TEXT"])
									echo $sorted_arItem["PREVIEW_TEXT"];
								?>
							</div>
							<div class="infotvc">
								<span class="infotime"><? echo FormatDate("d F Y", MakeTimeStamp($sorted_arItem["dateDisplay"])); ?></span>
								<span class="infoview"><i class="icon-icons_main-05"></i><? echo $sorted_arItem['showCounter']; ?></span>
								<span class="infocomment"><i class="icon-icons_main-04"></i><? echo $sorted_arItem['msgCounter']; ?></span>
							</div>
						</div>
					</div>
					<div class="seporator"></div>
					<div class='textAlignRight'>
						<?
							if ($sorted_arItem['statusblock'] == 'status_a') {
								$res = CIBlockElement::GetByID($arElement["ID"]);
								if ($ar_res = $res->GetNext()) { 					
									?>	
										<a href="<? echo $path; ?>" class="btn btn-blue-full minbr">Просмотреть</a>
									
									<? } else { ?>
										<a href="<? echo $sorted_arItem['DETAIL_PAGE_URL'] ?>" class="btn btn-blue-full minbr">Просмотреть</a>					
									<? }
								} 
						?>
						<a href="/personal/moderation/edit/?elementId=<? echo $sorted_arItem["ID"]; ?>" class="btn btn-blue-full minbr">
							Редактировать
						</a>
					</div>
				</div> <!-- end div class="block-default in block-shadow content-margin corpnewsblock"> -->
				
		<? }} ?> 

</div><!-- end div class="block-default compnewsblock block-shadow"> -->