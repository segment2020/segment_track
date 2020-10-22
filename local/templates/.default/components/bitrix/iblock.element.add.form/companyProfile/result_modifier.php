<?php
define('PROPERTY_ID_CITY', 16);              // Город.
define('PROPERTY_ID_REGION', 63);            // Регион.
define('PROPERTY_ID_AREA', 64);              // Область.
array_push($arResult["PROPERTY_REQUIRED"], PROPERTY_ID_CITY);
array_push($arResult["PROPERTY_REQUIRED"], PROPERTY_ID_REGION);
array_push($arResult["PROPERTY_REQUIRED"], PROPERTY_ID_AREA);
?>