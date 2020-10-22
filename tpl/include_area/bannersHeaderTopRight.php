<?php

$page = $APPLICATION->GetCurPage(false);
$tmp = explode('/', $page);
 
        $hostingPage = 100;   // сквозной показ на всех страницах

        $arSelect = array('ID', "PROPERTY_companyId", 'PROPERTY_type', 'PROPERTY_htmlCode', 'PROPERTY_flash', 'PREVIEW_PICTURE');
        $arFilter = array( "IBLOCK_ID" => IBLOCK_ID_BANNERS, 'PROPERTY_hostingPage' => $hostingPage, 'PROPERTY_TYPE' => BANNER_TYPE_UNITED, "ACTIVE"=>"Y");

    $property = 'PROPERTY_DISPLAYINGAREA_ENUM_ID';
   
    if (CModule::IncludeModule("iblock")) {
        $res = CIBlockElement::GetList(array("RAND" => "ASC"), $arFilter, false, array("nTopCount"=>1), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $flash = false;
            $arFields = $ob->GetFields();
            if (!empty($arFields["PROPERTY_FLASH_VALUE"])) {
                $file['src'] = CFile::GetPath($arFields["PROPERTY_FLASH_VALUE"]);
                $ext = substr(strrchr($file['src'], '.'), 1);
                if ('swf' == $ext) {
                    $flash = true;
                }
            } elseif (!empty($arFields["DETAIL_PICTURE"])) {
                $file = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=>640, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            } else {
                $file['src'] = '';
            }
            console_log("Баннер ID: ".$arFields['ID'].", изображение: ".$file['src']);
            // pre($arFields);
            // pre($params[0]);

            // Сохраним на всякий случай правый баннер, если не выведется в основном цикле.
            $tmpRightBanner = $arFields;
            $tmpRightBanner['fileSrc'] = $file['src'];
            $tmpRightBanner['flash'] = $flash; ?>
        <div class="col-xs-12 banner-top-margin">
            <div id='<?php echo $tmpRightBanner['ID']; ?>' class='bannerClick'>
                <?php
                    if ('сдвоенный в шапке' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
                        if ($tmpRightBanner['flash']) { ?>
                <div class="infoblock mainBanner">
                    <object type="application/x-shockwave-flash" data="<?php echo $tmpRightBanner['fileSrc']; ?>" width="310" height="80">
                        <param name="move" value="<?php echo $tmpRightBanner['fileSrc']; ?>">
                    </object>
                </div>
                <?php
                        } else {
                            ?>
                <div class="infoblock altBannerBig alt-banner_united" style='background-image: url("<?php echo $tmpRightBanner['fileSrc']; ?>");'>
                </div>
                <?php
                        }
                    } elseif ('html' == $tmpRightBanner['PROPERTY_TYPE_VALUE']) {
                        echo $tmpRightBanner['PROPERTY_HTMLCODE_VALUE']['TEXT'];
                    } ?>
            </div>
        </div>
 <?php
        }
    } // end if (CModule::IncludeModule("iblock")) {
?>