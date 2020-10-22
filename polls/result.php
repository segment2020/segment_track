<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//$id = $_REQUEST['id'];

if ($_REQUEST['id']) {
	$id = $_REQUEST['id'];
}
if ($_REQUEST['VOTE_ID']) {
	$id = $_REQUEST['VOTE_ID'];
}

$APPLICATION->IncludeComponent(
	"bitrix:voting.result", 
	".default", 
	array(
		"CACHE_TIME" => "1200",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"VOTE_ALL_RESULTS" => "N",
		"VOTE_ID" => $id,
		"QUESTION_DIAGRAM_1" => "-",
		"QUESTION_DIAGRAM_2" => "-"
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>