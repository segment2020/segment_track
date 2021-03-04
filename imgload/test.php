<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$doc = new DomDocument();
@$doc->loadHTML($html);
$xpath = new DOMXPath($doc);
$query = '//*/meta';
$metas = $xpath->query($query);
$rmetas = array();
foreach ($metas as $meta) {
    $property = $meta->getAttribute('property');
    $content = $meta->getAttribute('content');
    if(!empty($property) && preg_match('#^og:#', $property)) {
        $rmetas[$property] = $content;
    }
}
var_dump($rmetas);



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
