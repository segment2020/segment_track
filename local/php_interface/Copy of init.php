<?
include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");
use \Bitrix\Main\EventManager;
use \Bitrix\Main\Event;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\UserTable;


define('EXIT_PRE', true);
define('SITE_ID_FOR_SEND_EVENT', 's1');
define('DAYS_IN_MONHT', 31);
define('DAYS_IN_TWO_MONHT', 60);
define('DAYS_IN_ONE_YEAR', 365);
define('DAYS_IN_THREE_YEARS', 1095);
define('DAYS_IN_FIVE_YEARS', 1825);
define('COUNT_ADD_MATERIAL', 5);

define('EMPTY_LOGO_AVATAR_PATH', '/tpl/images/emptyPersonLogo.svg');
define('EMPTY_IMAGE_PATH', '/tpl/images/noPhoto.svg');

define('ID_GROUP_COMPANY_ADMIN', 5);
define('ID_GROUP_COMPANY_STAFF', 6);
define('ID_GROUP_USER', 7);


define('CHANGE_STATUS', 1);
define('FIRE_STAFF', 2);
define('NEW_STAFF', 3);
define('REVOKE', 4);


define('COMPANY_CATEGORY_MANUFATRURERS', 426);
define('COMPANY_CATEGORY_WHOLESALERS', 4); // Оптовики.
define('COMPANY_CATEGORY_IMPORTERS', 5);
define('COMPANY_CATEGORY_RETAIL_TRADE', 6);
define('COMPANY_CATEGORY_ONLINE_SHOPPING', 7);
define('COMPANY_CATEGORY_SUPPLY_OF_OFFICES', 8); // Снабжение офисов.
define('COMPANY_CATEGORY_INDUSTRY_MEDIA', 9);
define('COMPANY_CATEGORY_LICENSING_AGENCIES', 10);
define('COMPANY_CATEGORY_PUBLISHERS', 11);
define('COMPANY_CATEGORY_SUPPLIERS', 12);


define('IBLOCK_ID_COMPANY', 1);
define('IBLOCK_ID_NEWS_COMPANY', 2);
define('IBLOCK_ID_CATALOG', 3);
define('IBLOCK_ID_STOCK', 4);
define('IBLOCK_ID_NEWS_INDUSTRY', 5);
define('IBLOCK_ID_DEFAULTERS', 6);
define('IBLOCK_ID_CITY', 7);
define('IBLOCK_ID_ANALYTICS', 8);
define('IBLOCK_ID_LIFE_INDUSTRY', 9);
define('IBLOCK_ID_VIEWPOINT', 10);
define('IBLOCK_ID_GALLERY_PHOTO', 11);
define('IBLOCK_ID_GALLERY_VIDEO', 12);
define('IBLOCK_ID_EVENTS', 14);
define('IBLOCK_ID_PRODUCTS_REVIEW', 15);
define('IBLOCK_ID_PRICE_LISTS', 16);
define('IBLOCK_ID_BRANDS', 17);
define('IBLOCK_ID_LICENSE', 18);
define('IBLOCK_ID_INFOBLOCKS_LIST', 19);
define('IBLOCK_ID_NOVETLY', 20);
define('IBLOCK_ID_BANNERS', 21);
define('IBLOCK_ID_CATALOGS_PDF', 22);
define('IBLOCK_ID_USERS', 400);
define('PAGE_TOP_100', 500);
define('PAGE_ACTUAL_TODAY', 600);


// IBLOCK_ID_COMPANY
define('PROPERTY_ID_USER_ID', 1);            // Id пользователя.
define('PROPERTY_ID_CITY', 16);              // Город.
define('PROPERTY_ID_ADDRESS', 17);                          // Адрес.
define('PROPERTY_ID_PHONE', 19);                            // Телефон.
define('PROPERTY_ID_DATE_FOUNDATION', 20);                  // Дата основания.
define('PROPERTY_ID_CONTACT_PERSON', 21);                   // Контактное лицо.
define('PROPERTY_ID_REGION', 63);                           // Регион.
define('PROPERTY_ID_AREA', 64);                             // Область.
define('PROPERTY_ID_USER_CITY', 65);                        // Город введённый пользователем.
define('PROPERTY_ID_FAX', 66);                              // Факс.
define('PROPERTY_ID_EMAIL', 67);                            // Email.
define('PROPERTY_ID_COMPANY_WEBSITE', 68);                  // Сайт компании.
define('PROPERTY_ID_PRICE_LIST', 70);                       // Прайс-лист.
define('PROPERTY_ID_FORM_OF_OWNERSHIP', 97);                // Форма собственности.
define('PROPERTY_ID_SKYPE', 98);                            // Skype.
define('PROPERTY_ID_POSITION', 99);                         // Должность.
define('PROPERTY_ID_STAFF', 110);                           // Сотрудники.
define('PROPERTY_ID_RATING', 117);                          // Рейтинг.
define('PROPERTY_ID_TOTAL_VIEW', 118);                      // Общее количество просмотров.
define('PROPERTY_ID_PLACE_IN_RATING', 119);                 // Место в рейтинге.
define('PROPERTY_ID_DATE_UPDATE_RATING', 120);              // Дата обновления места в рейтинге.
define('PROPERTY_ID_CONDITION_EMP', 167);                   // Условия работы.
define('PROPERTY_ID_ADDRESS_ADD_OFFICES', 168);             // Адреса дополнительных офисов.
define('PROPERTY_ID_ADD_PHONE', 169);                       // Дополнительный телефон.
define('PROPERTY_ID_SOCIAL_NETWORK_VK', 170);               // Социальные сети VK.
define('PROPERTY_ID_SOCIAL_NETWORK_FB', 186);               // Социальные сети FB.
define('PROPERTY_ID_SOCIAL_NETWORK_GOOGLE', 187);           // Социальные сети Google+.
define('PROPERTY_ID_PAID_LICENSES_NUM', 188);               // Количество платных лицензий.
define('PROPERTY_ID_PAID_BRANDS_NUM', 191);                 // Количество платных брендов.
define('PROPERTY_ID_PAID_CATALOG_NUM', 194);                // Количество платных каталогов.
define('PROPERTY_ID_PAID_HITS_NUM', 197);                   // Количество платных хитов.
define('PROPERTY_ID_BEGIN_DATE_HITS', 198);                 // Дата начала действия хитов.
define('PROPERTY_ID_END_DATE_HITS', 199);                   // Дата окончания действия хитов.
define('PROPERTY_ID_SOCIAL_NETWORK_INSTAGRAMM', 223);       // Социальные сети instagram.
define('PROPERTY_ID_IN_MODERATION', 250);                   // На модерации.
define('PROPERTY_ID_OLD_ID', 251);                          // Старый ID.
define('PROPERTY_ID_COUNTRY', 288);                         // Страна.
define('PROPERTY_ID_USER_REGION', 289);                     // Область/регион введённый пользователем.

// IBLOCK_ID_NEWS_COMPANY
define('PROPERTY_ID_TEXT_IMG_SRC_IN_NEWS_COMPANY', 2);      // Текст на картинке.
define('PROPERTY_ID_NEWS_SRC_IN_NEWS_COMPANY', 3);          // Источник новости.
define('PROPERTY_ID_COMPANY_ID_IN_NEWS_COMPANY', 72);       // id компании.
define('PROPERTY_ID_PHOTO_SRC_IN_NEWS_COMPANY', 95);        // Источник фото.
define('PROPERTY_ID_ARCHIVE_IN_NEWS_COMPANY', 101);         // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_NEWS_COMPANY', 121);    // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_NEWS_COMPANY', 122);       // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_NEWS_COMPANY', 123);        // Причина отклонения публикации.
define('PROPERTY_ID_SHOW_LOGO_IN_NEWS_COMPANY', 162);       // Показывать лого компании на главной.
define('PROPERTY_ID_MOVE_TO_IN_NEWS_COMPANY', 176);         // Перенести в.
define('PROPERTY_ID_OLD_ID_IN_NEWS_COMPANY', 252);          // Старый Id.
define('PROPERTY_ID_MARKED_IN_NEWS_COMPANY', 277);          // Выделено.
define('PROPERTY_ID_MARKED_TO_IN_NEWS_COMPANY', 278);       // Дата до которого выделено.

// IBLOCK_ID_CATALOG
define('PROPERTY_ID_BRAND_IN_CATALOG', 206);                 // Бренд.
define('PROPERTY_ID_ARTICLE_IN_CATALOG', 207);               // Артикул.
define('PROPERTY_ID_LICENSES_IN_CATALOG', 208);              // Лицензии.
define('PROPERTY_ID_HIT_IN_CATALOG', 209);                   // Хит.
define('PROPERTY_ID_COMPANY_ID_IN_CATALOG', 210);            // id компании.
define('PROPERTY_ID_PRICE_IN_CATALOG', 212);                 // Служебное поле - цена.
define('PROPERTY_ID_OLD_ID_IN_CATALOG', 265);                // Старый Id.
define('PROPERTY_ID_ADD_PHOTO_IN_CATALOG', 279);             // Дополнительные фото.
define('PROPERTY_CODE_ADD_PHOTO_IN_CATALOG', 'additionalPhoto');             // Дополнительные фото.

