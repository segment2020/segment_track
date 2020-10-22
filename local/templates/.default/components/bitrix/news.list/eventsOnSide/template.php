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

<div class="block-title clearfix">
    <a class="notitlestyle" href="<? echo $arResult["SECTION_PAGE_URL"]; ?>">События</a>
</div>
<?
 //pre($arResult);

 $counter = 0;
$monthsName = array('01' => 'январь',
    '02' => 'февраль',
    '03' => 'март',
    '04' => 'апрель',
    '05' => 'май',
    '06' => 'июнь',
    '07' => 'июль',
    '08' => 'август',
    '09' => 'сентябрь',
    '10' => 'октябрь',
    '11' => 'ноябрь',
    '12' => 'декабрь');

foreach($arResult["ITEMS"] as $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	$tmp = explode(' ', $arItem["DATE_CREATE"]);
	$dateCreate = $tmp[0];

	$arSelect = Array("SHOW_COUNTER");
	$arFilter = Array("IBLOCK_ID"=>IntVal($arItem['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

	$showCounter = (isset($arItem['SHOW_COUNTER']) && !empty($arItem['SHOW_COUNTER']))? $arItem["SHOW_COUNTER"]: 0;

	$msgCounter = !empty($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])? $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']: 0;

	if (!empty($arItem['PROPERTIES']['timeBegin']['VALUE']))
		$timeBegin = substr($arItem['PROPERTIES']['timeBegin']['VALUE'], 0, -3);
	else
		$timeBegin = '';

	if (!empty($arItem['PROPERTIES']['dateBegin']['VALUE']))
	{
		$dayBegin = ConvertDateTime($arItem['PROPERTIES']['dateBegin']['VALUE'], "DD", "ru");
		$monthBeginNum = ConvertDateTime($arItem['PROPERTIES']['dateBegin']['VALUE'], "MM", "ru");
	}

	if (strtotime($arItem['PROPERTIES']['dateEnd']['VALUE']) >= strtotime(date('Y-m-d')))
		$path = $arResult['SECTION_PAGE_URL'] . 'futureevents/' . $arItem['CODE'] . '/';
	else
		$path = $arResult['SECTION_PAGE_URL'] . 'pastevents/' . $arItem['CODE'] . '/';

	$name = $arItem["NAME"];
	if (100 < strlen($name))
        $name = substr($name, 0, 77) . '...';
        if ( (0 === $counter) || (0 === ($counter % 2)) )
        {
    ?>
            <div class="row">
    <?	}
    ?>
<div class="newsbitem clearfix col-xs-12">
    <a href="<? echo $path; ?>">
        <div class="newsbimg weekend floatleft">
            <div class="calendtop text-center">
                <? echo $monthsName[$monthBeginNum]; ?>
            </div>
            <div class="calendbottom text-center">
                <? echo $dayBegin; ?>
            </div>
        </div>
        <div class="newsbtext">
            <div class="newsbtitle">
                <? echo $name; ?>
            </div>
            <div class="infotvc nodisp1320">
                <span class="infotime">
                    <? echo $dateCreate; ?></span>
                <span class="infoview"><i class="icon-icons_main-05"></i>
                    <? echo showviews($arItem['ID']); ?></span>
                <span class="infocomment"><i class="icon-icons_main-04"></i>
                    <? echo $msgCounter; ?></span>
            </div>
        </div>
    </a> 
</div>
<?	if (0 !== ($counter % 2))
	{		
?>
		</div> <!-- end div class="row"> -->
		<div class="seporator">
		</div>
<?	}

	++$counter;
}?>

<?
	if (0 !== ($itemsNumber % 2))
	{
?>
		</div> <!-- end div class="row"> -->
<?	}
?>

<div class="text-center buttonblock">
    <a class="btn btn-blue" href="<? echo $arResult["SECTION_PAGE_URL"]; ?>">Все события<i class="icon-icons_main-10"></i></a>
</div>



<?
/*
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
<?= $arResult["NAV_STRING"] ?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<p class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img class="preview_picture" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" /></a>
    <?else:?>
    <img class="preview_picture" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" />
    <?endif;?>
    <?endif?>
    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
    <span class="news-date-time">
        <?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
    <?endif?>
    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
    <a href="<?echo $arItem[" DETAIL_PAGE_URL"]?>"><b>
            <?echo $arItem["NAME"]?></b></a><br />
    <?else:?>
    <b>
        <?echo $arItem["NAME"]?></b><br />
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
        <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
    </small><br />
    <?endforeach;?>
    <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
    <small>
        <?= $arProperty["NAME"] ?>:&nbsp;
        <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
        <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
        <?else:?>
        <?= $arProperty["DISPLAY_VALUE"]; ?>
        <?endif?>
    </small><br />
    <?endforeach;?>
</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
<br /><?= $arResult["NAV_STRING"] ?>
<?endif;?>
</div>