<?
$page = $APPLICATION->GetCurPage(false);
$tmp = explode('/', $page);

switch ($tmp[1])
{
	case '':
	{
		$hostingPage = 90;
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

	case 'actualToday':
	{
		// $hostingPage = PAGE_ACTUAL_TODAY;
		$hostingPage = 110;
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

	default:
		$hostingPage = 0;
}

if (90 == $hostingPage)
{
	if ($top)
		$params = array(DA_BODY_TOP_LEFT, DA_BODY_TOP_RIGHT);
	else
		$params = array(DA_BODY_BOTTOM_LEFT, DA_BODY_BOTTOM_RIGHT);

	$arSelect = Array('ID', "PROPERTY_companyId", 'PROPERTY_type', "PROPERTY_htmlCode", 'PROPERTY_flash', 'PREVIEW_PICTURE', 'PROPERTY_displayingArea');
	$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_hostingPage' => $hostingPage, 'PROPERTY_displayingArea' => $params, "ACTIVE"=>"Y");

	$property = 'PROPERTY_DISPLAYINGAREA_ENUM_ID';
}
else
{
	if ($top)
		$params = array(DA_BODY_TOP_LEFT_OTHER_PAGE, DA_BODY_TOP_RIGHT_OTHER_PAGE);
	else
		$params = array(DA_BODY_BOTTOM_LEFT_OTHER_PAGE, DA_BODY_BOTTOM_RIGHT_OTHER_PAGE);

	$arSelect = Array('ID', "PROPERTY_companyId", 'PROPERTY_type', "PROPERTY_htmlCode", 'PROPERTY_flash', 'DETAIL_PICTURE', 'PROPERTY_displayingAreaOtherPage');
	$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_hostingPage' => $hostingPage, 'PROPERTY_displayingAreaOtherPage' => $params, "ACTIVE"=>"Y");

	$property = 'PROPERTY_DISPLAYINGAREAOTHERPAGE_ENUM_ID';
}


$left = $right = $viewLeft = $viewRight = false;
if (CModule::IncludeModule("iblock")) {
	$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nTopCount"=>100), $arSelect);
	while ($ob = $res->GetNextElement()) {

		if (true === $left && true === $right)
			break;

		$flash = false;
		$arFields = $ob->GetFields();
		if (!empty($arFields["PROPERTY_FLASH_VALUE"])) {
			$file['src'] = CFile::GetPath($arFields["PROPERTY_FLASH_VALUE"]);
			$ext = substr(strrchr($file['src'], '.'), 1);
			if ('swf' == $ext)
				$flash = true;
		} elseif (!empty($arFields["DETAIL_PICTURE"]))
			$file = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=>640, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		else
			$file['src'] = '';
	// pre($arFields);
	// pre($params[0]);

		if ($params[0] == $arFields[$property] && !$left)
		{
			$left = true;
			$viewLeft = true;
		}
		elseif ($params[1] == $arFields[$property] && !$right && $left)
		{
			$right = true;
			$viewRight = true;
		}
		elseif ($params[1] == $arFields[$property])
		{
			// Сохраним на всякий случай правый баннер, если не выведется в основном цикле.
			$tmpRightBanner = $arFields;
			$tmpRightBanner['fileSrc'] = $file['src'];
			$tmpRightBanner['flash'] = $flash;
		}

		if (true === $viewLeft || true === $viewRight)
		{
			if ($viewLeft)
				$viewLeft = false;
			elseif ($viewRight)
				$viewRight = false;

			// viewsinc($arFields['ID'], IBLOCK_ID_BANNERS, $arFields['PROPERTY_COMPANYID_VALUE']);
?>
			<div class="col-sm-6 col-xs-12 content-margin double-banners adaptive-banner">
				<div id='<? echo $arFields['ID']; ?>' class='bannerClick'>
<?
				if ('обычный' == $arFields['PROPERTY_TYPE_VALUE']) {
					if ($flash) { ?>
						<div class="infoblock mainBanner">
							<object type="application/x-shockwave-flash" data="<? echo $file['src']; ?>" width="310" height="80">
								<param name="move" value="<? echo $file['src']; ?>">
							</object>
						</div>
<?								
					} else {
						// pre($file);
?>
						<div class="infoblock altBannerBig" style='background-image: url("<? echo $file['src']; ?>");'>
						</div>
<?					}
				} elseif ('html' == $arFields['PROPERTY_TYPE_VALUE']) {
					echo $arFields['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				}
?>
				</div>
			</div>
<?		}
}


// Если вывелся только левый баннер.
if (true === $left && true !== $right && isset($tmpRightBanner))
{
	// viewsinc($tmpRightBanner['ID'], IBLOCK_ID_BANNERS, $arItem['PROPERTIES']['companyId']['VALUE']);
?>
	<div class="col-sm-6 col-xs-12 content-margin adaptive-banner">
		<div id='<? echo $tmpRightBanner['ID']; ?>' class='bannerClick'>
<?
			if ('обычный' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
				if ($tmpRightBanner['flash']) { ?>
					<div class="infoblock mainBanner">
						<object type="application/x-shockwave-flash" data="<? echo $tmpRightBanner['fileSrc']; ?>" width="310" height="80">
							<param name="move" value="<? echo $tmpRightBanner['fileSrc']; ?>">
						</object>
					</div>
<?
				} else {
?>
					<div class="infoblock altBannerBig" style='background-image: url("<? echo $tmpRightBanner['fileSrc']; ?>");'>
					</div>
<?				}
			}
			elseif ('html' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
				echo $tmpRightBanner['PROPERTY_HTMLCODE_VALUE']['TEXT'];
			}
?>
		</div>
	</div>
<?	
}
elseif (true !== $left)
{
	// Не вывелся левый(его нет) - значит не вывелся и правый.
	// Выведем пустое место для левого баннера только если есть правый.
	if (isset($tmpRightBanner))
	{
		// viewsinc($tmpRightBanner['ID'], IBLOCK_ID_BANNERS, $arItem['PROPERTIES']['companyId']['VALUE']);
?>
		<div class="col-sm-6 col-xs-12 content-margin">
			<div class="infoblock">
			</div>
		</div>

		<div class="col-sm-6 col-xs-12 content-margin adaptive-banner">
			<div id='<? echo $tmpRightBanner['ID']; ?>' class='bannerClick'>
<?
				if ('обычный' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
					if ($tmpRightBanner['flash']) { ?>
						<div class="infoblock mainBanner">
							<object type="application/x-shockwave-flash" data="<? echo $tmpRightBanner['fileSrc']; ?>" width="310" height="80">
								<param name="move" value="<? echo $tmpRightBanner['fileSrc']; ?>">
							</object>
						</div>
<?
					} else {
?>
						<div class="infoblock altBannerBig" style='background-image: url("<? echo $tmpRightBanner['fileSrc']; ?>");'>
						</div>
<?					}
				} elseif ('html' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
					echo $tmpRightBanner['PROPERTY_HTMLCODE_VALUE']['TEXT'];
				}
?>
			</div>
		</div>
<?
	}
	else
	{
		/*
?>
		<div class="col-xs-6 content-margin">
			<div class="infoblock">
			</div>
		</div>
<?
*/
	}
}
elseif (true === $left && true !== $right && !isset($tmpRightBanner))
{
?>
	<div class="col-sm-6 col-xs-12 content-margin">
		<div class="infoblock">
		</div>
	</div>
<?
}
} // end if (CModule::IncludeModule("iblock")) {
?>