// IBLOCK_ID_NEWS_INDUSTRY
define('PROPERTY_ID_TEXT_IMG_SRC_IN_NEWS_INDUSTRY', 4);      // Текст на картинке.
define('PROPERTY_ID_NEWS_SRC_IN_NEWS_INDUSTRY', 5);          // Источник новости.
define('PROPERTY_ID_COMPANY_ID_IN_NEWS_INDUSTRY', 87);       // id компании.
define('PROPERTY_ID_PHOTO_SRC_IN_NEWS_INDUSTRY', 96);        // Источник фото.
define('PROPERTY_ID_ARCHIVE_IN_NEWS_INDUSTRY', 102);         // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_NEWS_INDUSTRY', 155);    // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_NEWS_INDUSTRY', 156);       // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_NEWS_INDUSTRY', 157);        // Причина отклонения публикации.
define('PROPERTY_ID_SHOW_LOGO_IN_NEWS_INDUSTRY', 164);       // Показывать лого компании на главной.
define('PROPERTY_ID_MOVE_TO_IN_NEWS_INDUSTRY', 174);         // Перенести в.
define('PROPERTY_ID_OLD_ID_IN_NEWS_INDUSTRY', 253);          // Старый Id.
define('PROPERTY_ID_MARKED_IN_NEWS_INDUSTRY', 282);          // Выделено.
define('PROPERTY_ID_MARKED_TO_IN_NEWS_INDUSTRY', 283);       // Дата до которого выделено.

// IBLOCK_ID_DEFAULTERS
define('PROPERTY_ID_DEFAULTER_IN_DEFAULTERS', 8);            // Неплательщик.
define('PROPERTY_ID_AMOUNT_OF_DEBT_DOC_IN_DEFAULTERS', 10);  // Сумма долга по документу.
define('PROPERTY_ID_CITY_IN_DEFAULTERS', 11);                // Город.
define('PROPERTY_ID_APPLICANT_IN_DEFAULTERS', 12);           // Заявитель Id.
define('PROPERTY_ID_DEBT_IS_PAID_IN_DEFAULTERS', 13);        // Долг погашен.
define('PROPERTY_ID_DOCUMENT_IN_DEFAULTERS', 14);            // Документ по кот-му образовалась задолженность.
define('PROPERTY_ID_DATE_BEGIN_DEF_IN_DEFAULTERS', 15);      // Дата возникновения проср-ой зад-ти.
define('PROPERTY_ID_AMOUNT_OF_DEBT_IN_DEFAULTERS', 18);      // Просроченная сумма.
define('PROPERTY_ID_REDEMTION_DATE_IN_DEFAULTERS', 22);      // Дата погашения проср-ой зад-ти.
define('PROPERTY_ID_ADDRESS_OFFICE_DEF_IN_DEFAULTERS', 268); // Адрес фирмы неплательщика.
define('PROPERTY_ID_NAME_FOUNDER_IN_DEFAULTERS', 269);       // ФИО руководителя/учредителя фирмы неплательщика.
define('PROPERTY_ID_APPLICANT_CONTACT_IN_DEFAULTERS', 270);  // Контактное лицо заявителя.
define('PROPERTY_ID_OLD_ID_IN_DEFAULTERS', 271);             // Старый Id.

// IBLOCK_ID_STOCK
define('PROPERTY_ID_COMPANY_ID_IN_STOCK', 76);               // id компании.
define('PROPERTY_ID_ARCHIVE_IN_STOCK', 107);                 // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_STOCK', 133);            // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_STOCK', 135);               // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_STOCK', 134);                // Причина отклонения публикации.
define('PROPERTY_ID_SHOW_LOGO_IN_STOCK', 165);               // Показывать лого компании на главной.
define('PROPERTY_ID_MOVE_TO_IN_STOCK', 177);                 // Перенести в.
define('PROPERTY_ID_ADD_MATERIAL_IN_STOCK', 238);            // Доп. материал.
define('PROPERTY_ID_OLD_ID_IN_STOCK', 263);                  // Старый Id.
define('PROPERTY_ID_MARKED_IN_NEWS_STOCK', 284);             // Выделено.
define('PROPERTY_ID_MARKED_TO_IN_NEWS_STOCK', 285);          // Дата до которого выделено.

// IBLOCK_ID_ANALYTICS
define('PROPERTY_ID_COMPANY_ID_IN_ANALYTICS', 175); // id компании.
define('PROPERTY_ID_MOVE_TO_IN_ANALYTICS', 181); // Перенести в.
define('PROPERTY_ID_ADD_MATERIAL_IN_ANALYTICS', 200); // Доп. материал.
define('PROPERTY_ID_NEWS_SRC_IN_ANALYTICS', 203); // Источник новости.
define('PROPERTY_ID_OLD_ID_IN_ANALYTICS', 257); // Старый Id.

// IBLOCK_ID_LIFE_INDUSTRY
define('PROPERTY_ID_COMPANY_ID_IN_LIFE_INDUSTRY', 183); // id компании.
define('PROPERTY_ID_MOVE_TO_IN_LIFE_INDUSTRY', 184); // Перенести в.
define('PROPERTY_ID_ADD_MATERIAL_IN_LIFE_INDUSTRY', 201); // Доп. материал.
define('PROPERTY_ID_OLD_ID_IN_LIFE_INDUSTRY', 258); // Старый Id.

// IBLOCK_ID_VIEWPOINT
define('PROPERTY_ID_NAME_IN_VIEWPOINT', 28); // Имя.
define('PROPERTY_ID_SOURCE_IN_VIEWPOINT', 29); // Источник.
define('PROPERTY_ID_COMPANY_ID_IN_VIEWPOINT', 79); // id компании.
define('PROPERTY_ID_ARCHIVE_IN_VIEWPOINT', 109); // Архив - история изменений.
define('PROPERTY_ID_ADD_BLOCKID_IN_VIEWPOINT', 129); // Доп. материал - id блока.
define('PROPERTY_ID_ADD_ELEMENTID_IN_VIEWPOINT', 130); // Доп. материал - id элемента.
define('PROPERTY_ID_PUB_REJECTED_IN_VIEWPOINT', 145); // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_VIEWPOINT', 147); // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_VIEWPOINT', 146); // Причина отклонения публикации.
define('PROPERTY_ID_ADD_MATERIAL_IN_VIEWPOINT', 154); // Доп. материал.
define('PROPERTY_ID_MOVE_TO_IN_VIEWPOINT', 182); // Перенести в.
define('PROPERTY_ID_PHOTO_SRC_IN_VIEWPOINT', 247); // Источник фото.
define('PROPERTY_ID_OLD_ID_IN_VIEWPOINT', 262); // Старый Id.

// IBLOCK_ID_GALLERY_PHOTO
define('PROPERTY_ID_IMAGES_IN_GALLERY_PHOTO', 33); // Изображения.
define('PROPERTY_ID_COMPANY_ID_IN_GALLERY_PHOTO', 74); // id компании.
define('PROPERTY_ID_ARCHIVE_IN_GALLERY_PHOTO', 272); // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_GALLERY_PHOTO', 136); // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_GALLERY_PHOTO', 137); // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_GALLERY_PHOTO', 138); // Причина отклонения публикации.
define('PROPERTY_ID_OLD_ID_IN_GALLERY_PHOTO', 261); // Старый Id.

// IBLOCK_ID_GALLERY_VIDEO
define('PROPERTY_ID_VIDEO_FILE_IN_GALLERY_VIDEO', 276); // ВидеоФайл.
define('PROPERTY_ID_VIDEO_LINK_IN_GALLERY_VIDEO', 275); // Ссылка на видео iFrame.
define('PROPERTY_ID_COMPANY_ID_IN_GALLERY_VIDEO', 73); // id компании.
define('PROPERTY_ID_ARCHIVE_IN_GALLERY_VIDEO', 273); // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_GALLERY_VIDEO', 142); // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_GALLERY_VIDEO', 143); // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_GALLERY_VIDEO', 144); // Причина отклонения публикации.
define('PROPERTY_ID_OLD_ID_IN_GALLERY_VIDEO', 260); // Старый Id.

// IBLOCK_ID_EVENTS
define('PROPERTY_ID_BEGIN_DATE_IN_EVENTS', 49); // Дата - начало.
define('PROPERTY_ID_END_DATE_IN_EVENTS', 50); // Дата - окончание.
define('PROPERTY_ID_BEGIN_TIME_IN_EVENTS', 51); // Время начала.
define('PROPERTY_ID_PLACE_IN_EVENTS', 52); // Место проведения.
define('PROPERTY_ID_PHONE_IN_EVENTS', 53); // Телефон.
define('PROPERTY_ID_SITE_IN_EVENTS', 54); // Сайт.
define('PROPERTY_ID_SOURCE_IN_EVENTS', 55); // Источник.
define('PROPERTY_ID_TEXT_IN_EVENTS', 56); // Текст на картинке.
define('PROPERTY_ID_VK_LINK_IN_EVENTS', 93); // Ссылка Вконтакте.
define('PROPERTY_ID_COMPANY_ID_IN_EVENTS', 94); // id компании.
define('PROPERTY_ID_GOOGLE_LINK_IN_EVENTS', 103); // Ссылка Google+.
define('PROPERTY_ID_TWITTER_LINK_IN_EVENTS', 104); // Ссылка Twitter.
define('PROPERTY_ID_INSTAGRAMM_LINK_IN_EVENTS', 105); // Ссылка Instagram.
define('PROPERTY_ID_FACEBOOK_LINK_IN_EVENTS', 106); // Ссылка Facebook.
define('PROPERTY_ID_ARCHIVE_IN_EVENTS', 112); // Архив - история изменений.
define('PROPERTY_ID_REG_LINK_IN_EVENTS', 131); // Ссылка на регистрацию.
define('PROPERTY_ID_SCHEME_IN_EVENTS', 132); // Схема выставки.
define('PROPERTY_ID_SITE_EMAIL_IN_EVENTS', 153); // Email.
define('PROPERTY_ID_PUB_REJECTED_IN_EVENTS', 158); // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_EVENTS', 159); // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_EVENTS', 160); // Причина отклонения публикации.
define('PROPERTY_ID_MOVE_TO_IN_EVENTS', 178); // Перенести в.
define('PROPERTY_ID_END_TIME_IN_EVENTS', 211); // Время окончания.
define('PROPERTY_ID_OLD_ID_IN_EVENTS', 264); // Старый Id.

