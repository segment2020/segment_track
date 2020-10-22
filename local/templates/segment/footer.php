<!-- START FOOTER -->
	<div class="container-fluid">
		<div class='row'>
			<? $APPLICATION->IncludeFile('/tpl/include_area/bannersHeaderBottom.php', array(), array()); ?>
		</div>
	</div>
	<footer>
		<div class="footertop">
			<div class="container-fluid">
				<div class="row row-flex">
					<div class="col-md-4 col-sm-12 col-xs-12 col-footerlogo content-margin">
						<div class="footerlogo">
							<a href="/"></a>
							</div>
						<?$APPLICATION->IncludeFile('/tpl/include_area/contacts.php', array(), array());?>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">О проекте</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomProject",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">Новости</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomNews",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>						
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">Товары и бренды</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomProducts",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>		 			
					</div>	
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">Участники рынка</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomMarketParticipant",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>					
					</div>
				</div>
				<div class="row row-flex">
					<div class="col-md-4 col-sm-3 col-xs-12 order-xs-1">
						<div class="footermenutitle">Другие проекты</div>
						<div class="footerproject">
							<a href="http://toys.segment.ru" target='_blank'>
								<div class="line project1">
									<div class="projecttitle">Сегмент - игрушки</div>
									<div class="projectdescr">Отраслевой портал индустрии игрушек</div>
								</div>
							</a>
							<a href="http://suvenir.segment.ru" target='_blank'>
								<div class="line  project2">
									<div class="projecttitle">Сегмент - сувениры и подарки</div>
									<div class="projectdescr">Отраслевой портал индустрии сувениров и подарков</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6">
						<div class="footermenu">
							<div class="footermenutitle">Статьи</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomArticle",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>
					</div>
					<!-- <div class="col-xs-2">
						<div class="footermenu">
							<div class="footermenutitle">Форум</div> -->
							<?
								# $APPLICATION->IncludeComponent(
	# "bitrix:menu", 
	# "bottomMenu", 
	# array(
	# 	"COMPONENT_TEMPLATE" => "bottomMenu",
	# 	"ROOT_MENU_TYPE" => "bottomForum",
	# 	"MENU_CACHE_TYPE" => "N",
	# 	"MENU_CACHE_TIME" => "3600",
	# 	"MENU_CACHE_USE_GROUPS" => "Y",
	# 	"MENU_CACHE_GET_VARS" => array(
	# 	),
	# 	"MAX_LEVEL" => "4",
	# 	"CHILD_MENU_TYPE" => "",
	# 	"USE_EXT" => "N",
	# 	"DELAY" => "N",
	# 	"ALLOW_MULTI_SELECT" => "N",
	# 	"MENU_THEME" => "site",
	# 	"COMPOSITE_FRAME_MODE" => "A",
	# 	"COMPOSITE_FRAME_TYPE" => "AUTO"
	# ),
	# false
# );
							?>
						<!-- </div>						
					</div> -->
					<div class="col-md-2 col-sm-3 col-xs-6">
						<div class="footermenu">
							<div class="footermenutitle">Медиа</div>
							<?
								$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"bottomMenu", 
								array(
									"COMPONENT_TEMPLATE" => "bottomMenu",
									"ROOT_MENU_TYPE" => "bottomMedia",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "4",
									"CHILD_MENU_TYPE" => "",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"MENU_THEME" => "site"
								),
								false
							);
							?>
						</div>					
					</div>	
					<div class="col-md-2 col-sm-3 col-xs-6">
						<div class="footermenu">
							<div class="footermenutitle">Мнения</div>
								<?
									$APPLICATION->IncludeComponent(
									"bitrix:menu", 
									"bottomMenu", 
									array(
										"COMPONENT_TEMPLATE" => "bottomMenu",
										"ROOT_MENU_TYPE" => "bottomPOV",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MAX_LEVEL" => "4",
										"CHILD_MENU_TYPE" => "",
										"USE_EXT" => "N",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"MENU_THEME" => "site"
									),
									false
								);
								?>
						</div>					
					</div>					
				</div>
			</div>
		</div>
		<div class="footerbottom">
			<div class="container-fluid clearfix">
				<div class="footercopy floatleft">© 2020 СЕГМЕНТ. Все права защищены. 0.21076</div>
				<div class="foot
				ermadeby floatright"> </div>
			</div>
		</div>
	</footer>
	<div class="scrollup text-center">
		<div class="scrollico block-default block-shadow"><i class="icon-icons_main-08"></i></div>
		<div class="scrolltext">Наверх</div>
	</div>	
	
	<nav id="mmenu" data-mmenu-title="Меню">
	<ul class="navbar-mobile bg-color2">
		<li class="bg-color-white"> 
			<a class="logo" href="index.html"></a>
		</li>       
		<div class="bg-color-white"> 
			<?php
			$APPLICATION->IncludeComponent(
				"bitrix:menu", 
				"topMenuMultilevel1", 
				array(
					"COMPONENT_TEMPLATE" => "topMenuMultilevel1",
					"ROOT_MENU_TYPE" => "mobileMenu",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "1",
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
		<div class="bg-color1">  
			<li><a href="/about/">О проекте</a></li>
			<li><a href="/marketing/">Реклама на портале</a></li>
			<li><a href="/feedback/">Обратная связь</a></li>
		</div>
		<div class="bg-color2">  
			<li><a href="#regauth-popup" class="auth-popup-link">Вход</a></li>
			<li><a href="#regauth-popup" class="reg-popup-link">Регистрация</a></li> 
		</div> 

			<button title="Закрыть" type="button" id="mmenu-close" class="mfp-close" onclick="$('.search-form_top').hide(300);">×</button> 
		</ul>
	</nav>
</div>	
</body>
<? 
	$APPLICATION->AddHeadScript("/tpl/js/jquery-3.2.1.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/modernizr.js");
	$APPLICATION->AddHeadScript("/tpl/addons/jquery.tabslet.min.js");
	$APPLICATION->AddHeadScript("/tpl/js/bootstrap.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/bootstrap-hover-dropdown.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/bootstrap-select/bootstrap-select.js");
	$APPLICATION->AddHeadScript("/tpl/addons/jquery.bxslider/jquery.bxslider.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/magnific-popup/jquery.magnific-popup.min.js");
	$APPLICATION->AddHeadScript("/tpl/addons/toastmessage/jquery.toastmessage.js");
	$APPLICATION->AddHeadScript("/tpl/wow_book_plugin/wow_book.min.js");
	$APPLICATION->AddHeadScript("/tpl/wow_book_plugin/pdf.combined.min.js");
	$APPLICATION->AddHeadScript("/tpl/js/jquery.fancybox.min.js");  

	use Bitrix\Main\Page\Asset;
	$APPLICATION->AddHeadScript('/tpl/addons/mmenu-light/mmenu-light.js'); 
	$APPLICATION->AddHeadScript('/tpl/js/scripts.js');
?>


<script>

/* This is basic - uses default settings */
	
	// $("div.detailcontent a").fancybox({
	$(".fancyBox").fancybox({
		'hideOnContentClick': true
	});
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</html>
