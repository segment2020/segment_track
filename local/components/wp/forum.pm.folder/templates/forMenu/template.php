<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if (!$this->__component->__parent || empty($this->__component->__parent->__name)):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/themes/blue/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/styles/additional.css');
endif;
/********************************************************************
				Input params
********************************************************************/
/***************** BASE ********************************************/
$iIndex = rand();
$arResult["FID"] = (is_array($arResult["FID"]) ? $arResult["FID"] : array($arResult["FID"]));

// pre($arResult);
/********************************************************************
				/Input params
********************************************************************/


for ($ii = 1; $ii <= $arResult["FORUM_SystemFolder"]; $ii++):
	if ($arParams["version"] == 2 && $ii == 2)
		continue;

	if ($arResult["SYSTEM_FOLDER"][$ii]["CNT_NEW"] > 0):
?>
		<span class='newMessageMenuCount'><?=$arResult["SYSTEM_FOLDER"][$ii]["CNT_NEW"]?></span>
<?
	endif;
endfor;
