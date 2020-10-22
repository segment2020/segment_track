<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
global $APPLICATION;	
	
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"segment:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/company/list/",
		"SECTION_PAGE_URL" => "#SECTION_ID#",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
		"IBLOCK_TYPE" => "City",
		"IBLOCK_ID" => "7",
		"DEPTH_LEVEL" => "4",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"ID" => $_REQUEST["ID"],
		"SECTION_URL" => ""
	),
	false
);	


$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 
?>