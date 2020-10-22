<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use \Bitrix\Main\Loader;
use \Bitrix\Main\UserGroupTable;

?>

<?
// GRANT ALL PRIVILEGES ON *.* TO 'segmentRemote'@'%' IDENTIFIED BY 'Pass_098_word' WITH GRANT OPTION;

// exit('EXIT function');
define ('LIMIT', 'ORDER BY `id` ASC LIMIT 0, 21000');
global $USER;
if ($USER->IsAdmin())
{

global $DB;

function file_exists_my($path)
{
	$result = false;
// pre('path - ' . $path);
	if (!empty($path))
	{
		// файл, который мы проверяем
		$headers = @get_headers($path);
		// проверяем ли ответ от сервера с кодом 200 - ОК
		//if(preg_match("|200|", $headers[0])) { // - немного дольше :)
		// if (strpos('200', $headers[0]))
		if ( preg_match('/HTTP\/\d\.\d\s200\sOK/', $headers[0]) )
			$result = true;
	}
// pre('res - ' . $result);

	return $result;
}

// В коде анархия - много дубляжа но для одноразовой цели сойдёт.
	if (isset($_GET['blockId']) && !empty($_GET['blockId']))
	{
		if (!Loader::includeModule('iblock'))
			exit('Loader::includeModule("iblock") FAIL');

		// $host = '84.52.108.254';
		$host = '192.168.101.80';
        $database = 'segment_ru';
        $user = 'segmentRemote';
        $password = 'Pass_098_word';

        try
		{
            $instance = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

			switch ($_GET['blockId'])
			{
				case IBLOCK_ID_CATALOG:
				{
					set_time_limit(600);

					$counter = 0;
					$errorArray = array();
					$query = "SELECT * FROM `contents` WHERE `status` = '1' AND `module_id` = '7' " . LIMIT;
					$statement = $instance->query($query);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach ($result as $key => $value)
					{
						$arFields = array();

						// Проверим, может этот элемент уже есть.
						$strSql = "SELECT `ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_OLD_ID_IN_CATALOG . "' AND `VALUE` = '" . $value['id'] . "'";
						$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						if ($elId = $item->GetNext())
							continue;


						// Узнаем ID фирмы.
						$firmId = '';
						if (!empty($value['user_id']))
						{
							// Узнаем id компании к которой надо привязать элемент.
							$strSql = "SELECT `idFirm_new` FROM `user_firm` WHERE `idUser_old` = '" . $value['user_id'] . "'";
							$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($firmId = $item->GetNext())
								$firmId = $firmId['idFirm_new'];
						}


						$categoryId = '';
						// Узнаем новый ID категории.
						$strSql = "SELECT `VALUE_ID` FROM `b_uts_iblock_3_section` WHERE `UF_OLD_ID` = '" . $value['cat_id'] . "'";
						$catObj = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						if ($valueId = $catObj->GetNext())
							$categoryId = $valueId['VALUE_ID'];


						// Картинка.
						$query = "SELECT `path`, `ext` FROM `attaches` WHERE `content_id` = '" . $value['id'] . "'";
						$statement = $instance->query($query);
						$image = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach ($image as $key0 => $img)
						{
							$path = 'http://www.segment.ru' . $img['path'] . '.' . $img['ext'];
							if (file_exists_my($path))
							{
								if (0 == (int)$key0)
									$arFields['PREVIEW_PICTURE'] = CFile::MakeFileArray($path);
								elseif (1 == (int)$key0)
									$arFields['DETAIL_PICTURE'] = CFile::MakeFileArray($path);
								else
									$arFields['PROPERTY_VALUES'][PROPERTY_ID_ADD_PHOTO_IN_CATALOG][$key0] = CFile::MakeFileArray($path);
							}
						}

						$arFields['NAME'] = str_replace(array("&quot;"), '"', $value['name']);
						$arFields['PREVIEW_TEXT'] = (!empty($value['anons']))? $value['anons']: '';
						$arFields['PREVIEW_TEXT_TYPE'] = 'html';
						$arFields['DETAIL_TEXT'] = $value['text'];
						$arFields['DETAIL_TEXT_TYPE'] = 'html';
						$arFields['CODE'] = !empty($value['url'])? $value['url']: Cutil::translit($value["name"], "ru", array()) . time();
						$arFields['ACTIVE'] = 'Y';
						$arFields["IBLOCK_SECTION_ID"] = $categoryId;
						$arFields["IBLOCK_ID"] = IBLOCK_ID_CATALOG;
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_COMPANY_ID_IN_CATALOG] = $firmId;
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_ARTICLE_IN_CATALOG] = $value['title'];
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_BRAND_IN_CATALOG] = $value['tags'];
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_OLD_ID_IN_CATALOG] = $value['id'];
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_HIT_IN_CATALOG] = (!empty($value['access']))? '54' : '';
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_PRICE_IN_CATALOG] = $value['description'];       // значение цены
						$arFields["API"] = true; // Для функии добавления в init.php - чтоб не делала элемент неактивным и не меняла CODE.
