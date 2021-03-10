<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование елемента");
?>

<?
// if (isset($_GET['strIMessage']) && (!empty($_GET['strIMessage'])))
// {
	// if ($_GET['strIMessage'] === 'Изменения успешно сохранены')
	// {
		// header('Location: /personal/company/news/?action=save&save=success');
		// exit();
	// }
	// elseif ($_GET['strIMessage'] === 'Элемент успешно добавлен')
	// {
		// header('Location: /personal/company/news/?action=add&add=success');
		// exit();
	// }
// }



if ( (isset($_POST['iBlockId']) && !empty($_POST['iBlockId'])) && (isset($_POST['iBlockType']) && !empty($_POST['iBlockType'])) )
{
	// pre($_REQUEST, true);

	$iBlockId = $_POST['iBlockId'];
	$iBlockType = $_POST['iBlockType'];
	if (isset($_POST["PROPERTY"]["MODERATION"]))
		$nextPage = "/personal/moderation/"; 

	switch ($iBlockId)
	{
		case IBLOCK_ID_NEWS_COMPANY:
		{
			$newsSrcPropId     = PROPERTY_ID_NEWS_SRC_IN_NEWS_COMPANY;
			$photoSrcPropId    = PROPERTY_ID_PHOTO_SRC_IN_NEWS_COMPANY;
			$textOnImgPropId   = PROPERTY_ID_TEXT_IMG_SRC_IN_NEWS_COMPANY;
			$archiveSvnPropId  = PROPERTY_ID_ARCHIVE_IN_NEWS_COMPANY;
			$showCompanyLogo   = PROPERTY_ID_SHOW_LOGO_IN_NEWS_COMPANY;
			$markedPropId      = PROPERTY_ID_MARKED_IN_NEWS_COMPANY;
			$markedToPropId    = PROPERTY_ID_MARKED_TO_IN_NEWS_COMPANY;
			$moveToPropertyId  = PROPERTY_ID_MOVE_TO_IN_NEWS_COMPANY;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_NEWS_COMPANY;
			break;
		}

		case IBLOCK_ID_NEWS_INDUSTRY:
		{
			$newsSrcPropId     = PROPERTY_ID_NEWS_SRC_IN_NEWS_INDUSTRY;
			$photoSrcPropId    = PROPERTY_ID_PHOTO_SRC_IN_NEWS_INDUSTRY;
			$textOnImgPropId   = PROPERTY_ID_TEXT_IMG_SRC_IN_NEWS_INDUSTRY;
			$archiveSvnPropId  = PROPERTY_ID_ARCHIVE_IN_NEWS_INDUSTRY;
			$showCompanyLogo   = PROPERTY_ID_SHOW_LOGO_IN_NEWS_INDUSTRY;
			$markedPropId      = PROPERTY_ID_MARKED_IN_NEWS_INDUSTRY;
			$markedToPropId    = PROPERTY_ID_MARKED_TO_IN_NEWS_INDUSTRY;
			$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_NEWS_INDUSTRY;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_NEWS_INDUSTRY;
			break;
		}

		case IBLOCK_ID_STOCK:
		{
			$archiveSvnPropId  = PROPERTY_ID_ARCHIVE_IN_STOCK;
			$showCompanyLogo   = PROPERTY_ID_SHOW_LOGO_IN_STOCK;
			$addMaterialPropId = PROPERTY_ID_ADD_MATERIAL_IN_STOCK;
			$markedPropId      = PROPERTY_ID_MARKED_IN_NEWS_STOCK;
			$markedToPropId    = PROPERTY_ID_MARKED_TO_IN_NEWS_STOCK;
			$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_STOCK;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_STOCK;
			break;
		}

		case IBLOCK_ID_LICENSE:
		{
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_LICENSE;
			$textOnImgPropId  = PROPERTY_ID_TEXT_IMG_SRC_IN_LICENSE;
			$countryPropId    = PROPERTY_ID_COUNTRY_IN_LICENSE;
			$payModePropId    = PROPERTY_ID_PAY_MODE_IN_LICENSE;
			$typePropId       = PROPERTY_ID_TYPE_IN_LICENSE;
			break;
		}

		case IBLOCK_ID_BRANDS:
		{
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_BRANDS;
			$countryPropId    = PROPERTY_ID_COUNTRY_IN_BRANDS;
			$payModePropId    = PROPERTY_ID_PAY_MODE_IN_BRANDS;
			$typePropId       = PROPERTY_ID_TYPE_IN_BRANDS;
			$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_BRANDS;
			break;
		}

		case IBLOCK_ID_GALLERY_PHOTO:
		{
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_GALLERY_PHOTO;
			$imagesPropId     = PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO;
			break;
		}

		case IBLOCK_ID_GALLERY_VIDEO:
		{
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_GALLERY_VIDEO;
			$videoLinkPropId  = PROPERTY_ID_VIDEO_LINK_IN_GALLERY_VIDEO;
			$videoFilePropId  = PROPERTY_ID_VIDEO_FILE_IN_GALLERY_VIDEO;
			break;
		}

		case IBLOCK_ID_VIEWPOINT:
		{
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_VIEWPOINT;
			$namePropId       = PROPERTY_ID_NAME_IN_VIEWPOINT;
			$sourcePropId     = PROPERTY_ID_SOURCE_IN_VIEWPOINT;
			$addBlockIdPropId = PROPERTY_ID_ADD_BLOCKID_IN_VIEWPOINT;
			$addElementIdPropId = PROPERTY_ID_ADD_ELEMENTID_IN_VIEWPOINT;
			$addMaterialPropId  = PROPERTY_ID_ADD_MATERIAL_IN_VIEWPOINT;
			$photoSrcPropId = PROPERTY_ID_PHOTO_SRC_IN_VIEWPOINT;
			$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_VIEWPOINT;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_VIEWPOINT;
			break;
		}

		case IBLOCK_ID_EVENTS:
		{
			$sitePropId = PROPERTY_ID_SITE_IN_EVENTS;
			$endDate = PROPERTY_ID_END_DATE_IN_EVENTS;
			$placePropId = PROPERTY_ID_PLACE_IN_EVENTS;
			$phonePropId = PROPERTY_ID_PHONE_IN_EVENTS;
			$sourcePropId = PROPERTY_ID_SOURCE_IN_EVENTS;			
			$beginDate = PROPERTY_ID_BEGIN_DATE_IN_EVENTS;
			$timePropId = PROPERTY_ID_BEGIN_TIME_IN_EVENTS;
			$textOnImgPropId  = PROPERTY_ID_TEXT_IN_EVENTS;
			$vkLinkPropId  = PROPERTY_ID_VK_LINK_IN_EVENTS;
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_EVENTS;
			$googlekLinkPropId = PROPERTY_ID_GOOGLE_LINK_IN_EVENTS;
			$twitterkLinkPropId = PROPERTY_ID_TWITTER_LINK_IN_EVENTS;
			$facebookLinkPropId = PROPERTY_ID_FACEBOOK_LINK_IN_EVENTS;
			$instagrammLinkPropId = PROPERTY_ID_INSTAGRAMM_LINK_IN_EVENTS;
			$registrationLinkPropId = PROPERTY_ID_REG_LINK_IN_EVENTS;
			$schemePropId = PROPERTY_ID_SCHEME_IN_EVENTS;
			$emailPropId = PROPERTY_ID_SITE_EMAIL_IN_EVENTS;
			$endTime = PROPERTY_ID_END_TIME_IN_EVENTS;
			break;
		}

		case IBLOCK_ID_PRODUCTS_REVIEW:
		{ 
			$archiveSvnPropId = PROPERTY_ID_ARCHIVE_IN_PRODUCTS_REVIEW;
			$textOnImgPropId  = PROPERTY_ID_TEXT_IMG_SRC_IN_PRODUCTS_REVIEW;
			$newsSrcPropId    = PROPERTY_ID_NEWS_SRC_IN_PRODUCTS_REVIEW;
			$showCompanyLogo  = PROPERTY_ID_SHOW_LOGO_IN_PRODUCTS_REVIEW;
			$addMaterialPropId  = PROPERTY_ID_ADD_MATERIAL_IN_PRODUCTS_REVIEW;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_PRODUCTS_REVIEW;
			$moveToPropertyId = PROPERTY_ID_JSON_DATA_IN_PRODUCTS_REVIEW;
			break;
		}

		case IBLOCK_ID_PRICE_LISTS:
		{
			$priceFile = PROPERTY_ID_FILE_IN_PRICE_LIST;
			break;
		}

		case IBLOCK_ID_CATALOG:
		{
			$brand            = PROPERTY_ID_BRAND_IN_CATALOG;
			$article          = PROPERTY_ID_ARTICLE_IN_CATALOG;
			$licenses         = PROPERTY_ID_LICENSES_IN_CATALOG;
			$hit              = PROPERTY_ID_HIT_IN_CATALOG;
			$price            = PROPERTY_ID_PRICE_IN_CATALOG;
			$imagesPropId     = PROPERTY_ID_ADD_PHOTO_IN_CATALOG;
			break;
		}

		case IBLOCK_ID_NOVETLY: 
		{
			$newsSrcPropId     = PROPERTY_ID_NEWS_SRC_IN_NOVETLY;
			$photoSrcPropId    = PROPERTY_ID_PHOTO_SRC_IN_NOVETLY;
			$textOnImgPropId   = PROPERTY_ID_TEXT_IMG_SRC_IN_NOVETLY;
			$archiveSvnPropId  = PROPERTY_ID_ARCHIVE_IN_NOVETLY;
			$showCompanyLogo   = PROPERTY_ID_SHOW_LOGO_IN_NOVETLY;
			$markedPropId      = PROPERTY_ID_MARKED_IN_NEWS_NOVETLY;
			$markedToPropId    = PROPERTY_ID_MARKED_TO_IN_NEWS_NOVETLY;
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_NOVETLY;
			break;
		}

		case IBLOCK_ID_BANNERS:
		{
			$displayAreaPropId = PROPERTY_ID_DISPLAY_AREA_IN_BANNERS;
			$linkPropId        = PROPERTY_ID_LINK_IN_BANNERS;
			$typePropId        = PROPERTY_ID_TYPE_IN_BANNERS;
			$hostingPagePropId = PROPERTY_ID_HOSTING_PAGE_IN_BANNERS;
			$htmlCodePropId    = PROPERTY_ID_HTML_CODE_IN_BANNERS;
			$flashFilePropId   = PROPERTY_ID_FLASH_IN_BANNERS;
			$displayAreaOtherPagePropId = PROPERTY_ID_DISPLAY_AREA_OTHER_PAGE_IN_BANNERS;
			break;
		}

		case IBLOCK_ID_CATALOGS_PDF:
		{
			$file              = PROPERTY_ID_FILE_IN_CATALOGS_PDF;
			$phonePropId       = PROPERTY_ID_PHONE_IN_CATALOGS_PDF;
			$emailPropId       = PROPERTY_ID_EMAIL_IN_CATALOGS_PDF;
			$countryPropId     = PROPERTY_ID_COUNTRY_IN_CATALOGS_PDF;
			break;
		}
		case IBLOCK_ID_LIFE_INDUSTRY:
		{  
			$displayJsonDataId = PROPERTY_ID_JSON_DATA_IN_LIFE_INDUSTRY;
			$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_LIFE_INDUSTRY;
			break;
		}
	}
}
// else
// {
	// header('Location: /personal/');
	// exit();