//IBLOCK_ID_PRODUCTS_REVIEW
define('PROPERTY_ID_TEXT_IMG_SRC_IN_PRODUCTS_REVIEW', 61);     // Текст на картинке.
define('PROPERTY_ID_NEWS_SRC_IN_PRODUCTS_REVIEW', 62);         // Источник новости.
define('PROPERTY_ID_COMPANY_ID_IN_PRODUCTS_REVIEW', 75);       // id компании.
define('PROPERTY_ID_ARCHIVE_IN_PRODUCTS_REVIEW', 111);         // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_PRODUCTS_REVIEW', 148);    // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_PRODUCTS_REVIEW', 150);       // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_PRODUCTS_REVIEW', 149);        // Причина отклонения публикации.
define('PROPERTY_ID_SHOW_LOGO_IN_PRODUCTS_REVIEW', 166);       // Показывать лого компании на главной.
define('PROPERTY_ID_MOVE_TO_IN_PRODUCTS_REVIEW', 185);         // Перенести в.
define('PROPERTY_ID_ADD_MATERIAL_IN_PRODUCTS_REVIEW', 202);    // Доп. материал.
define('PROPERTY_ID_OLD_ID_IN_PRODUCTS_REVIEW', 259);          // Старый id.

// IBLOCK_ID_PRICE_LISTS
define('PROPERTY_ID_COMPANY_ID_IN_PRICE_LIST', 71);            // ID компании.
define('PROPERTY_ID_FILE_IN_PRICE_LIST', 69);                  // Файл.
define('PROPERTY_ID_OLD_ID_IN_PRICE_LIST', 267);               // Старый id.

// IBLOCK_ID_BRANDS
define('PROPERTY_ID_COMPANY_ID_IN_BRANDS', 77); // id компании.
define('PROPERTY_ID_COUNTRY_IN_BRANDS', 78); // Страна.
define('PROPERTY_ID_ARCHIVE_IN_BRANDS', 109); // Архив - история изменений.
define('PROPERTY_ID_PAY_MODE_IN_BRANDS', 124); // Платный режим.
define('PROPERTY_ID_TYPE_IN_BRANDS', 125); // Тип.
define('PROPERTY_ID_PUB_REJECTED_IN_BRANDS', 126); // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_BRANDS', 128); // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_BRANDS', 127);        // Причина отклонения публикации.
define('PROPERTY_ID_MOVE_TO_IN_BRANDS', 179);         // Перенести в.
define('PROPERTY_ID_OLD_ID_IN_BRANDS', 256);          // Старый id.

// IBLOCK_ID_LICENSE
define('PROPERTY_ID_COMPANY_ID_IN_LICENSE', 91);       // id компании.
define('PROPERTY_ID_TEXT_IMG_SRC_IN_LICENSE', 92);     // Текст на картинке.
define('PROPERTY_ID_ARCHIVE_IN_LICENSE', 108);         // Архив - история изменений.
define('PROPERTY_ID_PUB_REJECTED_IN_LICENSE', 139);    // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_LICENSE', 141);       // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_LICENSE', 140);        // Причина отклонения публикации.
define('PROPERTY_ID_COUNTRY_IN_LICENSE', 171);         // Страна.
define('PROPERTY_ID_PAY_MODE_IN_LICENSE', 172);        // Платный режим.
define('PROPERTY_ID_TYPE_IN_LICENSE', 173);            // Тип.
define('PROPERTY_ID_MOVE_TO_IN_LICENSE', 180);         // Перенести в.
define('PROPERTY_ID_OLD_ID_IN_LICENSE', 255);          // Старый id.

// IBLOCK_ID_NOVETLY
define('PROPERTY_ID_TEXT_IMG_SRC_IN_NOVETLY', 216);    // Текст на картинке.
define('PROPERTY_ID_NEWS_SRC_IN_NOVETLY', 214);        // Источник новости.
define('PROPERTY_ID_COMPANY_ID_IN_NOVETLY', 213);      // id компании.
define('PROPERTY_ID_PHOTO_SRC_IN_NOVETLY', 215);       // Источник фото.
define('PROPERTY_ID_ARCHIVE_IN_NOVETLY', 218);         // Архив - история изменений.
define('PROPERTY_ID_SHOW_LOGO_IN_NOVETLY', 219);       // Показывать лого компании на главной.
define('PROPERTY_ID_PUB_REJECTED_IN_NOVETLY', 220);    // Публикация отклонена.
define('PROPERTY_ID_SEND_MESS_IN_NOVETLY', 221);       // Отправить уведомление пользователю.
define('PROPERTY_ID_REJ_MESS_IN_NOVETLY', 222);        // Причина отклонения публикации.
define('PROPERTY_ID_OLD_ID_IN_NOVETLY', 254);          // Старый ID.
define('PROPERTY_ID_MARKED_IN_NEWS_NOVETLY', 280);     // Выделено.
define('PROPERTY_ID_MARKED_TO_IN_NEWS_NOVETLY', 281);  // Дата до которого выделено.

// IBLOCK_ID_BANNERS
define('PROPERTY_ID_COMPANY_ID_IN_BANNERS', 226); // id компании.
define('PROPERTY_ID_DISPLAY_AREA_IN_BANNERS', 227); // Зона показа на главной странице.
define('PROPERTY_ID_LINK_IN_BANNERS', 228); // Ссылка.
define('PROPERTY_ID_TYPE_IN_BANNERS', 229); // Тип.
define('PROPERTY_ID_HOSTING_PAGE_IN_BANNERS', 230); // Страница размещения.
define('PROPERTY_ID_HTML_CODE_IN_BANNERS', 237); // HTML код.
define('PROPERTY_ID_FLASH_IN_BANNERS', 286); // Flash.
define('PROPERTY_ID_DISPLAY_AREA_OTHER_PAGE_IN_BANNERS', 287); // Зона показа на странице.
// Зоны отображения.
define('DA_HEADER_RIGHT', 60);
define('DA_HEADER_LEFT', 61);
define('DA_HEADER_RIGHT_OTHER_PAGE', 119);
define('DA_HEADER_LEFT_OTHER_PAGE', 120);
define('DA_BODY_TOP_RIGHT', 64);
define('DA_BODY_TOP_LEFT', 65);
define('DA_BODY_TOP_RIGHT_OTHER_PAGE', 121);
define('DA_BODY_TOP_LEFT_OTHER_PAGE', 122);
define('DA_BODY_BOTTOM_RIGHT', 66);
define('DA_BODY_BOTTOM_LEFT', 67);
define('DA_BODY_BOTTOM_RIGHT_OTHER_PAGE', 123);
define('DA_BODY_BOTTOM_LEFT_OTHER_PAGE', 124);
define('DA_BODY_CONTENT', 68);
define('DA_BODY_CONTENT_OTHER_PAGE', 125);
define('DA_BODY_CONTENT_OTHER_PAGE_LEFT_2', 127);
define('DA_BODY_CONTENT_OTHER_PAGE_LEFT_3', 128);
define('DA_MAIN_1', 70);
define('DA_MAIN_2', 71);
define('DA_MAIN_3', 72);
define('DA_MAIN_4', 73);
define('DA_MAIN_5', 74);
define('DA_MAIN_6', 75);
define('DA_MAIN_7', 76);
define('DA_MAIN_8', 77);
define('DA_MAIN_9', 78);
define('DA_MAIN_10', 79);
define('DA_MAIN_11', 80);
define('DA_MAIN_12', 81);
define('DA_MAIN_13', 82);
// Тип баннера.
define('BANNER_TYPE_ORDINARY', 62);
define('BANNER_TYPE_HTML', 63);
define('BANNER_TYPE_UNITED', 130);


// IBLOCK_ID_CATALOGS_PDF
define('PROPERTY_ID_FILE_IN_CATALOGS_PDF', 232);       // Файл.
define('PROPERTY_ID_COMPANY_ID_IN_CATALOGS_PDF', 233); // id компании.
define('PROPERTY_ID_PHONE_IN_CATALOGS_PDF', 234);      // Телефон.
define('PROPERTY_ID_EMAIL_IN_CATALOGS_PDF', 235);      // email.
define('PROPERTY_ID_COUNTRY_IN_CATALOGS_PDF', 236);    // Страна.
define('PROPERTY_ID_OLD_ID_IN_CATALOGS_PDF', 266);     // Старый ID.


	// file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/tpl/log.log', '444');




AddEventHandler("iblock", "OnStartIBlockElementAdd", Array("AddTaranslitCodeName", "OnStartIBlockElementAddHandler"));
AddEventHandler("iblock", "OnStartIBlockElementUpdate", Array("AddTaranslitCodeName", "OnStartIBlockElementUpdateHandler"));

class AddTaranslitCodeName
{
    function OnStartIBlockElementAddHandler(&$arFields)
    {
		// return true;
		// pre($arFields, EXIT_PRE);
		// pre($arFields);

		if (!isset($arFields['API']))
		{	
			$arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", array());

			$count = null;
			$count = CIBlockElement::GetList(
				array(),
				array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'CODE' => $arFields["CODE"]),
				array(),
				false,
				array('ID', 'CODE')
			);

			if (0 !== (int)$count && null !== $count)
				$arFields["CODE"] .= '_' . time();
		}

		global $USER;
		$rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя и сразу же его поля 
		$arUser = $rsUser->Fetch();

		$companyId = $arUser['UF_ID_COMPANY'];

		switch ($arFields['IBLOCK_ID'])
		{
			case IBLOCK_ID_NEWS_COMPANY:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_NEWS_COMPANY;
				break;
			}