// pre($arFields);
// pre($arFields, EXIT_PRE);
						$el = new CIBlockElement();
						$newId = $el->Add($arFields);
						if ($newId)
						{
							// pre('<br>New id: ' . $newId . ', old id: ' . $value['id']);
						}
						else
							$errorArray[] = 'Old element id: ' . $value['id'] . ' Error: ' . $el->LAST_ERROR;

						++$counter;
						// break;
						// exit();
					}

					pre('Обработано элементов: ' . $counter);
					pre('Массив ошибок:');
					pre($errorArray);
					exit();
				}

				case 77777: // Перенос структуры каталога.
				{
					$errorArray = array();

					$query = "SELECT * FROM `categories` WHERE `sub_id` = '0' AND `module_id` = '7'";
					$statement = $instance->query($query);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach ($result as $key => $category)
					{
						$newSectionId = null;
						$arFields = array();
						// Проверим, есть ли такая категория в битриксе.
						$strSql = "SELECT * FROM `b_iblock_section` WHERE `CODE` = '" . $category['url'] . "' OR `NAME` = '" . $category['name'] . "' AND `IBLOCK_SECTION_ID` IS NULL";
						$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						$section = $res->GetNext();
						if (!$section)
						{
							// Если нет - создаём.
							$bs = new CIBlockSection;
							$arFields = Array(
								"ACTIVE" => 'Y',
								"NAME" => $category['name'],
								"CODE" => $category['url'],
								"IBLOCK_ID" => IBLOCK_ID_CATALOG,
								"UF_OLD_ID" => $category['id'],
							);

							$newSectionId = $bs->Add($arFields);
							if (!$newSectionId)
								$errorArray[] = 'Old id: ' . $category['id'] . ' - ' . $bs->LAST_ERROR;
						}


						// Выберем подкатегории.
						$sectionId = (isset($newSectionId))? $newSectionId: $section['ID'];
						$query = "SELECT * FROM `categories` WHERE `sub_id` = '" . $category['id'] . "' AND `module_id` = '7'";
						$statement = $instance->query($query);
						$resultSub = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach ($resultSub as $key0 => $subCategory)
						{
							$newSubSectionId = null;

							// Проверим, есть ли такая подкатегория в битриксе.
							$strSql = "SELECT * FROM `b_iblock_section` WHERE `CODE` = '" . $subCategory['url'] . "' OR `NAME` = '" . $subCategory['name'] . "' AND `IBLOCK_SECTION_ID` = '" . $sectionId . "'";
							$res0 = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							$subSection = $res0->GetNext();
							if (!$subSection)
							{
								$bs = new CIBlockSection;
								$arFields = Array(
									"ACTIVE" => 'Y',
									"NAME" => $subCategory['name'],
									"CODE" => $subCategory['url'],
									"IBLOCK_ID" => IBLOCK_ID_CATALOG,
									"IBLOCK_SECTION_ID" => $sectionId,
									"UF_OLD_ID" => $subCategory['id'],
								);

								$newSubSectionId = $bs->Add($arFields);
								if (!$newSubSectionId)
									$errorArray[] = 'Old id: ' . $subCategory['id'] . ' - ' . $bs->LAST_ERROR;
							}
							else
							{
								// Если подкатегория есть, проверим CODE и имя и обновим при не совпадении данные - CODE и имя.
								if ( ($subSection['CODE'] != $subCategory['url']) || ($subSection['NAME'] != $subCategory['name']) )
								{
									$strSql = "UPDATE `b_iblock_section` SET `NAME` = '" . $subCategory['name'] . "', `CODE` = '" . $subCategory['url'] . "' WHERE `ID` = '" . $subSection['ID'] . "'";
									$resUpdate = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								}

								// Вставим старый id в свойство подкатегории.
								// Сначала проверим, может уже есть такое поле.
								$strSql = "SELECT `VALUE_ID` FROM `b_uts_iblock_3_section` WHERE `VALUE_ID` = '" . $subSection['ID'] . "' AND `UF_OLD_ID` = '" . $subCategory['id'] . "'";
								$valueId = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								if (!$valueId->GetNext())
								{
									$strSql = "INSERT INTO `b_uts_iblock_3_section` (VALUE_ID, UF_OLD_ID) VALUES ('" . $subSection['ID'] . "', '" . $subCategory['id'] . "')";
									$res1 = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								}
							}


							// Выберем подкатегории второго уровня вложенности.
							$subSectionId = (isset($newSubSectionId))? $newSubSectionId: $subSection['ID'];
							$query = "SELECT * FROM `categories` WHERE `sub_id` = '" . $subCategory['id'] . "' AND `module_id` = '7'";
							$statement = $instance->query($query);
							$resultSubL2 = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($resultSubL2 as $key1 => $subCategoryL2)
							{
								// Проверим, есть ли такая подкатегория в битриксе.
								$strSql = "SELECT * FROM `b_iblock_section` WHERE `CODE` = '" . $subCategoryL2['url'] . "' OR `NAME` = '" . $subCategoryL2['name'] . "' AND `IBLOCK_SECTION_ID` = '" . $subSectionId . "'";
								$res1 = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								$subSectionL2 = $res1->GetNext();
								if (!$subSectionL2)
								{
									$bs = new CIBlockSection;
									$arFields = Array(
										"ACTIVE" => 'Y',
										"NAME" => $subCategoryL2['name'],
										"CODE" => $subCategoryL2['url'],
										"IBLOCK_ID" => IBLOCK_ID_CATALOG,
										"IBLOCK_SECTION_ID" => $subSectionId,
										"UF_OLD_ID" => $subCategoryL2['id'],
									);

									$newSubSectionId = $bs->Add($arFields);
									if (!$newSubSectionId)
										$errorArray[] = 'Old id: ' . $subCategory['id'] . ' - ' . $bs->LAST_ERROR;
								}
								else
								{
									// Если подкатегория есть, проверим CODE и имя и обновим при не совпадении данные - CODE и имя.
									if ( ($subSectionL2['CODE'] != $subCategoryL2['url']) || ($subSectionL2['NAME'] != $subCategoryL2['name']) )
									{
										$strSql = "UPDATE `b_iblock_section` SET `NAME` = '" . $subCategoryL2['name'] . "', `CODE` = '" . $subCategoryL2['url'] . "' WHERE `ID` = '" . $subSectionL2['ID'] . "'";
										$resUpdate = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
									}

									// Вставим старый id в свойство подкатегории.
									// Сначала проверим, может уже есть такое поле.
									$strSql = "SELECT `VALUE_ID` FROM `b_uts_iblock_3_section` WHERE `VALUE_ID` = '" . $subSectionL2['ID'] . "' AND `UF_OLD_ID` = '" . $subCategoryL2['id'] . "'";
									$valueId = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
									if (!$valueId->GetNext())
									{
										$strSql = "INSERT INTO `b_uts_iblock_3_section` (VALUE_ID, UF_OLD_ID) VALUES ('" . $subSectionL2['ID'] . "', '" . $subCategoryL2['id'] . "')";
										$res1 = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
									}
								}
							}
						}
					}

					pre($errorArray);
					exit();
				}

				case IBLOCK_ID_NEWS_COMPANY:
				{
					// $query = "SELECT * FROM `contents` WHERE `user_id` > '1' AND `user_id` != '1' AND `user_id` != '0' AND `name` != '' AND `url` != '' AND `cat_id` = '21' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '231827' AND `user_id` > '1' AND `user_id` != '1' AND `user_id` != '0' AND `name` != '' AND `url` != '' AND `cat_id` = '21' " . LIMIT;
					// $query = "SELECT * 
// FROM  `contents` 
// WHERE  `user_id` >  '1'
// AND  `user_id` !=  '1'
// AND  `user_id` !=  '0'
// AND  `name` !=  ''
// AND  `url` !=  ''
// AND  `cat_id` =  '21'
// ORDER BY  `id` ASC 
// LIMIT 0 , 150";
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_NEWS_COMPANY;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_NEWS_COMPANY;
					$showLogoPropId = PROPERTY_ID_SHOW_LOGO_IN_NEWS_COMPANY;
					break;
				}

				case IBLOCK_ID_NEWS_INDUSTRY:
				{
					// $query = "SELECT * FROM `contents` WHERE `name` != '' AND `url` != '' AND `cat_id` = '330' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '231831' AND `name` != '' AND `url` != '' AND `cat_id` = '330' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_NEWS_INDUSTRY;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_NEWS_INDUSTRY;
					$showLogoPropId = PROPERTY_ID_SHOW_LOGO_IN_NEWS_INDUSTRY;
					break;
				}

				case IBLOCK_ID_NOVETLY:
				{
					// $query = "SELECT * FROM `contents` WHERE `name` != '' AND `url` != '' AND `cat_id` = '5' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '231836' AND `name` != '' AND `url` != '' AND `cat_id` = '5' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_NOVETLY;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_NOVETLY;
					$showLogoPropId = PROPERTY_ID_SHOW_LOGO_IN_NOVETLY;
					break;
				}

				case IBLOCK_ID_LICENSE:
				{
					$query = "SELECT * FROM `contents` WHERE `status` = '1' AND `module_id` = '57' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_LICENSE;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_LICENSE;
					$countryPropId = PROPERTY_ID_COUNTRY_IN_LICENSE;
					break;
				}

				case IBLOCK_ID_BRANDS:
				{
					$query = "SELECT * FROM `contents` WHERE `user_id` > 1 AND `user_edit` = 1 AND `status` = '1' AND `module_id` = '51' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_BRANDS;
					$propOldId = PROPERTY_ID_OLD_ID_IN_BRANDS;
					$countryPropId = PROPERTY_ID_COUNTRY_IN_BRANDS;
					break;
				}

				case IBLOCK_ID_ANALYTICS:
				{
					$query = "SELECT * FROM `contents` WHERE `id` > '230855' AND `status` = '1' AND `cat_id` = '337' " . LIMIT;
					$propOldId = PROPERTY_ID_OLD_ID_IN_ANALYTICS;
					break;
				}

				case IBLOCK_ID_LIFE_INDUSTRY:
				{
					$query = "SELECT * FROM `contents` WHERE `id` > '231248' AND `status` = '1' AND `cat_id` = '318' " . LIMIT;
					$propOldId = PROPERTY_ID_OLD_ID_IN_LIFE_INDUSTRY;
					break;
				}

				case IBLOCK_ID_PRODUCTS_REVIEW:
				{
					$query = "SELECT * FROM `contents` WHERE `id` > '201910' AND `status` = '1' AND `cat_id` = '341' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_PRODUCTS_REVIEW;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_PRODUCTS_REVIEW;
					$showLogoPropId = PROPERTY_ID_SHOW_LOGO_IN_PRODUCTS_REVIEW;
					break;
				}

				case IBLOCK_ID_GALLERY_VIDEO:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '372' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '229909' AND `status` = '1' AND `cat_id` = '372' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_VIDEO;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_GALLERY_VIDEO;
					break;
				}

				case IBLOCK_ID_GALLERY_PHOTO:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '325' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '230679' AND `status` = '1' AND `cat_id` = '325' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_PHOTO;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_GALLERY_PHOTO;
					break;
				}

				case IBLOCK_ID_VIEWPOINT:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '316' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '231200' AND `status` = '1' AND `cat_id` = '316' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_VIEWPOINT;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_VIEWPOINT;
					$addMaterialId = PROPERTY_ID_ADD_MATERIAL_IN_VIEWPOINT;
					break;
				}

				case IBLOCK_ID_STOCK:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '6' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '231798' AND `status` = '1' AND `cat_id` = '6' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_STOCK;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_STOCK;
					$addMaterialId = PROPERTY_ID_ADD_MATERIAL_IN_STOCK;
					$showLogoPropId = PROPERTY_ID_SHOW_LOGO_IN_STOCK;
					break;
				}

				case IBLOCK_ID_CATALOGS_PDF:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `module_id` = '56' " . LIMIT;
					$query = "SELECT * FROM `contents` WHERE `id` > '230605' AND `status` = '1' AND `module_id` = '56' " . LIMIT;
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_CATALOGS_PDF;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_CATALOGS_PDF;
					$countryPropId = PROPERTY_ID_COUNTRY_IN_CATALOGS_PDF;
					break;
				}

				case IBLOCK_ID_EVENTS:
				{
					$query = "SELECT * FROM `contents` WHERE `cat_id` = '331' AND `status` = '1' AND `field5` = '0' " . LIMIT;
					// $query = "SELECT COUNT(*) FROM `contents` WHERE `status` = '1' AND `cat_id` = '331' AND `field5` = '0' ORDER BY `id` ASC";
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_EVENTS;
					$propOldId  = PROPERTY_ID_OLD_ID_IN_EVENTS;
					break;
				}

				case IBLOCK_ID_PRICE_LISTS:
				{
					$query = "SELECT `id` FROM `firms` WHERE `status` = '1' " . LIMIT;
					$statement = $instance->query($query);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);

					set_time_limit(600);

					foreach ($result as $key => $value)
					{
						// Проверим прайс-листы.
						$query = "SELECT `id`, `path`, `ext`, `name` FROM `attaches` WHERE `user_id` = '" . $value['id'] . "' AND `content_id` = '-9' AND `status` = '1'";
						$statement = $instance->query($query);
						$price = $statement->fetchAll(PDO::FETCH_ASSOC);
						if (!empty($price[0]))
						{
							foreach ($price as $key0 => $priceId)
							{
								// Проверим, может такой прайс уже есть.
								$strSql = "SELECT `ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_OLD_ID_IN_PRICE_LIST . "' AND `VALUE` = '" . $priceId['id'] . "'";
								$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								if ($elId = $item->GetNext())
									continue;

								$companyId = '';
								$strSql = "SELECT `IBLOCK_ELEMENT_ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = ' " . PROPERTY_ID_OLD_ID . "' AND `VALUE` = '" . $value['id'] . "'";
								$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								if ($copmanyArray = $res->GetNext())
									$companyId = $copmanyArray['IBLOCK_ELEMENT_ID'];

								$arFields['NAME'] = $priceId['name'];
								$arFields['CODE'] = Cutil::translit($priceId["name"], "ru", array()) . time();
								$arFields['ACTIVE'] = 'Y';
								$arFields["IBLOCK_SECTION_ID"] = false;
								$arFields["IBLOCK_ID"] = IBLOCK_ID_PRICE_LISTS;
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_COMPANY_ID_IN_PRICE_LIST] = $companyId;
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_OLD_ID_IN_PRICE_LIST] = $priceId['id'];

								$file = '';
								if (file_exists_my('http://www.segment.ru' . $priceId['path'] . '.' . $priceId['ext']))
								{
									$file = array();
									$file = CFile::MakeFileArray('http://www.segment.ru' . $priceId['path'] . '.' . $priceId['ext']);
									$file["MODULE_ID"] = "main";
								}

								$arFields['PROPERTY_VALUES'][PROPERTY_ID_FILE_IN_PRICE_LIST] = $file;
								$arFields["API"] = true; // Для функии добавления в init.php - чтоб не делала элемент неактивным и не меняла CODE.


								$el = new CIBlockElement();
								$newId = $el->Add($arFields);
								if ($newId)
								{
									// pre($newId);
								}
								else
								{
									pre('error: ' . $newId->LAST_ERROR);
								}
							}
						}
					}

					exit('end');
				}

				case 99999:
				{
					exit('Таблица соответствий id городов уже есть.');

					// Составим таблицу соответствий ID городов из старой таблицы и ID городов в базе битрикса.
					$query = "SELECT `city_id`, `name` FROM `geo_city`";
					$statement = $instance->query($query);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach ($result as $key => $value)
					{
						$strSql = "SELECT ID, IBLOCK_SECTION_ID FROM `b_iblock_element` WHERE `IBLOCK_ID` = ' " . IBLOCK_ID_CITY . "' AND `NAME` LIKE '" . $value['name'] . "'";
						$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						if ($cityArray = $result->GetNext())
						{
							$strSql = "SELECT IBLOCK_SECTION_ID FROM `b_iblock_section` WHERE `IBLOCK_ID` = ' " . IBLOCK_ID_CITY . "' AND `ID` = '" . $cityArray['IBLOCK_SECTION_ID'] . "'";
							$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($regionArray = $result->GetNext())
								$regionId = $regionArray['IBLOCK_SECTION_ID'];

							$strSql = "INSERT INTO `temp` (cityidold, name, cityidcurrent, areaid, regionid) VALUES ('" . $value['city_id'] . "', '" . $value['name'] . "', '" . $cityArray['ID'] . "', '" . $cityArray['IBLOCK_SECTION_ID'] . "', '" . $regionId . "')";
							$DB->Query($strSql, false, "", array("ignore_dml"=>true));
						}
					}

					exit('<br>End');
				}

				case 88888:
				{
					// Синхронизируем пользователей с фирмами.
					$strSql = "SELECT * FROM `user_firm`";
					$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
					while ($linksArray = $result->GetNext())
					{
						// pre($linksArray, EXIT_PRE);
						if (!empty($linksArray['idFirm_new']))
						{
							// Там где заполнено поле idFirm_new - это запись "создатель компании".
							// Вставим id пользователя-создателя в свойство 'id пользователя' компании.
							// Вставим id пользователя-создателя в свойство сотрудники компании.
							// Привяжем пользователя к компании.
							// Сделаем его админом.

							// Привязываем пользователя к компании.
							$strSql = "UPDATE `b_uts_user` SET `UF_ID_COMPANY` = '" . $linksArray['idFirm_new'] . "' WHERE `UF_OLD_ID` = '" . $linksArray['idUser_old'] . "'";
							$DB->Query($strSql, false, "", array("ignore_dml"=>true));

							// Делаем его админом компании, но сначала проверим, не состоит ли он уже в группе админов компании.
							$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $linksArray['idUser_new'], 'GROUP_ID' => ID_GROUP_COMPANY_ADMIN)));
							if (!$row = $res->fetch())
							{
								if ('0' != $linksArray['idUser_new'])
									UserGroupTable::add(array('GROUP_ID' => ID_GROUP_COMPANY_ADMIN, 'USER_ID' => $linksArray['idUser_new'])); // Добавить группу.
							}

							// Добавим id пользователя-создателя в сотрудники компании.
							$strSql = "INSERT INTO `b_iblock_element_property` (IBLOCK_PROPERTY_ID,
																				IBLOCK_ELEMENT_ID,
																				VALUE)
																					VALUES ('" . PROPERTY_ID_STAFF . "',
																							'" . $linksArray['idFirm_new'] . "',
																							'" . $linksArray['idUser_new'] . "')";
							$DB->Query($strSql, false, "", array("ignore_dml"=>true));

							// Добавим id пользователя-создателя в свойство 'id пользователя' компании.
							// Проверим, есть ли такая запись.
							$strSql = "SELECT `ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_USER_ID . "' AND `IBLOCK_ELEMENT_ID` = '" . $linksArray['idFirm_new'] . "'";
							$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($id = $item->GetNext())
							{
								// Если есть, обновляем.
								// $strSql = "UPDATE `b_iblock_element_property` SET `VALUE` = '" . $linksArray['idUser_new'] . "' WHERE `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_USER_ID . "' AND `IBLOCK_ELEMENT_ID` = '" . $linksArray['idFirm_new'] . "'";
								$strSql = "UPDATE `b_iblock_element_property` SET `VALUE` = '" . $linksArray['idUser_new'] . "' WHERE `ID` = '" . $id['ID'] . "'";
							}
							else
							{
								// Если нет - добавляем.
								$strSql = "INSERT INTO `b_iblock_element_property` (IBLOCK_PROPERTY_ID,
																					IBLOCK_ELEMENT_ID,
																					VALUE)
																						VALUES ('" . PROPERTY_ID_USER_ID . "',
																								'" . $linksArray['idFirm_new'] . "',
																								'" . $linksArray['idUser_new'] . "')";
							}

							$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						}
						else
						{
							// Если не заполнено поле idFirm_new - это сотрудники компании.
							// Возьмём запись по соответствию idFirm_old => idFirm_new - первые записи в таблице содержат idFirm_new.
							$strSql = "SELECT `idFirm_new` FROM `user_firm` WHERE `idFirm_old` = '" . $linksArray['idFirm_old'] . "'";
							$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($firmId = $item->GetNext())
							{
								// Привязываем пользователя к компании.
								$strSql = "UPDATE `b_uts_user` SET `UF_ID_COMPANY` = '" . $firmId['idFirm_new'] . "' WHERE `UF_OLD_ID` = '" . $linksArray['idUser_old'] . "'";
								$DB->Query($strSql, false, "", array("ignore_dml"=>true));

								// Добавим id пользователя в сотрудники компании.
								$strSql = "INSERT INTO `b_iblock_element_property` (IBLOCK_PROPERTY_ID,
																					IBLOCK_ELEMENT_ID,
																					VALUE)
																						VALUES ('" . PROPERTY_ID_STAFF . "',
																								'" . $firmId['idFirm_new'] . "',
																								'" . $linksArray['idUser_new'] . "')";
								$DB->Query($strSql, false, "", array("ignore_dml"=>true));

								// Делаем его сотрудником, но сначала проверим, не состоит ли он в группе сотрудников.
								$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $linksArray['idUser_new'], 'GROUP_ID' => ID_GROUP_COMPANY_STAFF)));
								if (!$row = $res->fetch())
								{
									if ('0' != $linksArray['idUser_new'])
										UserGroupTable::add(array('GROUP_ID' => ID_GROUP_COMPANY_STAFF, 'USER_ID' => $linksArray['idUser_new'])); // Добавить группу.
								}
							}
						}
					}

					// Остались записи где idFirm_new == 0. Заполним их для дальшейшего удобства пользования таблицей user_firm для переноса остального контента.
					$strSql = "SELECT `id`, `idFirm_old` FROM `user_firm` WHERE `idFirm_new` = '0'";
					$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
					while ($linksArray = $result->GetNext())
					{
						$strSql = "SELECT `idFirm_new` FROM `user_firm` WHERE `idFirm_new` != '' AND `idFirm_old` = '" . $linksArray['idFirm_old'] . "'";
						$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						if ($id = $res->GetNext())
						{
							$strSql = "UPDATE `user_firm` SET `idFirm_new` = '" . $id['idFirm_new'] . "' WHERE `id` = '" . $linksArray['id'] . "'";
							$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
						}
					}

					exit('<br>End');
				}

				case IBLOCK_ID_USERS:
				{
					set_time_limit(600);
					$query = "SELECT * FROM `users` WHERE `status` = 1 AND `mail` !=  '' AND `pass` !=  '' " . LIMIT;
					$statement = $instance->query($query);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					// foreach ($result as $key => $value)
					// {
						// pre($value['id'] . '::' . $value['mail']);
					// }
					// exit();
					foreach ($result as $key => $value)
					{
						if ('1' == $value['id'])
							continue;

						$arIMAGE = '';
						if (!empty($value['avatar']))
						{
							if (file_exists_my('http://www.segment.ru' . $value['avatar']))
							{
								$arIMAGE = array();
								$arIMAGE = CFile::MakeFileArray('http://www.segment.ru' . $value['avatar'] . '.' . $value['avatar_ext']);
								$arIMAGE["MODULE_ID"] = "main";
							}
						}

						$user = new CUser;
						$arFields = Array(
							"NAME"              => $value["first_name"],
							"LAST_NAME"         => $value["last_name"],
							"SECOND_NAME"       => $value["patronymic"],
							"EMAIL"             => trim($value["mail"]),
							"LOGIN"             => trim($value["mail"]),
							"LID"               => $value["ru"],
							"ACTIVE"            => "Y",
							"GROUP_ID"          => array(ID_GROUP_USER),
							"PASSWORD"          => $value["pass"],
							"CONFIRM_PASSWORD"  => $value["pass"],
							"PERSONAL_WWW"      => $value["home"],
							"PERSONAL_CITY"     => $value["city"],
							"PERSONAL_COUNTRY"  => $value["country"],
							"PERSONAL_BIRTHDAY" => (0 == $value["happy"])? '': date("d.m.Y" , $value["happy"]),
							"PERSONAL_GENDER"   => ('1' == $value["sex"])? 'F': 'M',
							"UF_NICKNAME"       => $value["nick"],
							"UF_NAME_OR_LOGIN"  => ('1' == $value["view"])? '1': '2',
							"UF_OLD_ID"         => $value["id"],
							"PERSONAL_PHOTO"    => $arIMAGE
						);

						$userRes = $USER->GetByLogin($value['mail']);
						if ($arUser = $userRes->Fetch())
						{
							$arFields['EMAIL'] = 'double2_' . trim($value["mail"]);
							$arFields['LOGIN'] = 'double2_' . trim($value["mail"]);
						}

						$ID = $user->Add($arFields);
						if ((int)$ID > 0)
						{
							// Обновим таблицу соответствий фирма->пользователь.
							// Если есть поле dop1 то пользователь закрёплён за компанией в качестве сотрудника.
							if (!empty($value["dop1"]))
							{
								// $strSql = "SELECT * FROM `user_firm` WHERE `idFirm_old` = '" . $value['dop1'] . "' AND `idUser_old` = '" . $value['id'] . "'";
								// $res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								// if ($id = $res->GetNext())
								// {
									
								// }
								// else
								// {
									$strSql = "INSERT INTO `user_firm` (idFirm_old, idUser_old, idUser_new) VALUES ('" . $value['dop1'] . "', '" . $value['id'] . "', '" . $ID . "')";
									$DB->Query($strSql, false, "", array("ignore_dml"=>true));
								// }
							}
							else
							{
								$strSql = "UPDATE `user_firm` SET `idUser_new` = '" . $ID . "' WHERE `idUser_old` = '" . $value["id"] . "'";
								$DB->Query($strSql, false, "", array("ignore_dml"=>true));
							}
						}
						else
						{
							echo '<br>Пользователь ' . $value["id"] . ' - ' . $value["mail"] . ' ' . $user->LAST_ERROR;
							//break;
						}

						// break;
					}

					exit('<br>End');
				}

				case IBLOCK_ID_COMPANY:
				{
					$query = "SELECT * FROM `firms` WHERE `status` = '1' " . LIMIT;
					break;
				}

				case IBLOCK_ID_DEFAULTERS:
				{
					$query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '312'";
					$propOldId = PROPERTY_ID_OLD_ID_IN_DEFAULTERS;
					break;
				}

				case 66666:
				{
					// $query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '313'";
					$query = "SELECT * FROM `contents` WHERE `status` = '1' AND `cat_id` = '313'";
					$propOldId = PROPERTY_ID_OLD_ID_IN_DEFAULTERS;
					break;
				}

				default:
					exit('Нет id блока.');
			}


            $statement = $instance->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

			set_time_limit(600);
			if (IBLOCK_ID_COMPANY == $_GET['blockId'])
			{
				$fd = fopen('log.log', 'a') or exit("Не удалось открыть файл.");
				$counter = 0;
				foreach ($result as $key => $value)
				{
					// Перенос картинок.
					/*
					if (!empty($value['logo']))
					{
						// файл, который мы проверяем
						$url = 'http://www.segment.ru' . $value['logo'];
						$headers = @get_headers($url);
						// проверяем ли ответ от сервера с кодом 200 - ОК
						//if(preg_match("|200|", $headers[0])) { // - немного дольше :)
						// if (strpos('200', $headers[0]))
						if ( preg_match('/HTTP\/\d\.\d\s200\sOK/', $headers[0]) )
						{
							$prewPic = CFile::MakeFileArray('http://www.segment.ru' . $value['logo']);
							$fId = CFile::SaveFile($prewPic, "company");
							// pre($fId);
							if ($fId)
							{
								// pre('valid ' . $value['id']);
								$strSql = "SELECT `IBLOCK_ELEMENT_ID` FROM `b_iblock_element_property` WHERE `ID` > '171471' AND `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_OLD_ID . "'
																									     AND `VALUE` = '" . $value['id'] . "'";
								$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
								if ($elId = $res->GetNext())
								{
									// pre($elId);
									$strSql = "UPDATE `b_iblock_element` SET `PREVIEW_PICTURE` = '" . $fId . "' WHERE `ID` = '" . $elId["IBLOCK_ELEMENT_ID"] . "'";
									$DB->Query($strSql, false, "", array("ignore_dml"=>true));
								}
							}
						}
					}

					continue;
					*/

					if (!empty($value['type']))
					{
						$sections = $arFields = array();
						$companyTypes = unserialize($value['type']);
						foreach ($companyTypes as $key => $typeNum)
						{
							switch ($typeNum)
							{
								case 0: $typeNum = COMPANY_CATEGORY_MANUFATRURERS;     break;
								case 1: $typeNum = COMPANY_CATEGORY_WHOLESALERS;       break;
								case 2: $typeNum = COMPANY_CATEGORY_RETAIL_TRADE;      break;
								case 3: $typeNum = COMPANY_CATEGORY_INDUSTRY_MEDIA;    break;
								case 6: $typeNum = COMPANY_CATEGORY_SUPPLY_OF_OFFICES; break;
								case 7: $typeNum = COMPANY_CATEGORY_ONLINE_SHOPPING;   break; 
								case 11: $typeNum = COMPANY_CATEGORY_IMPORTERS;        break;

								case 12:
								{
									$typeNum = COMPANY_CATEGORY_LICENSING_AGENCIES;
									break;
								}

								case 13:
								{
									$typeNum = COMPANY_CATEGORY_SUPPLIERS;
									break;
								}

								case 14:
								{
									$typeNum = COMPANY_CATEGORY_PUBLISHERS;
									break;
								}
							}

							$sections[] = $typeNum;
						}
					}
					else
					{
						// По умолчанию запихаем в категорию производители...
						$sections = 3;
					}

					$arFields['NAME'] = str_replace(array("&quot;"), '"', $value['name']);
					$arFields['PREVIEW_TEXT'] = $value['info'];
					$arFields['PREVIEW_TEXT_TYPE'] = 'html';
					$arFields['CODE'] = !empty($value['val1'])? $value['val1']: Cutil::translit($value["name"], "ru", array()) . time();
					$arFields['ACTIVE'] = 'Y';
					$arFields["IBLOCK_SECTION"] = $sections;
					$arFields["IBLOCK_ID"] = IBLOCK_ID_COMPANY;
					$arFields["DATE_CREATE"] = date('d.m.Y H:i:s', $value['time_create']);

					//-----------------------------------------------------
					// Добавление города.
					$cityId = null;
					if (is_numeric($value['city']))
						$strSql = "SELECT * FROM `temp` WHERE `cityidold` = '" . $value['city'] . "'";
					else
						$strSql = "SELECT * FROM `temp` WHERE `name` = '" . $value['city'] . "'";

					$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
					if ($cityArr = $result->GetNext())
					{
						$cityId = $cityArr['cityidcurrent'];
						$areaId = $cityArr['areaid'];
						$regionId = $cityArr['regionid'];

						$arFields['PROPERTY_VALUES'][PROPERTY_ID_REGION] = $regionId;
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_AREA] = $areaId;
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_CITY] = $cityId;
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_COUNTRY] = 'Россия';
					}

					// Если nul === cityId то поставим город в поле "Город введённый пользователем"
					if (null === $cityId) {
						$city = $region = $country = '';
						if ('Одесса' === $value['city']) {
							$city = 'Одесса';
							$region = 'Одесская обл.';
							$country = 'Украина';
						} elseif ('Минск' === $value['city']) {
							$city = 'Минск';
							$region = 'Минская обл.';
							$country = 'Белоруссия';
						} else {
							if (is_numeric($value['city']))
								$query = "SELECT `name`, `country_id`, `region_id` FROM `geo_city` WHERE `city_id` = '" . $value['city'] . "'";
							else
								$query = "SELECT `name`, `country_id`, `region_id` FROM `geo_city` WHERE `name` = '" . $value['city'] . "'";

							$statementCity = $instance->query($query);
							$cityArr = $statementCity->fetchAll(PDO::FETCH_ASSOC);
							if (!empty($cityArr[0])) {
								$city = $cityArr[0]['name'];

								$query = "SELECT `name` FROM `geo_region` WHERE `region_id` = '" . $cityArr[0]['region_id'] . "'";
								$statementRegion = $instance->query($query);
								$regionArr = $statementRegion->fetchAll(PDO::FETCH_ASSOC);
								if (!empty($regionArr[0]))
									$region = $regionArr[0]['name'];

								$query = "SELECT `name` FROM `geo_country` WHERE `country_id` = '" . $cityArr[0]['country_id'] . "'";
								$statementCountry = $instance->query($query);
								$countryArr = $statementCountry->fetchAll(PDO::FETCH_ASSOC);
								if (!empty($countryArr[0]))
									$country = $countryArr[0]['name'];
							} else {
								$city = $value['city'];
							}
						}

						// Страна.
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_COUNTRY] = $country;

						// Регион.
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_USER_REGION] = $region;

						// Город.
						$arFields['PROPERTY_VALUES'][PROPERTY_ID_USER_CITY] = $city;
					}
					//-----------------------------------------------------

					//-----------------------------------------------------
					// Добавление пользователя.
					// Временно поставим всем компаниям номер пользователя 1. Потом когда будут добавлены пользователи - проставим соответствие.
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_USER_ID] = 1;
					//-----------------------------------------------------

					$arFields['PROPERTY_VALUES'][PROPERTY_ID_OLD_ID] = $value['id'];
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_FAX] = $value['fax'];
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_PHONE] = (!empty($value['telefon']))? $value['telefon']: 'Не указан';
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_ADDRESS] = (!empty($value['adres']))? $value['adres']: 'Не указан';
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_EMAIL] = $value['email'];
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_COMPANY_WEBSITE] = $value['site'];
					$arFields['PROPERTY_VALUES'][PROPERTY_ID_RATING] = $value['rating'];

					//-----------------------------------------------------
					// Лого компании.

					if (!empty($value['logo']))
					{
						// файл, который мы проверяем
										// $url = 'http://www.segment.ru' . $value['logo'];
										// $headers = @get_headers($url);
						// проверяем ли ответ от сервера с кодом 200 - ОК
						//if(preg_match("|200|", $headers[0])) { // - немного дольше :)
						// if (strpos('200', $headers[0]))
										// if ( preg_match('/HTTP\/\d\.\d\s200\sOK/', $headers[0]) )
											// $arFields['PREVIEW_PICTURE'] = CFile::MakeFileArray('http://www.segment.ru' . $value['logo']);

						if (file_exists_my('http://www.segment.ru' . $value['logo']))
						{
							$tmpArray = CFile::MakeFileArray('http://www.segment.ru' . $value['logo']);
							if ('application/CDFV2-corrupt' !== $tmpArray['type'] && 'application/msword' !== $tmpArray['type'] && 'application/octet-stream' !== $tmpArray['type']
								&& 'application/pdf' !== $tmpArray['type']
								&& 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' !== $tmpArray['type']
								&& 'application/vnd.oasis.opendocument.graphics' !== $tmpArray['type'])
								$arFields['PREVIEW_PICTURE'] = $tmpArray;
							// if ('image/gif' === $tmpArray['type'] && 'image/png' === $tmpArray['type'] && 'image/jpeg' === $tmpArray['type'] && 'image/x-ms-bmp' === $tmpArray['type'])
								// $arFields['PREVIEW_PICTURE'] = $tmpArray;
						}
					}
					//-----------------------------------------------------

					$arFields["API"] = true; // Для функии добавления в init.php - чтоб не делала элемент неактивным и не меняла CODE.
					// pre($arFields, EXIT_PRE);

					$el = new CIBlockElement();
					if ($newId = $el->Add($arFields))
					{
						// Составим таблицу соответствий фирма->пользователь.
						// echo $newId . '<br>';
						$strSql = "INSERT INTO `user_firm` (idFirm_old, idFirm_new, idUser_old) VALUES ('" . $value['id'] . "', '" . $newId . "', '" . $value['user_id'] . "')";
						$DB->Query($strSql, false, "", array("ignore_dml"=>true));
					}
					else
					{
						$tmp = serialize($arFields);
						fwrite($fd, $tmp);
						pre($arFields);
						echo 'Error: ' . $el->LAST_ERROR;
						echo '<br>FIRM_OLD_ID: ' . $value['id'];
						break;
					}

					++$counter;
				}

				fclose($fd);

				exit('<br>End, обработано записей: ' . $counter);
			}
			else
			{
				$counter = 0;
				foreach ($result as $key => $value)
				{
					$arFields = array();

					// $strSql = "SELECT `ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = '" . $propOldId . "' AND `VALUE` = '" . $value['id'] . "'";
					// $item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
					// if ($elId = $item->GetNext())
						// continue;

					$firmId = '';
					if (IBLOCK_ID_NEWS_INDUSTRY != $_GET['blockId'] && IBLOCK_ID_ANALYTICS != $_GET['blockId'] && IBLOCK_ID_LIFE_INDUSTRY != $_GET['blockId'])
					{
						if (!empty($value['user_id']))
						{
							// Узнаем id компании к которой надо привязать элемент.
							$strSql = "SELECT `idFirm_new` FROM `user_firm` WHERE `idUser_old` = '" . $value['user_id'] . "' AND `idFirm_new` != '0'";
							$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($firmId = $item->GetNext())
								$firmId = $firmId['idFirm_new'];
						}
					}

					switch ($_GET['blockId'])
					{
						case IBLOCK_ID_LICENSE:
						case IBLOCK_ID_BRANDS:
						case IBLOCK_ID_CATALOGS_PDF:
						{
							$countryId = '';
							if (!empty($value['description']))
							{
								$countryArray = GetCountryArray();
								$key = array_keys($countryArray['reference'], $value['description']);
								$countryId = $countryArray['reference_id'][$key[0]];
							}

							$arFields['PROPERTY_VALUES'][$countryPropId] = $countryId;

							break;
						}

						case IBLOCK_ID_GALLERY_VIDEO:
						{
							$tmp = explode('<iframe', $value['text']);
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_VIDEO_LINK_IN_GALLERY_VIDEO] = '<iframe ' . $tmp[1] . '</iframe>';

							break;
						}

						case IBLOCK_ID_GALLERY_PHOTO:
						{
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO] = array();
							$tmp = explode('<img src="../../../../..', $value['text']);
							foreach ($tmp as $key0 => $src)
							{
								if (!empty($src))
								{
									$tmpSrc = explode('"', $src);
									if (file_exists_my('http://www.segment.ru' . $tmpSrc[0]))
										$arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO][] = CFile::MakeFileArray('http://www.segment.ru' . $tmpSrc[0]);
									// pre($tmpSrc);
								}
							}

							if (empty($arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO]))
							{
								$query = "SELECT `path`, `ext` FROM `attaches` WHERE `content_id` = '" . $value['id'] . "'";
								$statement = $instance->query($query);
								$img = $statement->fetchAll(PDO::FETCH_ASSOC);
								if (!empty($img[0]))
								{
									foreach ($img as $key0 => $image)
									{
										if (file_exists_my('http://www.segment.ru' . $image['path'] . '.' . $image['ext']))
											$arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO][] = CFile::MakeFileArray('http://www.segment.ru' . $image['path'] . '.' . $image['ext']);
									}
								}
								// pre($arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO]);
								// exit("arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO]");
							}

							// pre($arFields['PROPERTY_VALUES'][PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO], EXIT_PRE);
							break;
						}

						case IBLOCK_ID_STOCK:
						case IBLOCK_ID_VIEWPOINT:
						{
							$arFields['PROPERTY_VALUES'][$addMaterialId] = array();
							$query = "SELECT `also_1`, `also_2`, `also_3` FROM `seealso_contents` WHERE `content_id` = '" . $value['id'] . "'";
							$statement = $instance->query($query);
							$res = $statement->fetchAll(PDO::FETCH_ASSOC);
							if (!empty($res[0]))
							{
								foreach ($res[0] as $key0 => $seeAlsoId)
								{
									if ('0' != $seeAlsoId)
									{
										$strSql = "SELECT `IBLOCK_ELEMENT_ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` >= '" . PROPERTY_ID_OLD_ID . "' AND `IBLOCK_PROPERTY_ID` <= '" . PROPERTY_ID_OLD_ID_IN_CATALOGS_PDF . "' AND `VALUE` = '" . $seeAlsoId . "'";
										$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
										if ($elId = $item->GetNext())
											$arFields['PROPERTY_VALUES'][$addMaterialId][] = $elId['IBLOCK_ELEMENT_ID'];
									}
								}
							}

							break;
						}

						case IBLOCK_ID_EVENTS:
						{
							if ($value['id'] >= '183184' && $value['id'] <= '230216')
							{
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_BEGIN_DATE_IN_EVENTS] = '';
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_END_DATE_IN_EVENTS] = '';
							}
							else
							{
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_BEGIN_DATE_IN_EVENTS] = '20.05.2016';
								$arFields['PROPERTY_VALUES'][PROPERTY_ID_END_DATE_IN_EVENTS] = '23.05.2016';
							}

							break;
						}

						case IBLOCK_ID_DEFAULTERS:
						case 66666: // Бывшие неплательщики.
						{
							$strSql = "SELECT `ID` FROM `b_iblock_element` WHERE `NAME` LIKE '" . $value['field4'] . "' AND `IBLOCK_ID` = '" . IBLOCK_ID_CITY . "'";
							$item = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
							if ($elId = $item->GetNext())
								$cityId = $elId['ID'];

							$arFields['DATE_CREATE'] = date('d.m.Y', $value['time_create']);
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_DEFAULTER_IN_DEFAULTERS] = (!empty($value['title']))? $value['title']: $value['name'];
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_AMOUNT_OF_DEBT_DOC_IN_DEFAULTERS] = $value['guest'];
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_CITY_IN_DEFAULTERS] = $cityId;
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_APPLICANT_IN_DEFAULTERS] = (!empty($value['text']))? $value['text']: 'Не указан';
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_DEBT_IS_PAID_IN_DEFAULTERS] = (66666 == $_GET['blockId'])? '1': '';
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_DOCUMENT_IN_DEFAULTERS] = (!empty($value['keywords']))? $value['keywords']: 'Не указан';
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_DATE_BEGIN_DEF_IN_DEFAULTERS] = date('d.m.Y', strtotime($value['ip']));
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_AMOUNT_OF_DEBT_IN_DEFAULTERS] = $value['field1'];
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_REDEMTION_DATE_IN_DEFAULTERS] = date('d.m.Y', strtotime($value['field2']));
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_ADDRESS_OFFICE_DEF_IN_DEFAULTERS] = $value['tags'];
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_NAME_FOUNDER_IN_DEFAULTERS] = $value['description'];
							$arFields['PROPERTY_VALUES'][PROPERTY_ID_APPLICANT_CONTACT_IN_DEFAULTERS] = $value['field3'];

							break;
						}

						default:
							break;
					}