// }

//pre($showCompanyLogo, $exit = true);

$APPLICATION->IncludeComponent(
	"wp:iblock.element.add.form", 
	"editElement",  
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "PROPERTY_ID",
		"ELEMENT_ASSOC_PROPERTY" => "id",
		//"ELEMENT_ASSOC_PROPERTY" => "110",
		"GROUPS" => array(
			0 => "1",
			1 => "5",
			2 => "6",		
		),
		"IBLOCK_ID" => $iBlockId,
		"IBLOCK_TYPE" => $iBlockType,
		"LEVEL_LAST" => "N",
		"LIST_URL" => $nextPage,
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array(
			0 => "NAME",
			1 => "TAGS",
			2 => "PREVIEW_TEXT",
			3 => "PREVIEW_PICTURE",
			4 => "DETAIL_TEXT",
			5 => "DETAIL_PICTURE",
			6 => "DATE_ACTIVE_FROM",
			7 => "ACTIVE", 
			8 => "PREVIEW_TEXT_TYPE",
			9 => $newsSrcPropId,
			10 => $photoSrcPropId,
			11 => $countryPropId,
			12 => $imagesPropId,
			13 => $videoLinkPropId,
			14 => $videoFilePropId,
			15 => $namePropId,
			16 => $sourcePropId,
			17 => $beginDate,
			18 => $endDate,
			19 => $timePropId,
			20 => $placePropId,
			21 => $phonePropId,
			22 => $sitePropId,
			23 => $vkLinkPropId,
			24 => $googlekLinkPropId,
			25 => $instagrammLinkPropId,
			26 => $twitterkLinkPropId,
			27 => $facebookLinkPropId,
			28 => $textOnImgPropId,
			29 => "DETAIL_TEXT_TYPE",
			30 => $payModePropId,
			31 => $typePropId,
			32 => $archiveSvnPropId,
			33 => $showCompanyLogo,
			34 => $priceFile,
			35 => $registrationLinkPropId,
			36 => $schemePropId,
			37 => $emailPropId,
			38 => $addMaterialPropId,
			39 => $article,
			40 => $licenses,
			41 => $hit,
			42 => $brand,
			43 => $endTime,
			44 => $price,
			45 => "IBLOCK_SECTION",
			46 => $displayAreaPropId,
			47 => $linkPropId,
			48 => $typePropId,
			49 => $hostingPagePropId,
			50 => $file,
			51 => $htmlCodePropId,
			52 => $markedPropId,
			53 => $markedToPropId,
			54 => $flashFilePropId,
			55 => $displayAreaOtherPagePropId,
			56 => $displayJsonDataId, 
			57 => $moveToPropertyId, 
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "NAME",
			1 => $endDate,
			2 => $beginDate,
			3 => $namePropId,
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "editElement"
	),
	false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>