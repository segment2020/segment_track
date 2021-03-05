<?
$page = $APPLICATION->GetCurPage();

$basket = $messages = '';
if ('/personal/basket/' == $page)
	$basket = 'item-selected';
elseif ('/personal/messages/' == $page)
	$messages = 'item-selected';

if (CModule::IncludeModule('forum'))
{
	$newMessageCount = (CForumPrivateMessage::GetNewPM(1));

	if (0 === (int)$newMessageCount['UNREAD_PM'])
		$newMessageCount = '';
}
else
	$newMessageCount = '';
?>
<a href="/personal/" class="list-group-item"><img src="/tpl/images/lkmenu1.png">Профиль пользователя</a>
<?
	use \Bitrix\Main\UserGroupTable;

	$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $USER->GetID(), 'GROUP_ID' => array(ID_GROUP_COMPANY_STAFF, ID_GROUP_COMPANY_ADMIN))));
	if ($row = $res->fetch() && $companyName)
	{
?>
		<a href="#lkmenu1" class="list-group-item" data-toggle="collapse"><img src="/tpl/images/lkmenu2.png">Компания<i class="floatright icon-icons_main-13"></i></a>
<?
		if (strpos($_SERVER['REQUEST_URI'], '/personal/company/') !== false) {
			echo '<div class="submenu collapse in" id="lkmenu1" aria-expanded="true">';
		} else {
			echo '<div class="submenu collapse" id="lkmenu1">';
		}

		$APPLICATION->IncludeComponent("bitrix:menu", "leftMenu", Array(
			"COMPONENT_TEMPLATE" => "vertical_multilevel",
				"ROOT_MENU_TYPE" => "leftMenuPersonalPage",	// Тип меню для первого уровня
				"MENU_CACHE_TYPE" => "N",	// Тип кеширования
				"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
				"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
				"MAX_LEVEL" => "4",	// Уровень вложенности меню
				"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
				"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				"DELAY" => "N",	// Откладывать выполнение шаблона меню
				"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
				"MENU_THEME" => "site",
				"COMPANY_ID" => $companyId
			),
			false
		);
?>
 
			</div>
<?
	}
?>

<a href="/personal/messages/" class="list-group-item <? echo $messages; ?>"><img src="/tpl/images/lkmenu4.png">Сообщения <span class='newMessageMenuCount'><? echo $newMessageCount['UNREAD_PM']; ?></span></a>
<?
/*
<a href="/personal/basket/" class="list-group-item"><img src="/tpl/images/lkbasket.png">Корзина</a>
*/
?>
<?
$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "smallCart", Array(
	"HIDE_ON_BASKET_PAGES" => "N",	// Не показывать на страницах корзины и оформления заказа
		"PATH_TO_AUTHORIZE" => "",	// Страница авторизации
		"PATH_TO_BASKET" => SITE_DIR."personal/basket/",	// Страница корзины
		"PATH_TO_ORDER" => SITE_DIR."personal/ordering/",	// Страница оформления заказа
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
		"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
		"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
		"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
		"SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
		"SHOW_EMPTY_VALUES" => "N",	// Выводить нулевые значения в пустой корзине
		"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
		"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
		"SHOW_PRODUCTS" => "N",	// Показывать список товаров
		"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
?>
<a href="/personal/subscription/" class="list-group-item"><img src="/tpl/images/lkmenu3.png">Подписка на рассылку</a>

<? if ( CSite::InGroup(array(1)) ) {?>
<a href="/personal/moderation/" class="list-group-item"><img src="/tpl/images/lkmenu3.png">Модерация</a>

<? } ?>