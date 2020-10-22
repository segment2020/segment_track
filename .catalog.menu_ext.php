<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
global $APPLICATION;	
	
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"segment:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#",
		"IBLOCK_TYPE" => "Catalog",
		"IBLOCK_ID" => IBLOCK_ID_CATALOG,
		"DEPTH_LEVEL" => "4",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"SECTION_URL" => ""
	),
	false
);	

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 
?>