			case IBLOCK_ID_NEWS_INDUSTRY:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_NEWS_INDUSTRY;
				break;
			}

			case IBLOCK_ID_STOCK:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_STOCK;
				break;
			}

			case IBLOCK_ID_BRANDS:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_BRANDS;
				$countPaidPropId = PROPERTY_ID_PAID_BRANDS_NUM;
				$paidPropId = PROPERTY_ID_PAY_MODE_IN_BRANDS;
				$paidPropCode = 'paidBrandsNum';
				break;
			}

			case IBLOCK_ID_LICENSE:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_LICENSE;
				$countPaidPropId = PROPERTY_ID_PAID_LICENSES_NUM;
				$paidPropId = PROPERTY_ID_PAY_MODE_IN_LICENSE;
				$paidPropCode = 'paidLicensesNum';
				break;
			}

			case IBLOCK_ID_GALLERY_PHOTO:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_PHOTO;
				break;
			}

			case IBLOCK_ID_GALLERY_VIDEO:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_VIDEO;
				break;
			}

			case IBLOCK_ID_VIEWPOINT:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_VIEWPOINT;
				break;
			}

			case IBLOCK_ID_EVENTS:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_EVENTS;
				break;
			}

			case IBLOCK_ID_PRODUCTS_REVIEW:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_PRODUCTS_REVIEW;
				break;
			}

			case IBLOCK_ID_PRICE_LISTS:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_PRICE_LIST;
				break;
			}

			case IBLOCK_ID_CATALOG:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_CATALOG;
				$paidPropId = PROPERTY_ID_HIT_IN_CATALOG;
				$paidPropCode = 'paidHitsNum';
				break;
			}

			case IBLOCK_ID_NOVETLY:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_NOVETLY;
				break;
			}

			case IBLOCK_ID_BANNERS:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_BANNERS;
				break;
			}

			case IBLOCK_ID_CATALOGS_PDF:
			{
				$propertyId = PROPERTY_ID_COMPANY_ID_IN_CATALOGS_PDF;
				break;
			}
		}
		
		// Заменим кирилическое имя файла (wowbook plugin не работает с кирилицей).
		if (IBLOCK_ID_CATALOGS_PDF == $arFields['IBLOCK_ID'])
		{
			$fileName = Cutil::translit($arFields['PROPERTY_VALUES'][PROPERTY_ID_FILE_IN_CATALOGS_PDF][0]['name'], "ru", array());
			$arFields['PROPERTY_VALUES'][PROPERTY_ID_FILE_IN_CATALOGS_PDF][0]['name'] = $fileName;
		}

// pre($arFields['PROPERTY_VALUES']);
		if (!empty($arFields['PROPERTY_VALUES'][$paidPropId]))
		{
			$resource = CIBlockElement::GetByID($companyId); // Выберем свойства компании.
			if ($ob = $resource->GetNextElement())
			{
				//$arFieldsExisting = $ob->GetFields();
				$arProps = $ob->GetProperties(false, array('ID' => $countPaidPropId)); // Узнаем, сколько осталось платных елементов.
				if (!empty($arProps[$paidPropCode]['VALUE']) && ($arProps[$paidPropCode]['VALUE']) > 0)
				{
					$paidNum = (int)$arProps[$paidPropCode]['VALUE'] - 1;

					// Установим новое значение для данного свойства данного элемента.
					CIBlockElement::SetPropertyValuesEx($companyId, IBLOCK_ID_COMPANY, array($paidPropCode => $paidNum));
				}
				else
				{
					$arFields['PROPERTY_VALUES'][$paidPropId] = '';
				}
			}
		}
// pre($arFields);

		if (empty($arFields['PROPERTY_VALUES'][$propertyId]) && !isset($arFields['API']))
			$arFields['PROPERTY_VALUES'][$propertyId] = $companyId;

		if (!isset($arFields['IPROPERTY_TEMPLATES']))
			$arFields['ACTIVE'] = 'N';

		if (IBLOCK_ID_COMPANY == $arFields['IBLOCK_ID'])
		{
			$arFields['PROPERTY_VALUES'][PROPERTY_ID_USER_ID] = $USER->GetID();
			$arFields['ACTIVE'] = 'Y';
			if (!isset($arFields['API']))
				$arFields['PROPERTY_VALUES'][PROPERTY_ID_IN_MODERATION]['VALUE'] = 83;
		}

		if (isset($arFields['API']))
			$arFields['ACTIVE'] = 'Y';

		// pre($arFields, EXIT_PRE);
		return;
    }


	//---------------------------------------------------------------------------------------------------------------------------------
	// Update элемента
	//---------------------------------------------------------------------------------------------------------------------------------
	function OnStartIBlockElementUpdateHandler(&$arFields)
	{
		// pre($arFields, EXIT_PRE);
// return true;
		if (IBLOCK_ID_COMPANY == $arFields['IBLOCK_ID'])
		{
			// Если редактировали компанию, то поставим галку в свойство НА МОДЕРАЦИИ.
			// Связано с магазином - если карточка компании не активна,
			// то ругается при добавлении товара в корзину, что не все поля заполнены.

			// Костыль.
			// Если массив свойств из админки, то прилетает IPROPERTY_TEMPLATES.
			if (!isset($arFields['IPROPERTY_TEMPLATES']))
			{
				$arFields['PROPERTY_VALUES'][PROPERTY_ID_IN_MODERATION]['VALUE'] = 83;

				// Уведомим админа сайта, что был отредактирован метериал.
				$res = CIBlockElement::GetByID($arFields['ID']);
				if ($ar_res = $res->GetNext()) {
					$arEventFields = array(
						"ELEMENT_ID" => $arFields['ID'],
						"IBLOCK_TYPE" => $ar_res['IBLOCK_TYPE_ID'],
						"IBLOCK_ID" => $ar_res['IBLOCK_ID'],
					);

					$res = CEvent::Send("updateElement", SITE_ID, $arEventFields, 'Y');
				}
			}

			return true;
		}

			switch ($arFields['IBLOCK_ID'])
			{
				case IBLOCK_ID_NEWS_COMPANY:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_NEWS_COMPANY;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_NEWS_COMPANY;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_NEWS_COMPANY;					
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_NEWS_COMPANY;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_NEWS_COMPANY;
					break;
				}

				case IBLOCK_ID_NEWS_INDUSTRY:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_NEWS_INDUSTRY;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_NEWS_INDUSTRY;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_NEWS_INDUSTRY;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_NEWS_INDUSTRY;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_NEWS_INDUSTRY;
					break;
				}

				case IBLOCK_ID_STOCK:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_STOCK;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_STOCK;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_STOCK;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_STOCK;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_STOCK;
					break;
				}

				case IBLOCK_ID_BRANDS:
				{
					$propertyId = PROPERTY_ID_COMPANY_ID_IN_BRANDS;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_BRANDS;
					$rejPropertyId = PROPERTY_ID_PUB_REJECTED_IN_BRANDS;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_BRANDS;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_BRANDS;
					break;
				}

				case IBLOCK_ID_LICENSE:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_LICENSE;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_LICENSE;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_LICENSE;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_LICENSE;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_LICENSE;
					break;
				}

				case IBLOCK_ID_GALLERY_PHOTO:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_GALLERY_PHOTO;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_GALLERY_PHOTO;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_GALLERY_PHOTO;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_GALLERY_PHOTO;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_GALLERY_PHOTO;
					break;
				}

				case IBLOCK_ID_GALLERY_VIDEO:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_GALLERY_VIDEO;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_GALLERY_VIDEO;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_GALLERY_VIDEO;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_GALLERY_VIDEO;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_GALLERY_VIDEO;
					break;
				}

				case IBLOCK_ID_VIEWPOINT:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_VIEWPOINT;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_VIEWPOINT;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_VIEWPOINT;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_VIEWPOINT;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_VIEWPOINT;
					break;
				}

				case IBLOCK_ID_EVENTS:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_EVENTS;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_EVENTS;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_EVENTS;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_EVENTS;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_EVENTS;
					break;
				}

				case IBLOCK_ID_PRODUCTS_REVIEW:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_PRODUCTS_REVIEW;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_PRODUCTS_REVIEW;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_PRODUCTS_REVIEW;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_PRODUCTS_REVIEW;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_PRODUCTS_REVIEW;
					break;
				}

				case IBLOCK_ID_ANALYTICS:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_ANALYTICS;
					$moveToPropertyId   = PROPERTY_ID_MOVE_TO_IN_ANALYTICS;
				}

				case IBLOCK_ID_NOVETLY:
				{
					$propertyId         = PROPERTY_ID_COMPANY_ID_IN_NOVETLY;
					$rejPropertyId      = PROPERTY_ID_PUB_REJECTED_IN_NOVETLY;
					$sendMessPropertyId = PROPERTY_ID_SEND_MESS_IN_NOVETLY;
					$rejMessPropertyId  = PROPERTY_ID_REJ_MESS_IN_NOVETLY;
					break;
				}
			}

			// Если элемент редактируется из админки
			global $USER;
			if ($USER->IsAdmin()) {
				$key = array_keys($arFields['PROPERTY_VALUES'][$moveToPropertyId]);
				$move = $arFields['PROPERTY_VALUES'][$moveToPropertyId][$key[0]]['VALUE'];

	// pre($arFields, EXIT_PRE);
				//Если надо перенести элемент...
				if (!empty($move))
				{
					// Узнаем ID инфоблока куда надо перенести.
					$res = CIBlockElement::GetByID($move);
					if ($ar_res = $res->GetNext())
					{
						$key = array_keys($arFields['PROPERTY_VALUES'][$propertyId]);
						$companyId = $arFields['PROPERTY_VALUES'][$propertyId][$key[0]]['VALUE'];

						$tmpName = explode(' ', $ar_res['NAME']);
						$iBlockId = $tmpName[1];

						// Узнаем ID свойства companyId у инфоблока в который переносим.
						switch ($iBlockId)
						{
							case IBLOCK_ID_NEWS_COMPANY:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_NEWS_COMPANY;
								break;
							}

							case IBLOCK_ID_NEWS_INDUSTRY:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_NEWS_INDUSTRY;
								break;
							}

							case IBLOCK_ID_STOCK:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_STOCK;
								break;
							}

							case IBLOCK_ID_BRANDS:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_BRANDS;
								break;
							}

							case IBLOCK_ID_LICENSE:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_LICENSE;
								break;
							}

							case IBLOCK_ID_GALLERY_PHOTO:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_PHOTO;
								break;
							}

							case IBLOCK_ID_GALLERY_VIDEO:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_GALLERY_VIDEO;
								break;
							}

							case IBLOCK_ID_VIEWPOINT:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_VIEWPOINT;
								break;
							}

							case IBLOCK_ID_EVENTS:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_EVENTS;
								break;
							}

							case IBLOCK_ID_PRODUCTS_REVIEW:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_PRODUCTS_REVIEW;
								break;
							}
							
							case IBLOCK_ID_ANALYTICS:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_ANALYTICS;
								break;
							}

							case IBLOCK_ID_NOVETLY:
							{
								$propertyId = PROPERTY_ID_COMPANY_ID_IN_NOVETLY;
								break;
							}
						}

						$arFieldsCopy['NAME'] = $arFields['NAME'];
						$arFieldsCopy['TAGS'] = $arFields['TAGS'];
						$arFieldsCopy['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];
						$arFieldsCopy['DETAIL_TEXT'] = $arFields['DETAIL_TEXT'];
						$arFieldsCopy['ACTIVE'] = $arFields['ACTIVE'];
						$arFieldsCopy["IBLOCK_SECTION_ID"] = false;       // Элемент лежит в корне раздела.
						$arFieldsCopy["MODIFIED_BY"] = $USER->GetID();    // Элемент изменен текущим пользователем.
						$arFieldsCopy["IBLOCK_ID"] = (int)$iBlockId;
						$arFieldsCopy["PROPERTY_VALUES"][$propertyId] = $companyId;

						if (isset($arFields['PREVIEW_PICTURE']) && !empty($arFields['PREVIEW_PICTURE']))
							$arFieldsCopy['PREVIEW_PICTURE'] = CFile::MakeFileArray($arFields['PREVIEW_PICTURE']);

						if (isset($arFields['DETAIL_PICTURE']) && !empty($arFields['DETAIL_PICTURE']))
							$arFieldsCopy['DETAIL_PICTURE'] = CFile::MakeFileArray($arFields['DETAIL_PICTURE']);
	// pre($arFieldsCopy);
						// Создаём новый элемент.
						$el = new CIBlockElement();
						if ($NEW_ID = $el->Add($arFieldsCopy))
						{
							// Удаляем текущий элемент.
							if (CIBlock::GetPermission($arFields['IBLOCK_ID']) >= 'W')
							{
								global $DB;

								$DB->StartTransaction();
								if (!CIBlockElement::Delete($arFields['ID']))
								{
									$strWarning .= 'Error!';
									$DB->Rollback();
								}
								else
									$DB->Commit();
							}
						}
					}

					return;
				}


				// Если публикация отклонена сделаем элемент неактивным.
				if (!empty($arFields['PROPERTY_VALUES'][$rejPropertyId][0]['VALUE']))
					$arFields['ACTIVE'] = 'N';

				// Если публикация отклонена и требуется оповестить пользователя.
				if (!empty($arFields['PROPERTY_VALUES'][$sendMessPropertyId][0]['VALUE'])) {
					$tmpKeys = array_keys($arFields['PROPERTY_VALUES'][$rejMessPropertyId]);
					$tmpKeys = $tmpKeys[0];

					$res = CIBlockElement::GetByID($arFields['ID']);
					if ($ar_res = $res->GetNext()) {
						$rsUser = CUser::GetByID($ar_res['CREATED_BY']);
						$arUser = $rsUser->Fetch();
						$arEventFields = array(
							"PUBLICATION_ID" => $arFields['ID'],
							"IBLOCK_TYPE" => $ar_res['IBLOCK_TYPE_ID'],
							"IBLOCK_ID" => $arFields['IBLOCK_ID'],
							"USER_EMAIL" => $arUser['EMAIL'],
							"REJ_MESSAGE" => $arFields['PROPERTY_VALUES'][$rejMessPropertyId][$tmpKeys]['VALUE']['TEXT']
						);

						//CEvent::Send("PUBLICATION_REJECTED", SITE_ID_FOR_SEND_EVENT, $arEventFields);

						// Снимем признак что требуется уведомить пользователя чтоб не отправлялись сообщения повторно.
						$arFields['PROPERTY_VALUES'][$sendMessPropertyId][0]['VALUE'] = '';
					}
				}
			}

			// Костыль.
			// Если массив свойств из админки, то прилетает IPROPERTY_TEMPLATES.
			// Соответственно, проверим на его наличие - если его нет, то значит элемент редактировал пользователь.
			// Установим елемент неактивным, если материал отклонён - снимим эту галку и галку уведомить пользователя.
			if (!isset($arFields['IPROPERTY_TEMPLATES']) && !isset($arFields['SORT']) && !isset($arFields['CODE'])) {
				$arFields['ACTIVE'] = 'N';
// pre($arFields, EXIT_PRE);
				if (!empty($arFields['PROPERTY_VALUES']) && !empty($arFields['PROPERTY_VALUES'][$rejPropertyId]['VALUE']))
					$arFields['PROPERTY_VALUES'][$rejPropertyId]['VALUE'] = '';

				// Уведомим админа сайта, что был отредактирован метериал.
				$res = CIBlockElement::GetByID($arFields['ID']);
				if ($ar_res = $res->GetNext()) {
					$arEventFields = array(
						"ELEMENT_ID" => $arFields['ID'],
						"IBLOCK_TYPE" => $ar_res['IBLOCK_TYPE_ID'],
						"IBLOCK_ID" => $ar_res['IBLOCK_ID'],
					);

					$res = CEvent::Send("updateElement", SITE_ID, $arEventFields, 'Y');
				}
			}