// pre('arFields:<br>');
// pre($arFields);
// pre('Prop id: ' . $propertyId);
// pre('Firm id: ' . $firmId);

// UPDATE `b_iblock_element` SET `PREVIEW_TEXT_TYPE` = 'html', `DETAIL_TEXT_TYPE` = 'html' WHERE `ID` >= 74215 AND `ID` <= 74720 AND `IBLOCK_ID` = '10'

					$imgPath = $img = null;
					$query = "SELECT `path`, `ext`, `status` FROM `attaches` WHERE `content_id` = '" . $value['id'] . "'";
					$statement = $instance->query($query);
					$img = $statement->fetchAll(PDO::FETCH_ASSOC);
					// pre($img);
					if (!empty($img[0]))
					{
						$imgPath = $img[0]['path'] . '.' . $img[0]['ext'];
						if (file_exists_my('http://www.segment.ru' . $imgPath))
							$arFields['PREVIEW_PICTURE'] = CFile::MakeFileArray('http://www.segment.ru' . $imgPath);
					}
					if (!empty($img[1]))
					{
						$path = 'http://www.segment.ru' . $img[1]['path'] . '.' . $img[1]['ext'];
						if (file_exists_my($path))
							$arFields['DETAIL_PICTURE'] = CFile::MakeFileArray($path);
					}

					$propertyEnums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"DESC", "VALUE"=>"ASC"), array("IBLOCK_ID" => $_GET['blockId'], 'CODE' => 'showLogo'));
					if ($enumFields = $propertyEnums->GetNext())
						$arFields['PROPERTY_VALUES'][$showLogoPropId] = $enumFields['ID'];

					$iBlockId = $_GET['blockId'];
					if (66666 == $_GET['blockId'])
						$iBlockId = IBLOCK_ID_DEFAULTERS;

					$arFields['NAME'] = str_replace(array("&quot;"), '"', $value['name']);
					$arFields['TAGS'] = $value['tags'];
					$arFields['PREVIEW_TEXT'] = (!empty($value['anons']))? $value['anons']: '';
					$arFields['PREVIEW_TEXT_TYPE'] = 'html';
					$arFields['DETAIL_TEXT'] = $value['text'];
					$arFields['DETAIL_TEXT_TYPE'] = 'html';
					$arFields['CODE'] = !empty($value['url'])? $value['url']: Cutil::translit($value["name"], "ru", array()) . time();
					$arFields['ACTIVE'] = 'Y';
					$arFields["IBLOCK_SECTION_ID"] = false;
					$arFields["IBLOCK_ID"] = $iBlockId;
					$arFields["DATE_CREATE"] = date('d.m.Y H:i:s', $value['time_create']);
					$arFields['PROPERTY_VALUES'][$propertyId] = $firmId;
					$arFields['PROPERTY_VALUES'][$propOldId] = $value['id'];
					$arFields["API"] = true; // Для функии добавления в init.php - чтоб не делала элемент неактивным и не меняла CODE.
