<?
$page = $APPLICATION->GetCurPage(false);
$tmp = explode('/', $page);

//$tmp = explode('/', $_SERVER['REQUEST_URI']);

switch ($tmp[1])
{
	case '':
	{
		$hostingPage = 0;
		break;
	}

	case 'company':
	{
		$hostingPage = 91;
		// $hostingPage = IBLOCK_ID_COMPANY;
		break;
	}

	case 'news':
	{
		// if ('companynews' == $tmp[2])
			// $hostingPage = IBLOCK_ID_NEWS_COMPANY;
		// elseif ('industrynews' == $tmp[2])
			// $hostingPage = IBLOCK_ID_NEWS_INDUSTRY;

		if ('companynews' == $tmp[2])
			$hostingPage = 92;
		elseif ('industrynews' == $tmp[2])
			$hostingPage = 95;
		break;
	}

	case 'catalog':
	{
		$hostingPage = 93;
		// $hostingPage = IBLOCK_ID_CATALOG;
		break;
	}

	case 'stock':
	{
		// $hostingPage = IBLOCK_ID_STOCK;
		$hostingPage = 94;
		break;
	}

	case 'analytics':
	{
		// $hostingPage = IBLOCK_ID_ANALYTICS;
		$hostingPage = 97;
		break;
	}

	case 'lifeIndustry':
	{
		// $hostingPage = IBLOCK_ID_LIFE_INDUSTRY;
		$hostingPage = 98;
		break;
	}

	case 'viewpoint':
	{
		// $hostingPage = IBLOCK_ID_VIEWPOINT;
		$hostingPage = 99;
		break;
	}

	case 'photovideo':
	{
		// if ('photogallery' == $tmp[2])
			// $hostingPage = IBLOCK_ID_GALLERY_PHOTO;
		// elseif ('videogallery' == $tmp[2])
			// $hostingPage = IBLOCK_ID_GALLERY_VIDEO;

		if ('photogallery' == $tmp[2])
			$hostingPage = 100;
		elseif ('videogallery' == $tmp[2])
			$hostingPage = 101;
		break;
	}

	case 'events':
	{
		// $hostingPage = IBLOCK_ID_EVENTS;
		$hostingPage = 102;
		break;
	}

	case 'brands':
	{
		// $hostingPage = IBLOCK_ID_BRANDS;
		$hostingPage = 104;
		break;
	}

	case 'license':
	{
		$hostingPage = 105;
		// $hostingPage = IBLOCK_ID_LICENSE;
		break;
	}

	case 'top100':
	{
		// $hostingPage = PAGE_TOP_100;
		$hostingPage = 109;
		break;
	}

	case 'defaulters':
	{
		// $hostingPage = IBLOCK_ID_DEFAULTERS;
		$hostingPage = 96;
		break;
	}

	case 'productsreviews':
	{
		$hostingPage = 103;
		break;
	}

	case 'new':
	{
		// $hostingPage = IBLOCK_ID_NOVETLY;
		$hostingPage = 106;
		break;
	}

	case 'catalogspdf':
	{
		$hostingPage = 107;
		break;
	}

	case 'users':
	{
		$hostingPage = 108;
		break;
	}

	case 'actualToday':
	{
		// $hostingPage = PAGE_ACTUAL_TODAY;
		$hostingPage = 110;
		break;
	}

	case 'hits':
	{
		$hostingPage = 126;
		break;
	}

	default:
		$hostingPage = 0;
}


$count = (int)count($includeArea);

$counter = 0;

$bannersArray = array();

$arSelect = Array('ID', "PROPERTY_companyId", 'PROPERTY_flash', 'PROPERTY_displayingAreaOtherPage');
$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_hostingPage' => $hostingPage, 
	array(
        "LOGIC" => "OR",
        array("PROPERTY_displayingAreaOtherPage" => DA_BODY_CONTENT_OTHER_PAGE),
        array("PROPERTY_displayingAreaOtherPage" => DA_BODY_CONTENT_OTHER_PAGE_LEFT_2),
        array("PROPERTY_displayingAreaOtherPage" => DA_BODY_CONTENT_OTHER_PAGE_LEFT_3),
    ), 
	"ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nTopCount" => ($count - 1)), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	// pre($arFields);
	if (!empty($arFields['PROPERTY_FLASH_VALUE']))
		$file['src'] = CFile::GetPath($arFields["PROPERTY_FLASH_VALUE"]);
	else
		$file['src'] = '';

	if (!empty($arFields["DETAIL_PICTURE"]))
		$fileDet = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=> 330, 'height'=> 80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	else
		$fileDet['src'] = '';

	// viewsinc($arFields['ID'], IBLOCK_ID_BANNERS, $arFields['PROPERTY_COMPANYID_VALUE']);

	if (DA_BODY_CONTENT_OTHER_PAGE == $arFields['PROPERTY_DISPLAYINGAREAOTHERPAGE_ENUM_ID'])
		$index = 0;
	elseif (DA_BODY_CONTENT_OTHER_PAGE_LEFT_2 == $arFields['PROPERTY_DISPLAYINGAREAOTHERPAGE_ENUM_ID'])
		$index = 1;
	elseif (DA_BODY_CONTENT_OTHER_PAGE_LEFT_3 == $arFields['PROPERTY_DISPLAYINGAREAOTHERPAGE_ENUM_ID'])
		$index = 2;

	$bannersArray[$index]['id'] = $arFields['ID'];
	$bannersArray[$index]['fileDet'] = $fileDet['src'];
	$bannersArray[$index]['file'] = $file['src'];
}?>


<?

$APPLICATION->IncludeFile('/tpl/widgets/left/' . $includeArea[$counter] . '.php', array(), array());

$number = count($bannersArray);
for ($i = 0; $i <= $number; ++$i)
{
	// pre($banner);

    if ($bannersArray[$i]['id']) {
?>
		<div class="col-xs-12 content-margin">
			<!--<a href="/banners/?id=<? echo $bannersArray[$i]['id']; ?>" target="_blank" onclick="yaCounter2131294.reachGoal('bannerClick');">-->
			<div id='<? echo $bannersArray[$i]['id']; ?>' class='bannerClick'>
				<?
					if ('' === $bannersArray[$i]['file']) { ?>
						<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[$i]['fileDet']; ?>");'>
						</div>
<?
					} else {
						$ext = substr(strrchr($bannersArray[$i]['file'], '.'), 1);
						if ('swf' == $ext) {
?>
							<div class="infoblock mainBanner">
								<object type="application/x-shockwave-flash" data="<? echo $bannersArray[$i]['file']; ?>" width="310" height="80">
									<param name="move" value="<? echo $bannersArray[$i]['file']; ?>">
								</object>
							</div>
<?
						} else {
?>
							<div class="infoblock altBanner" style='background-image: url("<? echo $bannersArray[$i]['file']; ?>");'>
							</div>
<?
						}
                    }
?>
			<!--</a>-->
			</div>
		</div>
<?
    }

	++$counter;
}

for ($i = $counter; $i < $count; ++$i)
{
	$APPLICATION->IncludeFile('/tpl/widgets/left/' . $includeArea[$i] . '.php', array(), array());
}
?>