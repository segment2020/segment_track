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
							<div class="footermenutitle">Лонгриды</div>
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
							<div class="footermenutitle">Мнения</div>
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
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">Участники рынка</div>
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
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
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
					<div class="col-md-2 col-sm-3 col-xs-6 content-margin">
						<div class="footermenu">
							<div class="footermenutitle">Календарь</div>
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
		<div class="notify-cookie container-fluid" style="display: none;">
			<div class="inner-notify-cookie">Мы используем файлы cookies в статистических и рекламных целях, а также для адаптации сайта к индивидуальным потребностям пользователей. Если вы не согласны с этим, вы можете покинуть сайт или изменить настройки, касающиеся cookies в вашем браузере. Изменение настроек может ограничить функциональность сайта.
				<button type="button" title="Закрыть" class="close-notify mfp-close" onclick="$('.notify-cookie').hide();">×</button> 
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
				<a class="logo" href="/"></a>
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

<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<symbol id="icon-lk_user" viewBox="0 0 24 24">
<path d="M23.676 19.99c-1.677-4.008-4.914-5.873-7.423-6.739 1.12-1.537 1.733-3.792 1.757-6.55 0.041-4.656-3.798-5.921-5.833-5.938s-5.896 1.18-5.938 5.836c-0.024 2.757 0.55 5.021 1.642 6.579-2.523 0.82-5.795 2.632-7.54 6.608l-0.413 0.938 0.949 0.39c0.207 0.083 5.126 2.070 11.102 2.122 5.977 0.053 10.93-1.847 11.139-1.927l0.955-0.372-0.397-0.947zM12.153 2.763c0.399 0.008 3.89 0.178 3.857 3.921-0.026 2.996-0.841 5.274-2.232 6.251l-1.721 1.208-1.696-1.237c-1.375-1.002-2.149-3.294-2.122-6.29 0.033-3.744 3.527-3.852 3.914-3.853zM11.997 21.237c-4.046-0.035-7.648-1.047-9.341-1.607 1.83-3.205 4.931-4.457 7.312-4.937l2.089-0.421 2.081 0.456c2.373 0.523 5.452 1.829 7.227 5.064-1.699 0.532-5.31 1.481-9.368 1.445z"></path>
</symbol>
</defs>
</svg>

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
	$APPLICATION->AddHeadScript('/tpl/addons/mmenu-light/mmenu-light.js'); 
?>   

<script src="/tpl/js/scripts.js"></script>    

<script> 
/* This is basic - uses default settings */
	
	// $("div.detailcontent a").fancybox({
	$(".fancyBox").fancybox({
		'hideOnContentClick': true
	});
</script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

</html>