// pre($arFields, EXIT_PRE);
			if (IBLOCK_ID_CATALOG == $arFields['IBLOCK_ID']) {
				$ppID = false;
				$res = CPrice::GetList(array(), array("PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => 1));
				if ($arr = $res->Fetch()) {
					$ppID = $arr["ID"];
					$currentPrice = $arr["PRICE"];
				}

				if ($currentPrice != $arFields['PROPERTY_VALUES'][PROPERTY_ID_PRICE_IN_CATALOG]) {
					// собираем массив
					$arPrice = Array(
						"PRICE" => $arFields['PROPERTY_VALUES'][PROPERTY_ID_PRICE_IN_CATALOG]    // значение цены
					);
					if ( $ppID ) {
						// обновляем
						CPrice::Update($ppID, $arPrice);
					}
				}
			}

// pre($arFields, EXIT_PRE);
//*********************************************************************************************************
//if (false)
//{ 

// Временно закоменчено создание истории изменений.
// TODO Добавить в копирование свойство Актуально сегодня!!!!!!!!!!!
			$resource = CIBlockElement::GetByID($arFields['ID']);
			if ($ob = $resource->GetNextElement())
			{
				// pre($arFields);
				$arFieldsExisting = $ob->GetFields();
				$arPropsExisting = $ob->GetProperties();

				// pre($arFieldsExisting);
				// pre($arPropsExisting);

				$arFieldsCopy = $arFields;
				$arFieldsCopy['NAME'] = $arFieldsExisting['NAME'];
				$arFieldsCopy['TAGS'] = $arFieldsExisting['TAGS'];
				$arFieldsCopy['PREVIEW_TEXT'] = $arFieldsExisting['PREVIEW_TEXT'];
				$arFieldsCopy['DETAIL_TEXT'] = $arFieldsExisting['DETAIL_TEXT'];
				$arFieldsCopy['PREVIEW_PICTURE'] = CFile::MakeFileArray($arFieldsExisting['PREVIEW_PICTURE']);
				$arFieldsCopy['ACTIVE'] = 'N';

				if (isset($arFieldsExisting['DETAIL_PICTURE']) && !empty($arFieldsExisting['DETAIL_PICTURE']))
					$arFieldsCopy['DETAIL_PICTURE'] = CFile::MakeFileArray($arFieldsExisting['DETAIL_PICTURE']);

				foreach ($arPropsExisting as $key => $property)
				{
					if ('archive' == $key)
					{
						//$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID"=>$arFields['IBLOCK_ID'], 'PROPERTY_ID' => $property['ID']));
						$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID"=>$arFields['IBLOCK_ID'], 'CODE' => $key));
						if ($enumFields = $propertyEnums->GetNext())
							$arFieldsCopy['PROPERTY_VALUES'][$property['ID']] = $enumFields['ID'];

						continue;
					}

					if ('F' == $property['PROPERTY_TYPE'])
					{
						if ('Y' == $property['MULTIPLE'] && is_array($property['VALUE']))
						{
							foreach ($property['VALUE'] as $key => $value)
							{
								// pre($key);
								// pre($value);
								$arFieldsCopy['PROPERTY_VALUES'][$property['ID']][$property['PROPERTY_VALUE_ID'][$key]] = CFile::MakeFileArray($value);
							}
						}
					}

					//pre($arFieldsCopy);

					if ('S' == $property['PROPERTY_TYPE'])
						$arFieldsCopy['PROPERTY_VALUES'][$property['ID']] = $property['VALUE'];
					else
						$arFieldsCopy['PROPERTY_VALUES'][$property['ID']]['VALUE'] = $property['VALUE'];


					if ('L' == $property['PROPERTY_TYPE']) {
						if ('Y' == $property['MULTIPLE']) {
							$arFieldsCopy['PROPERTY_VALUES'][$property['CODE']] = array();
							foreach ($property['VALUE_ENUM_ID'] as $enumID)
								$arFieldsCopy['PROPERTY_VALUES'][$property['CODE']][] = array('VALUE' => $enumID);
						} else {
							$arFieldsCopy['PROPERTY_VALUES'][$property['CODE']] = array('VALUE' => $property['VALUE_ENUM_ID']);
						}
					}
				}

				$el = new CIBlockElement();
				if ($NEW_ID = $el->Add($arFieldsCopy))
				{
					//pre("New ID: ".$NEW_ID);
				}
				else
				{
					//pre("Error: ".$el->LAST_ERROR);
				}
			}
//} 
// end if Временно закоменчено создание истории изменений.
//*********************************************************************************************************
	}
}




