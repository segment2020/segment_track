<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


if (CModule::IncludeModule("iblock"))
{
	$blockId = 7;
	$string = '<option></option>';
	if (isset($_REQUEST['sectionId']) && (!empty($_REQUEST['sectionId'])))
	{
		$sectionId = intval($_REQUEST['sectionId']);

		// выберем папки из информационного блока $blockId и раздела $sectionId.
		$items = GetIBlockSectionList($blockId, $sectionId, array("sort"=>"asc"));
		while($arItem = $items->GetNext())
			$string .= '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';

		echo $string;
	}
	elseif (isset($_REQUEST['subSectionId']) && (!empty($_REQUEST['subSectionId'])))
	{
		$subSectionId = intval($_REQUEST['subSectionId']);
		// echo $subSectionId;
		// выберем элементы из папки $ID информационного блока $BID
		$items = GetIBlockElementList($blockId, $subSectionId, Array("name" => "asc"));
		while($arItem = $items->GetNext())
			$string .= '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';

		echo $string;
	}
}
else
   ShowError("Модуль не установлен");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>