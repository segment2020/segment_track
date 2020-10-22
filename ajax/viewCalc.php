<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*
if (isset($_POST['id']))
{
	if (CModule::IncludeModule("iblock")) {
		$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_companyId", 'DATE_CREATE');
		// $arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "CODE" => $arResult['VARIABLES']['ELEMENT_CODE']);
		$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "ID" => $_POST['id']);
		$resID = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect)->GetNext();
		if ($resID['ID'] && $resID['IBLOCK_ID']) {
			pre($resID);
			viewsinc($resID['ID'], $resID['IBLOCK_ID'], $resID['PROPERTY_COMPANYID_VALUE'], $resID['DATE_CREATE']);
		}
	}
}
*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");