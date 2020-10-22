<!DOCTYPE html>
<html lang="ru"><head>
    <meta charset="UTF-8">
    <title><? $APPLICATION->ShowTitle(); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cleartype" content="on">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta http-equiv="msthemecompatible" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="imagetoolbar" content="no">
	<link href="/tpl/images/favicon.png" rel="icon" type="image/png" >
	<link rel="stylesheet" href="/tpl/wow_book_plugin/wow_book.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/tpl/css/jquery.fancybox.min.css" media="screen" />

<?
	$APPLICATION->SetAdditionalCSS('/tpl/css/fonts.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/bootstrapadd.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/bootstrap-select.css');
	$APPLICATION->SetAdditionalCSS('/tpl/addons/jquery.bxslider/jquery.bxslider.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/awesome-bootstrap-checkbox.css');
	$APPLICATION->SetAdditionalCSS('/tpl/addons/mcustomscrollbar/jquery.mCustomScrollbar.css');
	$APPLICATION->SetAdditionalCSS('/tpl/addons/magnific-popup/magnific-popup.css');
	$APPLICATION->SetAdditionalCSS('/tpl/addons/toastmessage/jquery.toastmessage.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/styles.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/jquery-ui.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/swiper/swiper.min.css');
	$APPLICATION->SetAdditionalCSS('/tpl/css/responsive.css');

	$APPLICATION->ShowHead();
	$APPLICATION->ShowPanel();
?>

<style type="text/css" media="print"> 
  .no_print {display: none; }
</style>

<!-- Yandex.Metrika counter -->
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
try { var yaCounter2131294 = new Ya.Metrika({id:2131294,
          webvisor:true,
          clickmap:true,
          trackLinks:true,
          accurateTrackBounce:true});
} catch(e) { }
</script>
<noscript><div><img src="//mc.yandex.ru/watch/2131294" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<!-- Google analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2064112-1']);
  _gaq.push(['_trackPageview']);
  
  setTimeout("_gaq.push(['_trackEvent', '15_seconds', 'read'])",15000);
  
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- /Google analytics -->


</head>
<body>




<?
	CModule::IncludeModule("iblock"); 

	$bannerImagePath = $bannerLink = null;
	$arSelect = Array('ID', 'DETAIL_PICTURE', 'PROPERTY_companyId');
	$bannersFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_type' => 129, "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $bannersFilter, false, array(), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		if (!empty($arFields["DETAIL_PICTURE"]))
			$bannerImagePath = CFile::getPath($arFields["DETAIL_PICTURE"]);

		if (!empty($arFields["ID"]))
			$bannerLink = $bannerId = $arFields['ID'];
	}
	
?>

<?
// if ((1 == $USER->GetByID()) && $USER->IsAdmin())
// {
	if (null !== $bannerImagePath && $APPLICATION->GetCurPage(false) === '/')
	{
		viewsinc($bannerId, IBLOCK_ID_BANNERS, $arFields['PROPERTY_COMPANYID_VALUE']);
	?>
	<!-- Баннер по левой и правой стороне. -->
	<div style="
		position: absolute;
		width: 100%;
		height: 100%;
	">
        <div  id='<? echo $bannerLink; ?>' class='bannerClick' style="
			background-image: url('<? echo $bannerImagePath; ?>');
			display: block;
			width: 100%;
			height: 100%;
			background-repeat: no-repeat;
			background-position: center top;
		"></div>
    </div>

<?
	}
