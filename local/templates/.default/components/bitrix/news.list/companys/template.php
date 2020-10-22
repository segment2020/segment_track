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

//pre($arResult);
?>


<div class="block-default in block-shadow content-margin corpnewsblock">
<?
if($arParams["DISPLAY_TOP_PAGER"])
	echo $arResult["NAV_STRING"] . '<br />';

if (0 !== count($arResult["ITEMS"]))
{
	foreach($arResult["ITEMS"] as $arItem)
	{
		//pre($arItem);
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

		if ($arItem['PREVIEW_PICTURE']['SRC'])
			$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']["ID"], array('width'=>160, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		else
			$file['src'] = EMPTY_IMAGE_PATH;

		$timeStamp = FormatDate("d F Y", MakeTimeStamp($arItem['TIMESTAMP_X']));

		$db_old_groups = CIBlockElement::GetElementGroups($arResult['ITEM']['ID'], false);
		while($ar_group = $db_old_groups->Fetch()) {
			if (1 === (int)$ar_group['IBLOCK_ID'])
				$categoriesString .= $ar_group["NAME"] . ' / ';
		}

		$categoriesString = substr($categoriesString, 0, -3);


		$city = $contactPerson = $userCity = null;
		foreach ($arItem['DISPLAY_PROPERTIES'] as $code => $displayProperty)
		{
			//pre($displayProperty);

			if ('city' == $displayProperty['CODE'])
				$city = $displayProperty['DISPLAY_VALUE'];

			if ('userCity' == $displayProperty['CODE'])
				$userCity = $displayProperty['DISPLAY_VALUE'];

			if ('contactPerson' == $displayProperty['CODE'])
				$contactPerson = $displayProperty['DISPLAY_VALUE'];

			if ((null !== $city) && (null !== $contactPerson))
				break;
		}

		if (null !== $city)
		{
			$city = explode('>', $city);
			$city = explode('<', $city[1]);
			$city = $city[0];
		}
		elseif (null !== $userCity)
			$city = $userCity;


		if (is_array($contactPerson))
		{
			foreach ($contactPerson as $key => $userId)
				$users .= $userId . ' | ';

			$contactPerson = substr($users, 0, -2);
		}


		if (null !== $contactPerson)
		{
			$order = array('sort' => 'asc');
			$arFilter = array('ID' => $contactPerson);
			$tmp = 'sort'; // Параметр проигнорируется методом, но обязан быть.
			$arRes = CUser::GetList($order, $tmp, $arFilter);
			$contactPerson = array();
			while ($res = $arRes->Fetch())
			{
				$tmpArray = array('id' => $res['ID'], 'name' => $res['NAME'] . ' ' . $res['LAST_NAME']);
				array_push($contactPerson, $tmpArray);
			}
		}

		$count = count($contactPerson);
?>

	<div class="newsbitem clearfix companyBlock">
		<div class="newsbimg floatleft">
			<img src="<? echo $file['src']; ?>" class="content-margin" />
			<div class="buttonblock">
				<a class="btn minbr red-blue-full arrowbtn" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
					<span class="arrow text-center"><i class="icon-icons_main-10"></i></span>
					<span class="text">Подробнее</span>
				</a>
			</div>
		</div>
		<div class="companyBlockNewsbtext newsbtext">
			<div class="newsbtitle nofirm"><? echo $arItem['NAME']; ?></div>
			<div class="newsbdescr"><? echo $categoriesString; ?></div>
			<div class="tagblock content-margin">
				<span class="btag">Топ-100: <? echo $arItem['PROPERTIES']['placeInRating']['VALUE']; ?> место</span>
				<span class="gtag">Последнее обновление: <? echo $timeStamp; ?></span>
			</div>
			<div class="companydecrblock clearfix">
			<?
			if ('1' !== $arItem['PROPERTIES']['inModeration']['VALUE'])
			{
			?>
				<div class="companydecritem floatleft">
					<div class="title">Город:</div>
					<div class="link"><? echo $city; ?></div>
				</div>
				<div class="companydecritem floatleft">
					<div class="title">Телефон:</div>
					<div class="link"><? echo $arItem['PROPERTIES']['phone']['VALUE']; ?></div>
				</div>
				<div class="companydecritem floatleft">
					<div class="title">Контактное лицо:</div>
					<div class="link">
<?
						foreach ($contactPerson as $key => $user)
						{
							if ($count > 1)
								echo $user['name'] . ', ';
							else
								echo $user['name'];

							--$count;
						}
?>
					</div>
				</div>
<?			}
			else
			{
?>
				Информация о компании редактируется.
<?
			}
?>
			</div>
		</div>
	</div>
	<div class="seporator"></div>

<?
	}
} // end if (0 !== count($arResult["ITEMS"]))
else
{
	echo '<h4>Компаний не найдено.</h4>';
}
?>
</div>



<?
/*

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
