<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


if (CModule::IncludeModule("iblock")) {
	if (!empty($_POST['iBlockId']))
	{
		// Выберем папки из информационного блока $blockId и раздела $sectionId.
		// $items = GetIBlockElementList($blockId);
		// while ($arItem = $items->GetNext())
			// $string .= '<option value="' . $arItem["ID"] . '">' . $arItem["NAME"] . '</option>';

		// $strSql = "SELECT `ID`, `NAME` FROM `b_iblock_element` WHERE `IBLOCK_ID` = '" . $_POST['iBlockId'] . "' AND `ACTIVE` = 'Y'";
		$strSql = "SELECT `ID`, `NAME` FROM `b_iblock_element` WHERE `IBLOCK_ID` = '" . $_POST['iBlockId'] . "' AND `ACTIVE` = 'Y' AND `NAME` LIKE '%" . $_POST['term'] . "%'";
		$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
		while ($elem = $item->GetNext())
			$string[] = array("id" => $elem["ID"], "label" => $elem["NAME"], "name" => $elem["NAME"]);

		echo json_encode($string);
	}
}
else
   ShowError("Модуль не установлен");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>