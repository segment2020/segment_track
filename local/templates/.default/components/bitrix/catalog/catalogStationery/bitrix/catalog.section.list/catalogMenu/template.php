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

$strTitle = "";
?>
<h1>Каталог канцелярских и офисных товаров</h1>
<div class="block-default block-shadow content-margin catalogmain">
	<div class="row">
<?
// pre($arResult);
$topDepth = $arResult["SECTION"]["DEPTH_LEVEL"];
$currentDepth = $topDepth;
$first = true;
$counter = 0;

foreach ($arResult["SECTIONS"] as $arSection) {
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

	// pre($arSection);

	if ($currentDepth > $arSection['DEPTH_LEVEL'] && (2 == $currentDepth)) { ?>
				</div> <!-- end div class="catalogmainallpages cmiclose"> -->
			</div> <!-- end div class="catalogmaintext"> -->
		</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
	}
	elseif ($currentDepth > $arSection['DEPTH_LEVEL'] && (1 == $arSection['DEPTH_LEVEL'])) {
?>
					</div> <!-- end div class="catalogmainsubsec"> -->
				</div> <!-- end div class="catalogmainallpages cmiclose"> -->
			</div> <!-- end div class="catalogmaintext"> -->
		</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
	}
	elseif ($currentDepth > $arSection['DEPTH_LEVEL'] && (2 == $arSection['DEPTH_LEVEL'])) { ?>
			</div> <!-- end div class="catalogmainsubsec"> -->
		</div> <!-- end div class="catalogmainallpages cmiclose"> -->
<?
	}
	elseif ($currentDepth == $arSection['DEPTH_LEVEL'] && (2 == $arSection['DEPTH_LEVEL'])) { ?>
		</div> <!-- end div class="catalogmainallpages cmiclose"> -->
<?
	}
	elseif ($currentDepth == $arSection['DEPTH_LEVEL'] && (1 == $arSection['DEPTH_LEVEL'])) { ?>
			</div> <!-- end div class="catalogmaintext"> -->
		</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
	}

	if (8 == $counter && (1 == $arSection['DEPTH_LEVEL'])) { ?>
		</div> <!-- end div class="col-xs-6"> -->
		<div class="col-sm-6 col-xs-12">
<?	}

	if ($first) { ?>
		<div class="col-sm-6 col-xs-12">
<?		$first = false;
	}

	if (1 == $arSection['DEPTH_LEVEL']) { ?>
		<div class="catalogmainitem clearfix">
			<div class="catalogmainico floatleft">
				<img src="<? echo $arSection['PICTURE']['SRC']; ?>">
			</div>
			<div class="catalogmaintext">
				<div class="catalogmaintitle">
					<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span>
				</div>
<?
		++$counter;
	}
	elseif (2 == $arSection['DEPTH_LEVEL']) { ?>
		<div class="catalogmainallpages cmiclose">
			<div class="catalogmainsubtitle">
				<span class="catalogmainopen text-center">+</span><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><span class="num">(<? echo $arSection['ELEMENT_CNT']; ?>)</span>
			</div>
<?
	}
	elseif (3 == $arSection['DEPTH_LEVEL']) {
		if ($currentDepth != $arSection['DEPTH_LEVEL']) { ?>
			<div class="catalogmainsubsec">
<?		} ?>
				<div><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><span class="num">(<? echo $arSection['ELEMENT_CNT']; ?>)</span></div>
<?	}

// pre('sec_' . $arSection['DEPTH_LEVEL']);
// pre('cur_' . $currentDepth);
	$currentDepth = $arSection['DEPTH_LEVEL'];
} // end foreach ($arResult["SECTIONS"] as $arSection) {

if (1 == $currentDepth) { ?>
		</div> <!-- end div class="catalogmaintext"> -->
	</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
}
elseif (2 == $currentDepth) { ?>
			</div> <!-- end div class="catalogmainallpages cmiclose"> -->
		</div> <!-- end div class="catalogmaintext"> -->
	</div> <!-- end div class="catalogmainitem clearfix"> -->
<?
}
elseif (2 == $currentDepth) { ?>

				</div> <!-- end div class="catalogmainsubsec"> -->
			</div> <!-- end div class="catalogmainallpages cmiclose"> -->
		</div> <!-- end div class="catalogmaintext"> -->
	</div> <!-- end div class="catalogmainitem clearfix"> -->
<?}?>

		</div> <!-- end div class="col-xs-6"> -->
	</div> <!-- end div class="row"> -->
</div>



<?
/*

<div class="catalog-section-list">
	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult["SECTIONS"] as $arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
		{
			echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul>";
		}
		elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
		}
		else
		{
			while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
				$CURRENT_DEPTH--;
			}
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
		}

		$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

		if ($_REQUEST['SECTION_ID']==$arSection['ID'])
		{
			$link = '<b>'.$arSection["NAME"].$count.'</b>';
			$strTitle = $arSection["NAME"];
		}
		else
		{
			$link = '<a href="'.$arSection["SECTION_PAGE_URL"].'">'.$arSection["NAME"].$count.'</a>';
		}

		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
		?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$link?><?

		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	}

	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
		$CURRENT_DEPTH--;
	}
	?>
</div>
<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
