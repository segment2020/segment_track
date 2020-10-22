<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if ($_REQUEST['id']) {
	$id = $_REQUEST['id'];
}
if ($_REQUEST['VOTE_ID']) {
	$id = $_REQUEST['VOTE_ID'];
}

$APPLICATION->IncludeComponent(
	"bitrix:voting.form",
	"currentVotingOnMainForm",
	Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"VOTE_ID" => $id,	// Идентификатор опроса
		"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#",	// Страница для вывода диаграмм результатов опроса
		"COMPONENT_TEMPLATE" => "currentVotingOnMainForm",
		"VOTING_URL" => "/polls/",
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>