// pre($arFields, EXIT_PRE);

					$el = new CIBlockElement();
					if ($newId = $el->Add($arFields))
					{
						// echo '<br>New id: ' . $newId . ', old id: ' . $value['id'];
					}
					else
						echo '<br>Old element id: ' . $value['id'] . ' Error: ' . $el->LAST_ERROR;

					++$counter;
					// break;
				}

				pre('Обработано записей: ' . $counter);

				$instance = null;
				unset($result);
			} // end if (IBLOCK_ID_COMPANY == $_GET['blockId']) else
        }
		catch (PDOException $e)
		{
            // pre('Ошибка соединения с базой данных! ' . $e->getMessage());
            exit('Ошибка соединения с базой данных '.$e->getMessage());
            // throw new Exception('Ошибка соединения с базой данных '.$e->getMessage());
        }
	}
}



/*
// Удаление элементов.
$strSql = "SELECT `ID` FROM `b_iblock_element` WHERE `IBLOCK_ID` = '" . IBLOCK_ID_CATALOG. "' AND `ID` >= '78815' AND `ID` <= '148554' ORDER BY `ID` ASC";
$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
while ($item = $res->GetNext())
{
	// pre($item['ID']);
	$DB->StartTransaction();
    if(!CIBlockElement::Delete($item['ID']))
    {
		// pre('!!');
        $strWarning .= 'Error!';
        $DB->Rollback();
    }
    else
	{
		// pre('OK');
        $DB->Commit();
	}

	// break;
}
	return true;
*/
?>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
