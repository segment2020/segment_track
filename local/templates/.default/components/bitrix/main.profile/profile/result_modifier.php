<?php
$position = strpos($arResult['COUNTRY_SELECT'], '\'');

$beginStr = substr($arResult['COUNTRY_SELECT'], 0, $position + 1);
$endStr = substr($arResult['COUNTRY_SELECT'], $position + 1);

$tmpStr = $beginStr . 'selectpicker selectboxbtn form-control minbr ' . $endStr;

$beginStr = substr($tmpStr, 0, 7);
$endStr = substr($tmpStr, 8);

$finalStr = $beginStr . ' data-live-search="true" ' . $endStr;

$arResult['COUNTRY_SELECT'] = $finalStr;
?>