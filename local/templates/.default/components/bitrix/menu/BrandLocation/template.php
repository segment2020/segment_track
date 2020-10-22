<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="block-default block-shadow content-margin traidersbyplace">
	<div class="block-title clearfix"><span>Участники рынка по местоположению</span></div>
		<div class="clearfix">
			<ul class="dropdown-menu tbmmain" role="menu">

			<?
			// pre($arResult);
			// exit();
			$previousLevel = 0;
			foreach($arResult as $arItem):
			// pre($arItem);
			// exit();
			?>

				<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
					<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
				<?endif?>

				<?if ($arItem["IS_PARENT"]):?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="dropdown-submenu"><a href="<? echo $arItem['PARAMS']["FILTER_PAGE"] . '?regionId=' . $arItem['PARAMS']["SECTION_ID"]; ?>"><?=$arItem["TEXT"]?></a>
							<ul class="dropdown-menu">
					<?else:?>
						<li class="dropdown-submenu <?if ($arItem["SELECTED"]):?>item-selected<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
							<ul class="dropdown-menu">
					<?endif?>

				<?else:?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="<? echo $arItem['PARAMS']["FILTER_PAGE"] . '?regionId=' . $arItem['PARAMS']["SECTION_ID"]; ?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="<?if ($arItem["SELECTED"]) {?>item-selected<?}?>
							<? if ($arItem["DEPTH_LEVEL"] == 2) {?>dropdown-submenu<? } ?>"><a href="<? echo $arItem['PARAMS']["FILTER_PAGE"] . '?areaId=' . $arItem['PARAMS']["SECTION_ID"]; ?>"><?=$arItem["TEXT"]?></a>
							<? if ($arItem["DEPTH_LEVEL"] == 2)
							{
								echo '<ul class="dropdown-menu">';
								$arSelect = Array("ID", "NAME");
								$arFilter = Array("IBLOCK_ID"=>7, "SECTION_ID" => $arItem["PARAMS"]["SECTION_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
								$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
								while($ob = $res->GetNext())
								{								
									echo '<li><a href="' . $arItem['PARAMS']["FILTER_PAGE"] . '?cityId=' . $ob['ID'] . '">'.$ob['NAME'].'</a></li>';
								}								
								echo '</ul>';
							}
							?>
						</li>
					<?endif?>

				<?endif?>

				<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

			<?endforeach?>

			<?if ($previousLevel > 1)://close last item tags?>
				<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
			<?endif?>

			</ul>
			<?endif?>
		</div>
	</div>
</div>