if (!function_exists('my_round')) {
	function my_round($arg, $base){
		//arg - округляемое число, $base - "округлитель"
		$ost = $arg%$base; //вычисляем остаток от деления
		$chast = floor($arg/$base); //находим количество целых округлителей в аргументе
		if($ost >= $base/2)    $rez = ($chast+1) * $base; //выбираем направление округления
		else $rez = $chast * $base;
		return $rez;
	}
}

if (!function_exists('myGetProperty')) {
	function myGetProperty($property_id, $default_value=false) { 
		global $APPLICATION; 
		return $APPLICATION->AddBufferContent(Array(&$APPLICATION, "GetProperty"), $property_id, $default_value);
	}
}

if (!function_exists('pre')) {
    function pre($var = 'Empty string', $exit = false) {
		global $USER;
//		if ((1 == $USER->GetByID()) && $USER->IsAdmin())
//		{
			// $handler = fopen($_SERVER['DOCUMET_ROOT'] . 'tpl/log.log', 'r+');
			// fwrite($handler, serialize($var));
			// fclose($handler);

			echo '<pre style="background-color: #eee; border-left: 3px solid #ffaa00; clear: both; color: #333333; font: 12px Courier; z-index: 1000; position: relative; text-align:left;">';
			print_r($var);
			echo '</pre>';
			if ($exit) exit(0);
//		}
    }
}

if (!function_exists('getUserField')) {
	function getUserField ($entity_id, $value_id, $uf_id){
        //echo $entity_id . $value_id .  $uf_id;
		$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields($entity_id, $value_id);
		return $arUF[$uf_id]["VALUE"];
		// $entity_id - имя объекта ("IBLOCK_'.$Iblock_ID.'_SECTION")
		// $value_id - идентификатор элемента
		// $uf_id - имя пользовательского свойства (UF_) 
	}
}

if (!function_exists('createpass')) {
	function createpass ($max=10, $chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP!@#$%^&*()') {
		$size=StrLen($chars)-1;
		$password=null;
		while($max--) $password.=$chars[rand(0,$size)];
		return $password;
	}
}

if (!function_exists('getNumEnding')) {
	
	/**
	 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
	 * param  $number Integer Число на основе которого нужно сформировать окончание
	 * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
	 *         например array('яблоко', 'яблока', 'яблок')
	 * return String
	 */	
	
	function getNumEnding($number, $endingArray)
	{
		$number = $number % 100;
		if ($number>=11 && $number<=19) {
			$ending=$endingArray[2];
		}
		else {
			$i = $number % 10;
			switch ($i)
			{
				case (1): $ending = $endingArray[0]; break;
				case (2):
				case (3):
				case (4): $ending = $endingArray[1]; break;
				default: $ending=$endingArray[2];
			}
		}
		return $ending;
	}
}
if (!function_exists('striptext')) {
	function striptext ($string, $numstrip) {
		if (!$numstrip) {
			$numstrip = 200;
		}
		$string = strip_tags($string);
		$string = mb_substr($string, 0, $numstrip);
		$string = rtrim($string, "?!,.-");
		//$string = mb_substr($string, 0, strrpos($string, ' '));
		return $string.'… ';
	}
}




// Возвращает количество просмотров елемента или false в случае ошибки.
// Подходит для компенента news.list
// Аргументы - ID инфоблока и ID едемента.
if (!function_exists('getShowCounter')) {
	function getShowCounter($idBlock, $idElement) {
		$result = false;

		$arSelect = Array("SHOW_COUNTER");
		$arFilter = Array("IBLOCK_ID" => IntVal($idBlock), "ID" => IntVal($idElement), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1), $arSelect);

		if ($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			if (!empty($arFields['SHOW_COUNTER']) && isset($arFields['SHOW_COUNTER']))
				$result = $arFields['SHOW_COUNTER'];
		}

		return $result;
	}
}


//---------------------- При оформлении заказа. ------------------------------------------
EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'sendMailToClient'
);

function sendMailToClient(Event $event)
{
	global $USER;

    $order = $event->getParameter("ENTITY");
    // $oldValues = $event->getParameter("VALUES");
    $isNew = $event->getParameter("IS_NEW");

    if ($isNew)
    {
        $sum = $order->getPrice();
		$basket = $order->getBasket();
		$basketItems = $basket->getBasketItems();

		$date = $order->getDateInsert()->format("Y-m-d H:i:s");

		$items = array();
		$counter = 1;
		$orderItems = '';
		foreach ($basket as $basketItem)
		{
			$orderItems .= $counter . ": " . $basketItem->getField('NAME') . " в количестве " . $basketItem->getQuantity() . " шт. на сумму " . $basketItem->getFinalPrice() . " руб. \r\n";
			// $basketProp = $basketItem->getPropertyCollection();
			// $arBarsetProp = $basketProp->getPropertyValues();
			// pre($arBarsetProp);
		}

		$comment = $order->getField('USER_DESCRIPTION');

		$propertyCollection = $order->getPropertyCollection();
		if (isset($propertyCollection) && !empty($propertyCollection))
		{
			$propUserEmail = $propertyCollection->getUserEmail();
			$propUserName  = $propertyCollection->getPayerName();
			$propUserPhone = $propertyCollection->getPhone();
		}

		if (isset($propUserEmail) && !empty($propUserEmail))
			$userEmail = $propUserEmail->getValue();

		if (isset($propUserName) && !empty($propUserName))
			$userName = $propUserName->getValue();

		if (isset($propUserPhone) && !empty($propUserPhone))
			$userPhone = $propUserPhone->getValue();

		$userId = $order->getUserId(); // Получаем ID пользователя-заказчика.
		$rsUser = CUser::GetByID($userId); // Получаем его поля.
		$arUser = $rsUser->Fetch();

		if (!isset($userEmail) || empty($userEmail) || !isset($userName) || empty($userName) || !isset($userPhone) || empty($userPhone))
		{
			$userAccountEmail = $arUser['EMAIL'];
			$userAccountName = $arUser['NAME'];
			$userAccountPhone = $arUser['PERSONAL_PHONE'];

			if (!isset($userEmail) || empty($userEmail))
				$userEmail = $userAccountEmail;

			if (!isset($userName) || empty($userName))
				$userName = $userAccountName;

			if (!isset($userPhone) || empty($userPhone))
				$userPhone = $userAccountPhone;
		}


		$item = $basketItems[0];
		$prodId = $item->getProductId();

		$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_CATALOG, "ID" => $prodId);
		$res = CIBlockElement::GetList(Array(), $arFilter);
		if ($ob = $res->GetNextElement()) {
			$arProps = $ob->GetProperties(false, array('CODE' => 'companyId')); // свойства элемента
		}

		$sendEventFields = array(
						"ORDER_ID" => $order->getId(),
						"ORDER_DATE" => date('Y-m-d'),
						"PRICE" => $sum,
						"EMAIL" => $userEmail,
						"ORDER_USER" => $userName,
						"ORDER_LIST" => $orderItems,
						"PHONE" => $userPhone,
					);

		$message = "Оформлен заказ № " . $order->getId() . " от " . $date . "\r\n
					Состав заказа: \r\n" . $orderItems . "\r\n
					Общая сумма заказа: " . $sum . "\r\n
					Имя заказчика: " . $userName . "\r\n
					Телефон заказчика: " . $userPhone . "\r\n
					Email заказчика: " . $userEmail . "\r\n
					Комментарий к заказу: " . $comment;
// pre($userId. ' ' . $message . ' ' . $arUser['UF_ID_COMPANY'], EXIT_PRE);
		sendMessageForAdmin($userId, 'Новый заказ на сайте segment.ru', $message, $arProps['companyId']['VALUE'], $sendEventFields);

		// Оповестим пользователя.
		$arEventFields = array(
						"ORDER_ID" => $order->getId(),
						"ORDER_DATE" => date('Y-m-d'),
						"PRICE" => $sum,
						"EMAIL" => $userEmail,
						"ORDER_USER" => $userName,
						"ORDER_LIST" => $orderItems,
					);

		$res = CEvent::Send("SALE_NEW_ORDER", SITE_ID, $arEventFields);		
		// pre($res, EXIT_PRE);
	}
}
//----------------------------------------------------------------------------------------




AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("elementadd", "OnAfterIBlockElementAddHandler"));

