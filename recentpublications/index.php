<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Последние публикации");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1">
			<div class="row">
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/actualtoday.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/defaulters.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>	
				<?$APPLICATION->IncludeFile('/tpl/widgets/left/komments.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<?	// Разделение на список и детальную...
					if (CSite::InDir('/news/companynews/index.php'))
						$APPLICATION->IncludeFile('/tpl/widgets/left/photogallery.php', array(), array());
					else
						$APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array());?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
		<h1>Последние публикации</h1>
		<div class="block-default newsblock mainblockBig block-shadow">
<!-- <div class="news-block-scroll news-block-scroll-big segmentscroll"> -->
<div class="news-block-scroll">
<?
					// Новое на сайте.
					$GLOBALS['arrFilter'] = array("!PROPERTY_TOINDEX" => false);
					$APPLICATION->IncludeComponent("bitrix:news.index", "newOnSite", Array(
						"IBLOCKS" => array(	// Код информационного блока
								0 => "1",
								1 => "2",
								2 => "4",
								3 => "5",
								4 => "8",
								5 => "9",
								6 => "10",
								7 => "14",
								8 => "15",
								9 => "17",
							),
							"NEWS_COUNT" => "10",				// Количество новостей в каждом блоке
							"IBLOCK_SORT_BY" => "ID",			// Поле для сортировки информационных блоков
							"IBLOCK_SORT_ORDER" => "ASC",		// Направление для сортировки информационных блоков
							"SORT_BY1" => "ID",					// Поле для первой сортировки новостей
							"SORT_ORDER1" => "RAND",			// Направление для первой сортировки новостей
							"FIELD_CODE" => array(				// Поля
								0 => "SHOW_COUNTER",
								1 => "FORUM_MESSAGE_CNT",
								2 => "DATE_CREATE",
							),
							"PROPERTY_CODE" => array(			// Свойства
								0 => "",
								1 => "TOINDEX",
								2 => "actualToday",
								3 => "FORUM_MESSAGE_CNT",
								4 => "SHOW_COUNTER",
								5 => "DATE_CREATE",
							),
							"FILTER_NAME" => "arrFilter",		// Имя массива со значениями фильтра для фильтрации элементов
							"IBLOCK_URL" => "",					// URL, ведущий на страницу с содержимым раздела
							"DETAIL_URL" => "",					// URL, ведущий на страницу с содержимым элемента раздела
							"ACTIVE_DATE_FORMAT" => "d F Y",	// Формат показа даты
							"CACHE_TYPE" => "A",				// Тип кеширования
							"CACHE_TIME" => "36000000",			// Время кеширования (сек.)
							"CACHE_GROUPS" => "Y",				// Учитывать права доступа
							"COMPONENT_TEMPLATE" => "newOnSite",
							"IBLOCK_TYPE" => "khayr",			// Тип информационных блоков
							"SORT_BY2" => "SORT",				// Поле для второй сортировки новостей
							"SORT_ORDER2" => "ASC",				// Направление для второй сортировки новостей
						),
						false
					);
					?>
			</div>
			</div>
		</div>
	</div> <!-- end div class="row"> -->
</div> <!-- end div class="container-fluid"> -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>