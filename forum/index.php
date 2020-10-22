<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Форум");
?><?LocalRedirect("/404.php");?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1 content-margin">
			<div class="block-default block-shadow">
				<?$APPLICATION->IncludeComponent(
	"bitrix:forum", 
	"forumtpl", 
	array(
		"AJAX_POST" => "N",
		"ATTACH_MODE" => array(
			0 => "NAME",
		),
		"ATTACH_SIZE" => "90",
		"CACHE_TIME" => "3600",
		"CACHE_TIME_FOR_FORUM_STAT" => "3600",
		"CACHE_TIME_USER_STAT" => "60",
		"CACHE_TYPE" => "A",
		"CHECK_CORRECT_TEMPLATES" => "N",
		"DATE_FORMAT" => "d.m.Y",
		"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
		"EDITOR_CODE_DEFAULT" => "N",
		"FID" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "6",
			6 => "7",
			7 => "8",
			8 => "9",
			9 => "10",
			10 => "11",
			11 => "12",
			12 => "13",
			13 => "14",
			14 => "15",
			15 => "16",
			16 => "17",
			17 => "18",
			18 => "19",
			19 => "20",
			20 => "21",
			21 => "22",
		),
		"FORUMS_PER_PAGE" => "10",
		"HELP_CONTENT" => "",
		"IMAGE_SIZE" => "500",
		"MESSAGES_PER_PAGE" => "10",
		"NAME_TEMPLATE" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGE_NAVIGATION_TEMPLATE" => "custom",
		"PAGE_NAVIGATION_WINDOW" => "5",
		"PATH_TO_AUTH_FORM" => "",
		"RATING_ID" => array(
		),
		"RATING_TYPE" => "",
		"RESTART" => "N",
		"RULES_CONTENT" => "",
		"SEF_MODE" => "N",
		"SEND_MAIL" => "E",
		"SEO_USER" => "Y",
		"SEO_USE_AN_EXTERNAL_SERVICE" => "N",
		"SET_DESCRIPTION" => "N",
		"SET_NAVIGATION" => "N",
		"SET_PAGE_PROPERTY" => "N",
		"SET_TITLE" => "Y",
		"SHOW_AUTHOR_COLUMN" => "N",
		"SHOW_AUTH_FORM" => "Y",
		"SHOW_FIRST_POST" => "N",
		"SHOW_FORUMS" => "N",
		"SHOW_FORUM_ANOTHER_SITE" => "Y",
		"SHOW_FORUM_USERS" => "N",
		"SHOW_LEGEND" => "N",
		"SHOW_NAVIGATION" => "Y",
		"SHOW_RATING" => "",
		"SHOW_STATISTIC_BLOCK" => array(
		),
		"SHOW_SUBSCRIBE_LINK" => "N",
		"SHOW_TAGS" => "Y",
		"SHOW_VOTE" => "N",
		"THEME" => "blue",
		"TIME_INTERVAL_FOR_USER_STAT" => "10",
		"TMPLT_SHOW_ADDITIONAL_MARKER" => "",
		"TOPICS_PER_PAGE" => "10",
		"USER_FIELDS" => array(
			0 => "UF_FORUM_MES_URL_PRV",
		),
		"USER_PROPERTY" => array(
		),
		"USE_LIGHT_VIEW" => "N",
		"USE_NAME_TEMPLATE" => "N",
		"USE_RSS" => "Y",
		"WORD_LENGTH" => "50",
		"WORD_WRAP_CUT" => "23",
		"COMPONENT_TEMPLATE" => "forumtpl",
		"RSS_CACHE" => "1800",
		"RSS_TYPE_RANGE" => array(
		),
		"RSS_COUNT" => "30",
		"RSS_TN_TITLE" => "",
		"RSS_TN_DESCRIPTION" => "",
		"VARIABLE_ALIASES" => array(
			"FID" => "FID",
			"TID" => "TID",
			"MID" => "MID",
			"UID" => "UID",
		)
	),
	false
);?>
			</div>
		</div>
	</div>
</div>	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>