class elementadd
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
		if (IBLOCK_ID_CATALOG == $arFields['IBLOCK_ID'])
		{
			$productID = CCatalogProduct::add(array("ID" => $arFields['ID']));

			$arPrice = Array(
				"CURRENCY"         => "RUB",       // валюта
				"PRICE"            => $arFields['PROPERTY_VALUES'][PROPERTY_ID_PRICE_IN_CATALOG],       // значение цены
				"CATALOG_GROUP_ID" => 1,           // ID типа цены
				"PRODUCT_ID"       => $arFields['ID'],  // ID товара
			);
			$res = CPrice::Add($arPrice);
		}
		global $USER;

        //pre($arFields);


		if (!$USER->IsAdmin()) {
			if (IBLOCK_ID_COMPANY == $arFields['IBLOCK_ID'] && !empty($arFields['ID'])) {
				$user = new CUser;
				// $el = new CIBlockElement; 

				$ufields = Array(
					"GROUP_ID" => array(3,4,5),
					"UF_ID_COMPANY" => $arFields['ID']
				);

				$user->Update($arFields['MODIFIED_BY'], $ufields);	
				// $el->Update($arFields['ID'], array('ACTIVE'=>'N'));
				CIBlockElement::SetPropertyValuesEx($arFields['ID'], IBLOCK_ID_COMPANY, array('staff' => $USER->GetID()));

				$USER->Logout();
				$USER->Authorize($arFields['MODIFIED_BY']);

				$arEventFields = array(
					"COMPANY_ID"=>$arFields['ID'],
				);
				CEvent::Send("NEW_COMPANY", SITE_ID, $arEventFields);
			} else if (($arFields['IBLOCK_ID'] == IBLOCK_ID_NEWS_COMPANY || $arFields['IBLOCK_ID'] == IBLOCK_ID_STOCK ||
						$arFields['IBLOCK_ID'] == IBLOCK_ID_NEWS_INDUSTRY || $arFields['IBLOCK_ID'] == IBLOCK_ID_VIEWPOINT ||
						$arFields['IBLOCK_ID'] == IBLOCK_ID_GALLERY_PHOTO || $arFields['IBLOCK_ID'] == IBLOCK_ID_GALLERY_VIDEO ||
						$arFields['IBLOCK_ID'] == IBLOCK_ID_EVENTS || $arFields['IBLOCK_ID'] == IBLOCK_ID_PRODUCTS_REVIEW ||
						$arFields['IBLOCK_ID'] == IBLOCK_ID_BRANDS || $arFields['IBLOCK_ID'] == IBLOCK_ID_LICENSE || $arFields['IBLOCK_ID'] == IBLOCK_ID_CATALOG ||
						$arFields['IBLOCK_ID'] == IBLOCK_ID_BANNERS || $arFields['IBLOCK_ID'] == IBLOCK_ID_CATALOGS_PDF || $arFields['IBLOCK_ID'] == IBLOCK_ID_NOVETLY)
						&& $arFields['ID']) {

				// $el = new CIBlockElement;
				// $el->Update($arFields['ID'], array('ACTIVE'=>'N'));

                //pre($arFields['ID']);


				$res = CIBlockElement::GetByID($arFields['ID']);

				if ($ar_res = $res->GetNext()) {


                    //pre($ar_res);

					$arEventFields = array(
						"ELEMENT_ID" => $arFields['ID'],
						"IBLOCK_TYPE" => $ar_res['IBLOCK_TYPE_ID'],
						"IBLOCK_ID" => $ar_res['IBLOCK_ID'],
					);

					$res = CEvent::Send("NEW_MATERIAL", SITE_ID, $arEventFields, 'Y');

					// pre($res, EXIT_PRE);
				}

                //die();
			}
		}
    }
}







if (!function_exists('curPageURL')) {
	function curPageURL() {
		$pageURL = 'http';

		if ($_SERVER["HTTPS"] == "on")
			$pageURL .= "s";

		$pageURL .= "://";

		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
}











function isBot()
{
	$result = false;

	if (!empty($_SERVER['HTTP_USER_AGENT'])) {
		$bots = array(
			'YandexBot', 'YandexAccessibilityBot', 'YandexMobileBot','YandexDirectDyn',
			'YandexScreenshotBot', 'YandexImages', 'YandexVideo', 'YandexVideoParser',
			'YandexMedia', 'YandexBlogs', 'YandexFavicons', 'YandexWebmaster',
			'YandexPagechecker', 'YandexImageResizer','YandexAdNet', 'YandexDirect',
			'YaDirectFetcher', 'YandexCalendar', 'YandexSitelinks', 'YandexMetrika',
			'YandexNews', 'YandexNewslinks', 'YandexCatalog', 'YandexAntivirus',
			'YandexMarket', 'YandexVertis', 'YandexForDomain', 'YandexSpravBot',
			'YandexSearchShop', 'YandexMedianaBot', 'YandexOntoDB', 'YandexOntoDBAPI',
			'Googlebot', 'Googlebot-Image', 'Mediapartners-Google', 'AdsBot-Google',
			'Mail.RU_Bot', 'bingbot', 'Accoona', 'ia_archiver', 'Ask Jeeves', 
			'OmniExplorer_Bot', 'W3C_Validator', 'WebAlta', 'YahooFeedSeeker', 'Yahoo!',
			'Ezooms', '', 'Tourlentabot', 'MJ12bot', 'AhrefsBot', 'SearchBot', 'SiteStatus', 
			'Nigma.ru', 'Baiduspider', 'Statsbot', 'SISTRIX', 'AcoonBot', 'findlinks', 
			'proximic', 'OpenindexSpider','statdom.ru', 'Exabot', 'Spider', 'SeznamBot', 
			'oBot', 'C-T bot', 'Updownerbot', 'Snoopy', 'heritrix', 'Yeti',
			'DomainVader', 'DCPbot', 'PaperLiBot', 'rambler', 'googlebot', 'aport', 'yahoo', 
			'msnbot', 'turtle', 'mail.ru', 'omsktele', 'yetibot', 'picsearch', 'sape.bot', 
			'sape_context','gigabot','snapbot','alexa.com', 
			'megadownload.net','askpeter.info','igde.ru','ask.com','qwartabot','yanga.co.uk',
			'scoutjet','similarpages','oozbot','shrinktheweb.com','aboutusbot','followsite.com',
			'dataparksearch','google-sitemaps','appEngine-google','feedfetcher-google',
			'liveinternet.ru','xml-sitemaps.com','agama','metadatalabs.com','h1.hrn.ru',
			'googlealert.com','seo-rus.com','yaDirectBot','yandeG','yandex',
			'yandexSomething','Copyscape.com','domaintools.com','bing.com','dotnetdotcom'
		);

		foreach ($bots as $bot) {
			if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
				$result = true;
			}
		}
	}

	return $result;
}



if (!function_exists('viewsinc')) {

	//	$element_id - ID элемента
	//	$iblock_id - ID инфоблока
	//	$company_id - ID компании

	function viewsinc($element_id, $iblock_id, $company_id, $element_date_create = null) {
		if (!isBot()) {

			// if ()
			// {
				// $strSql = "SELECT `id` FROM `blackIp` WHERE ELEMENT_ID='".$element_id."' AND IBLOCK_ID='".$iblock_id."' AND CUR_DATE='".$cur_date."'";
				// if ($company_id) {
					// $strSql .= "AND COMPANY_ID=".$company_id;
				// }
			// }

			global $DB;

			// $fd = fopen($_SERVER['DOCUMENT_ROOT'] . '/tpl/log.log', 'a') or exit("Не удалось открыть файл " . $_SERVER['DOCUMENT_ROOT'] . '/tpl/log.log');
			// $str = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			// $str = serialize($str) . "\r\n";
			// fwrite($fd, $str);
			// fclose($fd);

			$cur_date = date("Y-m-d");

			$strSql = "SELECT `ID`, `serverData`, `sessionData` FROM `segment_views` WHERE ELEMENT_ID='".$element_id."' AND IBLOCK_ID='".$iblock_id."' AND CUR_DATE='".$cur_date."'";
			if ($company_id) {
				$strSql .= "AND COMPANY_ID = " . $company_id;
			}

			$result = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
			if ($resultid = $result->GetNext()) {
				// обновляем текущую запись:
				$serverStr = $resultid['serverData'] . ',' . $_SERVER['REMOTE_ADDR'];
				$sessionStr = $resultid['sessionData'] . ',' . $_SESSION['SALE_USER_ID'];
				if (empty($sessionStr))
					$sessionStr = 0;

				$strSql = "UPDATE segment_views SET NUM_VIEWS=".$DB->IsNull("NUM_VIEWS", 0)."+1, `serverData` = '" . $serverStr . "', `sessionData` = '" . $sessionStr . "' WHERE ID='".$resultid['ID']."'";		
				$DB->Query($strSql, false, "", array("ignore_dml"=>true));			
			} else {
				// $serverData = json_encode($_SERVER);
				$serverData = $_SERVER['REMOTE_ADDR'];
				// $sessionData = json_encode($_SESSION);
				$sessionData = $_SESSION['SALE_USER_ID'];

				$element_date_create = (null == $element_date_create)? 'now': $element_date_create;

				// Добавляем новую запись:
				$strSql = "INSERT INTO `segment_views` (ELEMENT_ID, IBLOCK_ID, CUR_DATE, NUM_VIEWS, COMPANY_ID, ELEMENT_DATE_CREATE, serverData, sessionData) VALUES ('".$element_id."', '".$iblock_id."', '".$cur_date."', '1', '".$company_id."', '" . date("Y.m.d", strtotime($element_date_create)) . "', '" . $serverData . "', '" . $sessionData . "')";
				$DB->Query($strSql, false, "", array("ignore_dml"=>true));
			}
			
		}
	}
}







if (!function_exists('showviews')) {

	//	$element_id - ID элемента

	function showviews($element_id) {
		global $DB;
		if ($element_id) {
			// pre($element_id);
			$strSql = "SELECT NUM_VIEWS FROM segment_views WHERE ELEMENT_ID=".$element_id;
			$resultnid = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
			while ($result = $resultnid->GetNext()) {
				$viewscount += $result['NUM_VIEWS'];
			}
			if ($viewscount) {
				return $viewscount;
			} else {
				return 0;
			}
		}
		 else {
		 return 0; }
	}
}


// Отправка сообщения админам компании.
if (!function_exists('sendMessageForAdmin')) {
	function sendMessageForAdmin($authorId, $theme, $message, $companyId, $sendEventFields = null)
	{
		// Выберем админов компании.
		$arFilter = Array(
			Array(
				"LOGIC"=>"OR",
				Array(),
				Array(
					"UF_ID_COMPANY" => $companyId,
					"Bitrix\Main\UserGroupTable:USER.GROUP_ID" => ID_GROUP_COMPANY_ADMIN
				)
			)
		);
		
		$res = UserTable::getList(array(
			"select" => array("ID","NAME",'EMAIL'),
			"filter" => $arFilter,
		));

		$result = false;
		if (Loader::includeModule('forum')) {
			while ($arRes = $res->fetch()) {
				$arFields = array(
					"AUTHOR_ID"    => $authorId,
					"POST_SUBJ"    => $theme,
					"POST_MESSAGE" => $message,
					"USER_ID"      => $arRes['ID'],
					"FOLDER_ID"    => 1,
					"IS_READ"      => "N",
					"USE_SMILES"   => "N"
					);

				$ID = CForumPrivateMessage::Send($arFields);

				if ((int)$ID > 0)
					$result = true;

				if (null !== $sendEventFields)
				{
					$sendEventFields["EMAIL_ADMIN"] = $arRes['EMAIL'];
					$resSend = CEvent::Send("NEW_ORDER_2", SITE_ID, $sendEventFields);
				}
			}
		}

		return $result;
	}
}

