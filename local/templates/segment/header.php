<!DOCTYPE html>
<html lang="ru"><head>
    <meta charset="UTF-8">
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

<?php
    $APPLICATION->SetAdditionalCSS('/tpl/css/fonts.css');
    // Оригинальный bootstrap 3.4
    // $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/bootstrap.css');
    // Старый bootstrap 3.4
    $APPLICATION->SetAdditionalCSS('/tpl/css/bootstrapadd.css');
    $APPLICATION->SetAdditionalCSS('/tpl/css/bootstrap-select.css');
    $APPLICATION->SetAdditionalCSS('/tpl/addons/jquery.bxslider/jquery.bxslider.css');
    $APPLICATION->SetAdditionalCSS('/tpl/css/awesome-bootstrap-checkbox.css');
    $APPLICATION->SetAdditionalCSS('/tpl/addons/mcustomscrollbar/jquery.mCustomScrollbar.css');
    $APPLICATION->SetAdditionalCSS('/tpl/addons/magnific-popup/magnific-popup.css');
    $APPLICATION->SetAdditionalCSS('/tpl/addons/toastmessage/jquery.toastmessage.css');
    $APPLICATION->SetAdditionalCSS('/tpl/addons/mmenu-light/mmenu-light.css');
    $APPLICATION->SetAdditionalCSS('/tpl/css/styles.css');
    $APPLICATION->SetAdditionalCSS('/tpl/css/jquery-ui.css');
    $APPLICATION->SetAdditionalCSS('/tpl/css/swiper/swiper.min.css');
    
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/responsive.css");

    $APPLICATION->ShowHead();
    $APPLICATION->ShowPanel();
?>


<?php $APPLICATION->IncludeFile('/tpl/include_area/counters.php', array('top' => 'true'), array()); ?> 


</head>
<body <?php if ($APPLICATION->GetCurPage() !== "/"){?> class="not-index-page"<?php } ?>>




<?php
    CModule::IncludeModule("iblock");

    $bannerImagePath = $bannerLink = null;
    $arSelect = array('ID', 'DETAIL_PICTURE', 'PROPERTY_companyId');
    $bannersFilter = array("IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_type' => 129, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array("RAND" => "ASC"), $bannersFilter, false, array(), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        if (!empty($arFields["DETAIL_PICTURE"])) {
            $bannerImagePath = CFile::getPath($arFields["DETAIL_PICTURE"]);
        }

        if (!empty($arFields["ID"])) {
            $bannerLink = $bannerId = $arFields['ID'];
        }
    }
    
?>

<?php
// if ((1 == $USER->GetByID()) && $USER->IsAdmin())
// {
    if (null !== $bannerImagePath && $APPLICATION->GetCurPage(false) === '/') {
        viewsinc($bannerId, IBLOCK_ID_BANNERS, $arFields['PROPERTY_COMPANYID_VALUE']); ?>
	<!-- Баннер по левой и правой стороне. -->
	<div style="
		position: absolute;
		width: 100%;
		height: 100%;
	">
        <div  id='<?php echo $bannerLink; ?>' class='bannerClick' style="
			background-image: url('<?php echo $bannerImagePath; ?>');
			display: block;
			width: 100%;
			height: 100%;
			background-repeat: no-repeat;
			background-position: center top;
		"></div>
    </div>

<?php
    }
// }
?>

 
<div id="page">
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
					<div class="nav navbar-right-top hidden-xs">
						<?php
                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "segmentUpperMenu",
                                array(
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
						<?php
                            if (!$USER->IsAuthorized()) {
                                ?>		<span class="registration"><a href="#regauth-popup" class="reg-popup-link"><i class="icon-icons_main-11"></i>Регистрация</a></span>
								<span class="enter"><a href="#regauth-popup" class="auth-popup-link"><i class="icon-icons_main-10"></i>Вход</a></span>
								
						<?php
                            } else {
                                ?>		<span class="registration"><a href="/?logout=yes" class=""><i class="icon-icons_main-10"></i>Выход</a></span>
								
							<?php
                                if (CModule::IncludeModule('forum')) {
                                    $newMessageCount = (CForumPrivateMessage::GetNewPM(1));

                                    if (0 !== (int)$newMessageCount['UNREAD_PM']) {
                                        ?>
										<span class='newMessageMenuCountHeader'><?php echo $newMessageCount['UNREAD_PM']; ?></span>
								<?php
                                    }
                                } ?>
							<span class="enter"><a href="/personal/" class=""><i class="icon-icons_main-11"></i>Личный кабинет</a></span>
								
						<?php
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
					<?php
                        $APPLICATION->IncludeComponent(
                            "bitrix:system.auth.form",
                            "authForm",
                            array(
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
					<?php
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
					<div class="col-md-3 col-sm-12 pad-sm-0">
						<div class="flex-wrap"> 
							<div class="btn-mobile-nav visible-xs visible-sm"> 
								<a class="hamburger hamburger--boring" href="#mmenu">
									<div class="hamburger-box">
										<div class="hamburger-inner"></div>
									</div>
								</a>
							</div>
							<a class="logo" href="/"></a>
							<div class="btn-mobile-nav visible-xs visible-sm" onclick="$('.search-form_top').show(300);">
								<i class="icon-icons_main-14"></i>
							</div>
						</div>
					</div>
					<div class="col-md-4 search-form_top">
						<?php
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
					<div class="col-md-5 hidden-xs hidden-sm">
						<div class="row">
						<?php $APPLICATION->IncludeFile('/tpl/include_area/bannersHeaderTopRight.php', array('top' => 'true'), array()); ?> 
						</div>
					</div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-bot hidden-xs">
			<div class="container-fluid">
<?php
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
                                "MENU_THEME" => "site",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        );
?>
			</div>
		</nav>
	</header>

<?php
    if ($APPLICATION->GetCurPage() !== "/") {
        ?>
		<div class="bcblock">
			<div class="container-fluid">
				<ul>
					<?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "breadcrumbCustom",
                        array(
                            "COMPONENT_TEMPLATE" => "breadcrumbCustom",
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    ); ?>
				</ul>
			</div>
		</div>
<?php
    }
?>
	<div class="container-fluid-spacer"></div>
	<div class="container-fluid">
		<div class="row">
			<?php $APPLICATION->IncludeFile('/tpl/include_area/bannersHeaderBottom.php', array('top' => 'true'), array()); ?>
		</div>
	</div>
<!-- END HEADER -->
