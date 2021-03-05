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
	$arIBlocks = $arResult['IBLOCKS'];
	console_log($arIBlocks);
?>
<div class="block-title clearfix">
	Новое на сайте 2
</div>

<?
	echo "<h1>Несортированный список</h1> <br />"; 
	foreach($arIBlocks as $arIBlock) { 
		foreach($arIBlock['ITEMS'] as $arItem => $val) { 

			if ($val['ACTIVE_FROM'] == null) {
				$date_for_sort = $val['DATE_CREATE'];   
			  }
			  else { 
				$date_for_sort = $val['ACTIVE_FROM'];   
			  }

			$tmpArray[$elNum] = array('ID' => $val["ID"],
								  'detailUrl' => $detailPageUrl,
								  'imgSrc' => $file['src'],
								  'class' => $class,
								  'blockName' => $arIBlock["NAME"],
								  'itemName' => $val["NAME"],
								  'dateCreate' => $date_for_sort,
								  'showCounter' => $showCounter,
								  'msgCounter' => $msgCounter);
								  ++$elNum;
								   
		} 
	}
	
	foreach ($tmpArray as $key => $value) { ?>
		<div class="newsbitem clearfix">
			<a href="<? echo $value[" detailUrl"]; ?>"> 
				<div class="newsbtext"> 
					<div class="newsbtitle">
						<? echo $value["itemName"]; ?>
					</div> 
				</div>
			</a>
		</div>

<?}  
ksort($tmpArray['dateCreate']); 
echo "<h1>Отсортированный список</h1> <br /> ";
foreach ($tmpArray as $key => $value) { ?>
<div class="newsbitem clearfix">
	<a href="<? echo $value[" detailUrl"]; ?>">
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
				<span class="infotime">
					<? echo FormatDate("d F Y", MakeTimeStamp($value['dateCreate'])); ?></span>
				<span class="infoview"><i class="icon-icons_main-05"></i>
					<? echo showviews($value['ID']); ?></span>
				<span class="infocomment"><i class="icon-icons_main-04"></i>
					<? echo $value['msgCounter']; ?></span>
			</div>
		</div>
	</a>
</div>

<?}?>