// }
?>

 
	<header>
		<nav class="navbar navbar-top">
			<div class="container-fluid">
				<div id="navbar">
					<ul class="nav navbar-nav navbar-nav-top">
						<li class="active"><a href="/">Канцелярские товары</a></li>
						<li><a href="http://suvenir.segment.ru" target='_blank'>Сувениры и подарки</a></li>
						<li><a href="http://toys.segment.ru" target='_blank'>Игрушки</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-nav-lang">
						<li class="dropdown dropdown-top">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RUS <i class="icon-icons_main-12"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">RUS</a></li>
								<li><a href="#">ENG</a></li>
							</ul>
						</li>					
					</ul>
					<div class="nav navbar-right-top">
						<?
							$APPLICATION->IncludeComponent("bitrix:menu", "segmentUpperMenu", Array(
								"COMPONENT_TEMPLATE" => "segmentTopMenu",
									"ROOT_MENU_TYPE" => "upper",	// Тип меню для первого уровня
									"MENU_CACHE_TYPE" => "N",	// Тип кеширования
									"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
									"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
									"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
									"MAX_LEVEL" => "4",	// Уровень вложенности меню
									"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
									"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
									"DELAY" => "N",	// Откладывать выполнение шаблона меню
									"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
									"MENU_THEME" => "site"
								),
								false
							);
						?>
						<?
							if(!$USER->IsAuthorized())
							{
						?>		<span class="registration"><a href="#regauth-popup" class="reg-popup-link"><i class="icon-icons_main-11"></i>Регистрация</a></span>
								<span class="enter"><a href="#regauth-popup" class="auth-popup-link"><i class="icon-icons_main-10"></i>Вход</a></span>
								
						<?	}
							else
							{
						?>		<span class="registration"><a href="/?logout=yes" class=""><i class="icon-icons_main-10"></i>Выход</a></span>
								
							<?
								if (CModule::IncludeModule('forum'))
								{
									$newMessageCount = (CForumPrivateMessage::GetNewPM(1));

									if (0 !== (int)$newMessageCount['UNREAD_PM'])
									{
								?>
										<span class='newMessageMenuCountHeader'><? ECHO $newMessageCount['UNREAD_PM']; ?></span>
								<?
									}
								}	
							?>
							<span class="enter"><a href="/personal/" class=""><i class="icon-icons_main-11"></i>Личный кабинет</a></span>
								
						<?
							}
						?>
					</div>
				</div>
			</div>
		</nav>
		<div id="regauth-popup" class="white-popup block-default block-shadow mfp-hide regauthmodal">
			<div class="regmodal popup-login">
				<ul class="tabblock text-center">
					<li>
						<a href="#h-auth">Вход</a>
					</li>
					<li>
						<a href="#h-reg">Регистрация</a>
					</li>
				</ul>
				<div class="regtab" id="h-auth">
					<?
						$APPLICATION->IncludeComponent("bitrix:system.auth.form", "authForm", Array(
							"FORGOT_PASSWORD_URL" => "/personal/",	// Страница забытого пароля
								"PROFILE_URL" => "/personal/",	// Страница профиля
								"REGISTER_URL" => "",	// Страница регистрации
								"SHOW_ERRORS" => "Y",	// Показывать ошибки
							),
							false
						);					
					?>
				</div>
				<div class="regtab" id="h-reg">
					<?
						$APPLICATION->IncludeComponent(
							"bitrix:main.register", 
							"modal", 
							array(
								"AUTH" => "N",
								"REQUIRED_FIELDS" => array(	// Поля, обязательные для заполнения
									0 => "EMAIL",
									1 => "NAME", 
								),
								"SET_TITLE" => "N",	// Устанавливать заголовок страницы
								"SHOW_FIELDS" => array(	// Поля, которые показывать в форме
									0 => "EMAIL",
									1 => "NAME",
									2 => "LAST_NAME",
									3 => "PASSWORD",
									4 => "CONFIRM_PASSWORD",
								),
								"SUCCESS_PAGE" => "",
								"USER_PROPERTY" => array( 
								),
								"USER_PROPERTY_NAME" => "",
								"USE_BACKURL" => "N",
								"COMPONENT_TEMPLATE" => "modal",
								"HIDE_LOGIN"         => true
							),
							false 
						);
					?>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-mid">
			<div class="container-fluid">
				<div class="row">
				<div class="col-xs-3">
					<a class="logo" href="/"></a>
				</div>
				<div class="col-xs-4">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:search.form", 
						"searchTop", 
						array(
							"COMPONENT_TEMPLATE" => "searchTop",
							"PAGE" => "#SITE_DIR#search/index.php",
							"USE_SUGGEST" => "N"
						),
						false
					);
					?>
				</div>
				<div class="col-xs-5">
					<div class="row">
<?
// Баннеры.
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
		else
			$hostingPage = 0;
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
		else
			$hostingPage = 0;
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

	case 'hits':
	{
		$hostingPage = 126;
		break;
	}

	default:
		$hostingPage = 0;
}




// $rand = rand(0, 999999);
 
$count = null;
			$count = CIBlockElement::GetList(
				array(),
				array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'PROPERTY_hostingPage' => $hostingPage, array("LOGIC" => "OR",
																			'PROPERTY_displayingArea' => array(DA_HEADER_LEFT, DA_HEADER_RIGHT),
																			'PROPERTY_displayingAreaOtherPage' => array(DA_HEADER_RIGHT_OTHER_PAGE, DA_HEADER_LEFT_OTHER_PAGE))),
				array(),
				false,
				array('ID', 'CODE')
			);
