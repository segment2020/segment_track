<div class="col-xs-12">  
    <?
        if ($APPLICATION->GetCurPage() == "/personal/moderation/edit/") {
        ?>       
        <input type="hidden" name='PROPERTY[MODERATION][0]' value="Y">  
        <? } ?>
    <div class="ce-maintitle">
        <input type="text" id="lk_name" name='PROPERTY[NAME][0]' placeholder="Заголовок*" value="<? echo $name; ?>">
    </div>
    <div class="ce-preview">
        <? 
            $imgInsideTag = ""; 
            if ($previewPictureSrc) { 
                $file = CFile::ResizeImageGet($previewPictureId, array('width'=>100, 'height'=>75), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $imgInsideTag = "block-with-img";
            } else { 
                $file['src'] = "";
                $imgInsideTag = "block-without-img";
            }  
            if ($createNewMaterial || $moveToValue == NULL) $moveToValue = $iBlockId; 
        ?>

        <div class="lk_companylogoblock clearfix <? echo $imgInsideTag; ?>">
            <div class="lk_companylogoimg lk_companylogoimgEditForm">
                <img src="<? echo $file['src']; ?>" border="0" />
            </div>
            <div class="lk_companylogotextEditForm">
                <div class="lk_companylogobtn">
                    <input type="hidden" name="PROPERTY[PREVIEW_PICTURE][0]" value="<? echo $previewPictureId; ?>" />
                    <input type="file" class='hide fileUpload' id='previewPicture' name="PROPERTY_FILE_PREVIEW_PICTURE_0" />
                    <label for='previewPicture'>
                        <div class="btn btn-blue btnplus minbr">
                            <span class="plus text-center">+</span>
                            Выбрать картинку анонса
                        </div>
                    </label>
                </div>
            </div>

            <? if ('' != $file['src']) { ?>
            <div class="block_del_img">
                <span id='previewPictureFileName'></span>
                <input type="checkbox" name="DELETE_FILE[PREVIEW_PICTURE][0]" id="file_delete_PREVIEW_PICTURE_0" value="Y">
                <label for="file_delete_PREVIEW_PICTURE_0"> удалить изображение</label>
            </div>
            <?}?>
        </div>

        <textarea placeholder="Анонс публикации" id="ce-preview_text" name="PROPERTY[PREVIEW_TEXT][0]"><? echo strip_tags($previewText); ?></textarea>
    </div>
    <div id="js-editor"></div>
    <div class="block-moveTo clearfix">Поместить материал в:
        <select id="moveTo" name="PROPERTY[<?= $moveToId ?>][0]"> 
            <option value="<?= IBLOCK_ID_NEWS_COMPANY ?>"<?if ($moveToValue == IBLOCK_ID_NEWS_COMPANY) {?> selected<?}?>>Новости компании</option>
            <option value="<?= IBLOCK_ID_NEWS_INDUSTRY ?>"<?if ($moveToValue == IBLOCK_ID_NEWS_INDUSTRY) {?> selected<?}?>>Новости отрасли</option>
        <?  if (CSite::InGroup(array(9))) { ?>
            <option value="<?= IBLOCK_ID_LIFE_INDUSTRY ?>"<?if ($moveToValue == IBLOCK_ID_LIFE_INDUSTRY) {?> selected<?}?>>Редакционные статьи</option>
        <? } ?>
            <option value="<?= IBLOCK_ID_VIEWPOINT ?>"<?if ($moveToValue == IBLOCK_ID_VIEWPOINT) {?> selected<?}?>>Мнения</option>
            <option value="<?= IBLOCK_ID_PRODUCTS_REVIEW ?>"<?if ($moveToValue == IBLOCK_ID_PRODUCTS_REVIEW) {?> selected<?}?>>Товарные обзоры</option>
            <option value="<?= IBLOCK_ID_STOCK ?>"<?if ($moveToValue == IBLOCK_ID_STOCK) {?> selected<?}?>>Акции</option>
            <option value="<?= IBLOCK_ID_NOVETLY ?>"<?if ($moveToValue == IBLOCK_ID_NOVETLY) {?> selected<?}?>>Новинки</option> 
        </select> 
    </div> 
    <? if ( CSite::InGroup(array(1)) ) {?>
    <fieldset class="fld-checkbox">
        <label for="active_prop" id="check_on-off" class="floatleft">
            <input type="checkbox" name="active_prop" id="fld-checkbox--activate" <? if ($isActiveMaterial) {?> checked<? }?>> Активировать
            <input id="check_first-load" type="hidden" name="PROPERTY[ACTIVE]" value="<? if ($isActiveMaterial) {?>Y<?} else {?>N<?} ?>">
        </label>
        <script> 
            $("#fld-checkbox--activate").click(function() { 
                if ($(this).prop("checked") == false) {
                    $(this).next().remove();
                    $(this).after("<input type='hidden' name='PROPERTY[ACTIVE]' value='N'>")
                } else {
                    $(this).next().remove();
                    $(this).after("<input type='hidden' name='PROPERTY[ACTIVE]' value='Y' checked>")
                }
            });
        </script>
    </fieldset>
    <?  }   elseif (CSite::InGroup(array(5))) { ?>
    <input type="hidden" name="PROPERTY[ACTIVE]" value="N">
    <?  }   elseif (CSite::InGroup(array(6))) { ?>
    <input type="hidden" name="PROPERTY[ACTIVE]" value="N">
    <?  }   else    { ?>
    <? } ?>
    <div class="hide">
        <pre id="output"></pre>    
        <textarea id="detail_text" rows="15" cols="70" name="PROPERTY[DETAIL_TEXT][0]">
            <? echo htmlspecialchars_decode($detailText); ?>
        </textarea>
        <input type="hidden" name="PROPERTY[DETAIL_TEXT_TYPE][0]" value="html"> 
        <textarea id="jsonData" rows="15" cols="70" name="PROPERTY[<?= $editorDataId ?>][0]"><? echo htmlspecialchars_decode($editorData); ?></textarea>
    </div>
</div>

<?   
?> 
<script src="/tpl/js/editor/editor-inset.js"></script>
<script src="/tpl/js/editor/editor-header.js"></script> 
<script src="/tpl/js/editor/editor-image.js"></script>
<script src="/tpl/js/editor/editor-delimiter.js"></script>
<script src="/tpl/js/editor/editor-list.js"></script>
<script src="/tpl/js/editor/editor-checklist.js"></script>
<script src="/tpl/js/editor/editor-embed.js"></script>
<script src="/tpl/js/editor/editor-link.js"></script>
<script src="/tpl/js/editor/editor.js"></script>
<script>
    var decodeEntities = (function() {

        var element = document.createElement('div');

        function decodeHTMLEntities(str) {
            if (str && typeof str === 'string') {
                str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
                str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
                element.innerHTML = str;
                str = element.textContent;
                element.textContent = '';
            }

            return str;
        }

        return decodeHTMLEntities;
    })();

    var decodeQuote = (function() {

        var element = document.createElement('div');

        function decodeQuoteEntities(str) {
            str = str.replace(/&quot;/g, '"');
            str = str.replace(/&amp;quot;/g, '"');
            str = str.replace(/  +/g, ' ');
            element.innerHTML = str;
            str = element.textContent;
            element.textContent = '';

            return str;
        }

        return decodeQuoteEntities;
    })();

    function isJson(item) {
        item = typeof item !== "string" ? JSON.stringify(item) : item;

        try {
            item = JSON.parse(item);
        } catch (e) {
            return false;
        }

        if (typeof item === "object" && item !== null) {
            return true;
        }

        return false;
    }

    // парсим в domElement !Обязательное условие - обернуть всё в 1 <div id="edParse"></div>  
    function mapDOM(element, json) {
        var treeObject = {};
        var parser = new DOMParser();
        var docNode;
        docNode = parser.parseFromString(element, "text/html");

        function toTree(element, objectJson, root) {
            var nodeList = element.childNodes;
            if (nodeList != null) {
                if (nodeList.length) {
                    objectJson["blocks"] = [];
                    for (var i = 0; i < nodeList.length; i++) {
                        if (nodeList[i].localName == "parsererror") {
                            alert("Ошибка парсинга материала, редактор может отобразить его неполным или некорректным.");
                            continue;
                        } else if (nodeList[i].nodeType == 1) {
                            if (nodeList[i].tagName == "p") {
                                objectJson.blocks[objectJson.blocks.length] = {
                                    "type": "paragraph",
                                    "data": {
                                        "text": nodeList[i].innerHTML
                                    }
                                }
                                objectJson["blocks"].push({});
                            }
                            // else if (nodeList[i].tagName == "DIV" && nodeList[i].className == "ce-preview") {
                            // 	objectJson.blocks[objectJson.blocks.length] = {
                            // 		"type": "preview",
                            // 		"data": {
                            // 			"value": nodeList[i].firstChild.value
                            // 		}
                            // 	}
                            // }
                            else if (nodeList[i].tagName == "IMG" && (nodeList[i].className == "img-detail" || nodeList[i].className == "img-preview")) {
                                var imgCaption;
                                imgCaption = (nodeList[i].className == "img-detail") ? imgCaption = "Главная картинка" : imgCaption = "Картинка анонса";
                                objectJson.blocks[objectJson.blocks.length] = {
                                    "type": "image",
                                    "data": {
                                        "file": {
                                            "url": nodeList[i].src
                                        },
                                        "caption": imgCaption,
                                        "withBorder": false,
                                        "withBackground": false,
                                        "stretched": false
                                    }
                                }
                            } else {
                                objectJson.blocks[objectJson.blocks.length] = {
                                    "type": "paragraph",
                                    "data": {
                                        "text": nodeList[i].innerHTML
                                    }
                                }
                            }
                            //  текст без обёртки
                        } else {
                            if (nodeList[i].nodeType == 3) {
                                objectJson.blocks[objectJson.blocks.length] = {
                                    "type": "paragraph",
                                    "data": {
                                        "text": nodeList[i].innerHTML
                                    }
                                }
                            } else {
                                treeJson(nodeList[i], objectJson["blocks"][objectJson.blocks.length], false);
                            }
                        }
                    }
                }
                if (element.attributes != null) {
                    if (element.attributes.length) {
                        objectJson["attributes"] = {};
                        for (var i = 0; i < element.attributes.length; i++) {
                            objectJson["attributes"][element.attributes[i].nodeName] = element.attributes[i].nodeValue;
                        }
                    }
                }
            }
        }
        toTree(docNode.querySelector("#edParse"), treeObject, true);
        treeObject["version"] = "2.19.1";
        return (json) ? JSON.stringify(treeObject) : treeObject;
    }

    // предварительный просмотр и парсинг в HTML детальное описание
    function jsonToHtml(articleObj) {
        var caption;
        var articleHTML = "";
        articleObj.blocks.map(obj => {
            switch (obj.type) {
                case "header":
                    articleHTML += `<h${obj.data.level} class="post_header"> ${obj.data.text}  </h${obj.data.level}>`
                    break;
                case "paragraph":
                    articleHTML += `<p class="post_caption"> ${obj.data.text} </p>`
                    break;
                case "image":
                    stretched = obj.data.stretched ? " post_image--stretched" : "";
                    withBorder = obj.data.withBorder ? " post_image--withBorder" : "";
                    withBackground = obj.data.withBackground ? " post_image--withBackground" : "";
                    caption = obj.data.caption ? `<div class="post_caption"> <p>${obj.data.caption}</p> </div>` : "";
                    articleHTML += `<div class="post_image${stretched}${withBorder}${withBackground}"> <img src="${obj.data.file.url}" alt="${obj.data.caption}"/> ${caption}</div>`; 
                    break;
                case "delimiter":
                    articleHTML += `<div class="post_delimiter post_block"></div>`
                    break;
                case "linkTool":
                    articleHTML += `<a class="link-tool__content link-tool__content--rendered" target="_blank" rel="nofollow noindex noreferrer" href="${obj.data.link}"><div class="link-tool__title">${obj.data.meta.title}</div><p class="link-tool__description">${obj.data.meta.description}</p></a>`
                    break;
                case "list":
                    if (obj.data.style = "ordered") {
                        listStyle = "ol";
                    }
                    if (obj.data.style = "unordered") {
                        listStyle = "ul";
                    }
                    articleHTML += `<${listStyle} class="list__block">`;
                    for (var i = 0; i < obj.data.items.length; i++) {
                        articleHTML += `<li class="list__item">${obj.data.items[i]}</li>`;
                    } 
                    articleHTML += `</${listStyle}>`; 
                    break; 
                case "quote":
                    articleHTML += "блок quote не обработан"
                    break;
                case "warning":
                    articleHTML += "блок warning не обработан"
                    break;
                case "checklist":
                    articleHTML += "блок checklist не обработан"
                    break;
                case "embed":
                    articleHTML += `<div class="block-default block-shadow"><div class="videoifame"><iframe width="${obj.data.width}" height="${obj.data.height}" src="${obj.data.embed}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>` 
                    break;
                default:
                    return "";
            }
        });


        return articleHTML;
    }

    var newMaterial = <?php echo json_encode($createNewMaterial); ?>;

    if (newMaterial == 0) {
        var edDate = <?php echo json_encode(strtotime($date_x)); ?>;
        var edTitle = <?php echo json_encode($name); ?>;
        var edPreviewImgLoaded = false;
        var edDetailImgLoaded = false;
        var editorData = decodeQuote(<?php echo json_encode($editorData); ?>); 

        var isJsonError = isJson(editorData) ? false : true;

        <?php if (!empty($previewPictureId)) { ?>
            var edPreviewImgLoaded = true;
            var edPreviewImgID = <?php echo json_encode($previewPictureId); ?>;
            var edPreviewImgSrc = <?php echo json_encode($previewPictureSrc); ?>;
        <?php  } ?>
        <?php if (!empty($detailPictureId)) { ?>
            var edDetailImgLoaded = true;
            var edDetailImgID = <?php echo json_encode($detailPictureId); ?>;
            var edDetailImgSrc = <?php echo json_encode($detailPictureSrc); ?>;
        <?php  } ?>

        var edPreview = decodeEntities(<?php echo json_encode($previewText); ?>);
        var edDetail = <?php echo json_encode(htmlspecialchars_decode($detailText)); ?>;

        var edDetailOld = decodeEntities(<?php echo json_encode($detailText); ?>);
    }
</script>
<script src="/tpl/js/editor/editor-init.js" type="module"></script>