if (!function_exists('getClicksNumber')) {
	function getClicksNumber($bannerId, $sum = true, $companyId = null)
	{
		$result = false;
		$query = $whereField = null;

		if ($companyId !== null)
		{
			$whereField = 'companyid';
			$id = $companyId;
		}
		elseif (!empty($bannerId))
		{
			$whereField = 'bannerid';
			$id = $bannerId;
		}

		if ($whereField !== null)
		{
			$connection = Application::getConnection();
			$sqlHelper = $connection->getSqlHelper();

			if ($sum)
				$query = "SELECT SUM(clicksnumber) FROM `segment_banners` WHERE `" . $whereField . "` = '" . $sqlHelper->forSql($id) . "'";
			else
				$query = "SELECT `clicksnumber`, `datecreate` FROM `segment_banners` WHERE `" . $whereField . "` = '" . $sqlHelper->forSql($id) . "'";

			$row = $connection->query($query)->fetch();
			if (!empty($row))
				$result = $row['SUM(clicksnumber)'];
		}

		return $result;
	}
}




function totalRating()
{
	global $DB;

	if (Loader::includeModule('iblock')) {
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID" => IntVal(IBLOCK_ID_COMPANY), "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
		$totalView = 0;
		while ($company = $res->GetNext()) {
			pre($company);
			// $idArray = $company->GetFields();

			$stat = array();
			$strSql = "SELECT * FROM `segment_views` WHERE MONTH(`CUR_DATE`) = '2018-04-27' AND YEAR(`CUR_DATE`) = YEAR(NOW()) AND `COMPANY_ID` = '" . $company['ID'] . "' AND `IBLOCK_ID` != '" . IBLOCK_ID_BANNERS . "' ORDER BY `ID` DESC";
			$res = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
			while ($company = $res->GetNext())
				$stat[$company['ID']] += $company['NUM_VIEWS'];
		}

		foreach ($stat as $key => $item)
		{
			$totalView += $item;
		}

		pre($totalView);
	}
}



// для синхронизации с 1С)

//$eventManager = \Bitrix\Main\EventManager::getInstance();

 
// $eventManager->addEventHandlerCompatible('iblock', 'OnAfterIBlockElementUpdate',
    // array('ext1cHandler', 'attributeFieldToProps'));
// $eventManager->addEventHandlerCompatible('iblock', 'OnAfterIBlockElementAdd',
    // array('ext1cHandler', 'attributeFieldToProps'));



// class ext1cHandler
// {
    // const CML2_ATTRIBUTES_NAME = 'CML2_ATTRIBUTES';
 
    // protected static $iblockProps = null;
 
    // /**
     // * @param $iblockId
     // * @return array|null
     // */
    // protected static function getIblockProps($iblockId)
    // {
        // if (self::$iblockProps === null) {
            // $resProps = CIBlock::GetProperties($iblockId, Array(), Array());
            // if (intval($resProps->SelectedRowsCount()) > 0) {
                // self::$iblockProps = array();
                // while ($arProp = $resProps->Fetch()) {
                    // self::$iblockProps[$arProp['CODE']] = $arProp['ID'];
                // }
            // }
        // }
        // return self::$iblockProps;
    // }
 
    // /**
     // * @param $arFields
     // */
    // public static function attributeFieldToProps($arFields)
    // {
 
        // if (!self::is1cSync()) return true;
 
        // self::getIblockProps($arFields['IBLOCK_ID']);
 
        // if (empty(self::$iblockProps) || !is_array(self::$iblockProps)) return;
 
        // //получаем массив значений множественного свойства CML2_ATTRIBUTES в которое стандартно выгружаются характеристики ТП из 1С
        // $resCml2Attributes = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], array('sort' => 'asc'), array('CODE' => self::CML2_ATTRIBUTES_NAME));
 
        // while ($arCml2Attribute = $resCml2Attributes->GetNext()) {
 
            // $cml2AttributeName = $arCml2Attribute['DESCRIPTION']; //название характеристики
            // $cml2AttributeValue = $arCml2Attribute['VALUE']; //значение характеристики
 
            // // создание свойства
            // $codeNewProp = self::getTranslit($cml2AttributeName);
 
            // if (!isset(self::$iblockProps[$codeNewProp])) {
 
                // $arFieldsProp = array(
                    // 'NAME' => $cml2AttributeName,
                    // 'ACTIVE' => 'Y',
                    // 'SORT' => '500',
                    // 'CODE' => $codeNewProp,
                    // 'PROPERTY_TYPE' => 'L',
                    // 'IBLOCK_ID' => $arFields['IBLOCK_ID'],
                    // 'VALUES' => array(),
                // );
 
                // $ibp = new CIBlockProperty;
                // if ($propId = $ibp->Add($arFieldsProp)) {
                    // self::$iblockProps[$codeNewProp] = $propId;
                // }
 
            // }
 
            // if (isset(self::$iblockProps[$codeNewProp])) {
 
                // self::getEnumListProp($arFields['IBLOCK_ID'], self::$iblockProps[$codeNewProp]);
 
                // $xmlIdPropValue = self::getTranslit($cml2AttributeValue);
 
                // if (!isset(self::$enumListProps[self::$iblockProps[$codeNewProp]][$xmlIdPropValue])) {
 
                    // $ibpenum = new CIBlockPropertyEnum;
                    // $arFieldsEnum = array(
                        // 'XML_ID' => $xmlIdPropValue,
                        // 'PROPERTY_ID' => self::$iblockProps[$codeNewProp],
                        // 'VALUE' => $cml2AttributeValue
                    // );
 
                    // if ($enumPropValueId = $ibpenum->Add($arFieldsEnum)) {
                        // self::$enumListProps[self::$iblockProps[$codeNewProp]][$xmlIdPropValue] = $enumPropValueId;
                    // }
 
                // }
 
                // if (isset(self::$enumListProps[self::$iblockProps[$codeNewProp]][$xmlIdPropValue])) {
                    // CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], array(
                        // 'VALUE' => self::$enumListProps[self::$iblockProps[$codeNewProp]][$xmlIdPropValue]
                    // ), self::$iblockProps[$codeNewProp]);
                // }
 
            // }
 
        // }
 
    // }
 
    // private static $enumListProps = array();
 
    // /**
     // * @param $iblockId
     // * @param $propId
     // * @return array
     // */
    // protected static function getEnumListProp($iblockId, $propId)
    // {
 
        // if (!isset(self::$enumListProps[$propId])) {
            // $resEnumField = CIBlockPropertyEnum::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => $iblockId, 'PROPERTY_ID' => $propId));
            // if (intval($resEnumField->SelectedRowsCount()) > 0) {
                // self::$enumListProps[$propId] = array();
                // while ($arEnumField = $resEnumField->Fetch()) {
                    // self::$enumListProps[$propId][$arEnumField['XML_ID']] = $arEnumField['ID'];
                // }
            // }
        // }
        // return self::$enumListProps;
 
    // }
 
    // /**
     // * @param $text
     // * @param string $lang
     // * @return string
     // */
    // private static function getTranslit($text, $lang = 'ru')
    // {
 
        // $resultString = CUtil::translit($text, $lang, array(
                // 'max_len' => 50,
                // 'change_case' => 'U',
                // 'replace_space' => '_',
                // 'replace_other' => '_',
                // 'delete_repeat_replace' => true,
            // )
        // );
 
        // if (preg_match('/^[0-9]/', $resultString)) {
            // $resultString = '_' . $resultString;
        // }
 
        // return $resultString;
    // }
 
    // /**
     // * @return bool
     // */
    // private static function is1cSync()
    // {
        // static $is1C = null;
        // if ($is1C === null) {
            // $is1C = (isset($_GET['type'], $_GET['mode']) && $_GET['type'] === 'catalog' && $_GET['mode'] === 'import');
        // }
        // return $is1C;
    // }
 
// }

/*
if (!function_exists('delFromHits')) {
	function delFromHits()
	{
		global $DB;

		$strSql = "SELECT `IBLOCK_ELEMENT_ID` FROM `b_iblock_element_property` WHERE `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_HIT_IN_CATALOG . "'";
		$elem = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
		while ($elId = $elem->GetNext())
		{
			$endDate = null;
			$strSql = "SELECT `VALUE` FROM `b_iblock_element_property` WHERE `IBLOCK_ELEMENT_ID` = '" . $elId['IBLOCK_ELEMENT_ID'] . "'
																		 AND `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_COMPANY_ID_IN_CATALOG . "'";
			$company = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
			if ($companyId = $company->GetNext())
			{
				$strSql = "SELECT `VALUE` FROM `b_iblock_element_property` WHERE `IBLOCK_ELEMENT_ID` = '" . $companyId['VALUE'] . "'
																		     AND `IBLOCK_PROPERTY_ID` = '" . PROPERTY_ID_END_DATE_HITS . "'";
				$dates = $DB->Query($strSql, false, "", array("ignore_dml"=>true));
				if ($date = $dates->GetNext())
					$endDate = $date['VALUE'];
			}

			if (null !== $endDate)
			{
				if (strtotime($endDate) < time())
				{
					if (Loader::includeModule('iblock'))
					{
						$property[PROPERTY_ID_HIT_IN_CATALOG] = array("VALUE" => '');
						CIBlockElement::SetPropertyValuesEx($elId['IBLOCK_ELEMENT_ID'], IBLOCK_ID_CATALOG, $property);
					}
				}
			}
		}
	}
}
*/