// pre($count);
 

// $count = null;
			// $count = CIBlockElement::GetList(
				// array(),
				// array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'PROPERTY_type' => 130, 'PROPERTY_hostingPage' => $hostingPage),
				// array(),
				// false,
				// array('ID', 'CODE')
			// );
// pre($count);






// if ($APPLICATION->GetCurPage(false) !== '/test/')
// if (0 == $rand % 2)
if ($count > 0)
{
	$GLOBALS['arrFilter'] = array('PROPERTY_hostingPage' => $hostingPage, array("LOGIC" => "OR",
		'PROPERTY_displayingArea' => array(DA_HEADER_LEFT, DA_HEADER_RIGHT),
		'PROPERTY_displayingAreaOtherPage' => array(DA_HEADER_RIGHT_OTHER_PAGE, DA_HEADER_LEFT_OTHER_PAGE)));

// $GLOBALS['arrFilter'] = array('PROPERTY_hostingPage' => $hostingPage, array('PROPERTY_displayingArea' => array(DA_HEADER_LEFT, DA_HEADER_RIGHT)));
	$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"bannersInHeader", 
		array(
			"COMPONENT_TEMPLATE" => "bannersInHeader",
			"IBLOCK_TYPE" => "banners",
			"IBLOCK_ID" => "21",
			"NEWS_COUNT" => "50",
			"SORT_BY1" => "RAND",
			"SORT_ORDER1" => "RAND",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "arrFilter",
			"FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "DATE_CREATE",
				2 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "displayingArea",
				1 => "link",
				2 => "type",
				3 => "FORUM_MESSAGE_CNT",
				4 => "companyId",
				5 => "",
			),
			"CHECK_DATES" => "N",
			"DETAIL_URL" => "/personal/company/banners/edit/?elementId=#ELEMENT_ID#",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"PAGER_TEMPLATE" => "custom",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"DETAIL_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"LIST_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"STRICT_SECTION_CHECK" => "N"
		),
		false
	);
}
else
{
	$GLOBALS['arrFilterBanner'] = array('PROPERTY_type' => 130, 'PROPERTY_hostingPage' => $hostingPage);

	$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"bannersInHeaderUnited", 
		array(
			"COMPONENT_TEMPLATE" => "bannersInHeaderUnited",
			"IBLOCK_TYPE" => "banners",
			"IBLOCK_ID" => "21",
			"NEWS_COUNT" => "1",
			"SORT_BY1" => "RAND",
			"SORT_ORDER1" => "RAND",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "arrFilterBanner",
			"FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "DATE_CREATE",
				2 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "displayingArea",
				1 => "link",
				2 => "type",
				3 => "FORUM_MESSAGE_CNT",
				4 => "companyId",
				5 => "",
			),
			"CHECK_DATES" => "N",
			"DETAIL_URL" => "/personal/company/banners/edit/?elementId=#ELEMENT_ID#",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"PAGER_TEMPLATE" => "custom",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"DETAIL_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"LIST_FIELD_CODE" => array(
				0 => "SHOW_COUNTER",
				1 => "",
			),
			"STRICT_SECTION_CHECK" => "N"
		),
		false
	);
}

?>



					</div>
				</div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-bot <? if ('/' === $page) echo 'mainblock'; ?>">
			<div class="container-fluid">
<?
				$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"topMenuMultilevel", 
					array(
						"COMPONENT_TEMPLATE" => "topMenuMultilevel",
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "topSubMenu",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
						"MENU_THEME" => "site"
					),
					false
				);
?>
			</div>
		</nav>
	</header>

<?
	if ('/' !== $page)
	{
?>
		<div class="bcblock">
			<div class="container-fluid">
				<ul>
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"breadcrumbCustom",
						Array(
							"COMPONENT_TEMPLATE" => "breadcrumbCustom",
							"PATH" => "",
							"SITE_ID" => "s1",
							"START_FROM" => "0"
						)
					);
					?>
				</ul>
			</div>
		</div>
<?
	}
?>

	<div class="container-fluid">
		<div class="row">
			<? $APPLICATION->IncludeFile('/tpl/include_area/bannersHeaderBottom.php', array('top' => 'true'), array()); ?>
		</div>
	</div>
<!-- END HEADER -->
