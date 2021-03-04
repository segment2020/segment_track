// var editorData

// var edDate
// var edTitle
// var edPreview
// var edDetail

// var edPreviewImgLoaded
// var edDetailImgLoaded

// var edPreviewImgID
// var edPreviewImgSrc

// var edDetailImgID
// var edDetailImgSrc


var newData;
var savedDataInput;
var JSONString;
var submitElement;
var detailText = "";
 
if (!newMaterial && !isJsonError) {
	var submitElement = document.getElementById("updateElement");
	if (!editorData) { 
		console.log("Загрузка HTML из старого редактора:");
		var initParseElement = "<div></div>";
		if (edPreviewImgLoaded || edDetailImgLoaded) {
			if (edPreviewImgLoaded && edDetailImgLoaded) {
				var initParseElement = '<div id="edParse">' + edDetail + '<img class="img-preview" data-image-id="' + edPreviewImgID + '" src="' + edPreviewImgSrc + '" alt=""><img class="img-detail" data-image-id="' + edDetailImgID + '" src="' + edDetailImgSrc + '" alt=""></div>';
			} else if (edPreviewImgLoaded) {
				var initParseElement = '<div id="edParse">' + edDetail + '<img class="img-preview" data-image-id="' + edPreviewImgID + '" src="' + edPreviewImgSrc + '" alt=""></div>';
			} else if (edDetailImgLoaded) {
				var initParseElement = '<div id="edParse">' + edDetail + '<img class="img-detail" data-image-id="' + edDetailImgID + '" src="' + edDetailImgSrc + '" alt=""></div>';
			}
		} else {
			var initParseElement = '<div id="edParse">' + edDetail + '</div>';
		}

		newData = mapDOM(initParseElement, false); 
		console.log(newData); 
	} else {
		console.log("Загружаем данные из Json:");
		var newData = JSON.parse(editorData)
		console.log(newData); 
	}  
} else { 
	if (isJsonError) { 
		var submitElement = document.getElementById("updateElement");  
		var initParseElement = "<div id='edParse'>"+edDetail+"</div>";
		console.log("isJsonError");
		alert("Ошибка парсинга HTML-материала, редактор может отобразить его неполным или некорректным.");
		newData = mapDOM(initParseElement, false);  
	} else {
		var submitElement = document.getElementById("addElement");
		newData = {
			"blocks": [ 
				{
					"type": "paragraph",
					"data": {
						"text": ""
					}
				}
			],
			"version": "2.19.1"
		};
	}
	
}

const ImageTool = window.ImageTool;
const editor = new EditorJS({
	holder: "js-editor",
	autofocus: true,
	hideToolbar: true,
	tools: {
		inset: Inset, 
		image: {
			class: ImageTool, 
			config: {
				endpoints: {
					byFile: "/imgload/newImgLoad.php",
					byUrl: "/imgload/newImgLoadURL.php", // доделать
				}
			} 
		}, 
		delimiter: Delimiter,
		linkTool: {
			class: LinkTool,
			config: {
				endpoint: "/imgload/newLinkLoad.php",
			}
		},
		header: {
			class: Header,
			inlineToolbar: true,
			config: {
				placeholder: "Заголовок"
			},
			shortcut: "CMD+SHIFT+H"
		},
		paragraph: {
			config: {
				placeholder: "Нажмите Tab для выбора инструмента",
				inlineToolbar: true
			}
		}, 
		list: {
			class: List,
			inlineToolbar: true,
			shortcut: "CMD+SHIFT+L"
		},
		embed: {
			class: Embed,
			inlineToolbar: false,
			config: {
				services: {
					youtube: true
				}
			}
		}
	},
	i18n: {
		/**
		 * @type {I18nDictionary}
		 */
		messages: {
			ui: {
				"blockTunes": {
					"toggler": {
						"Click to tune": "Нажмите, чтобы настроить",
						"or drag to move": "или перетащите"
					},
				},
				"inlineToolbar": {
					"converter": {
						"Convert to": "Конвертировать в"
					}
				},
				"toolbar": {
					"toolbox": {
						"Add": "Добавить"
					}
				}
			},
			toolNames: {
				"Text": "Параграф",
				"Image": "Картинка",
				"Heading": "Заголовок",
				"List": "Список",
				"Warning": "Примечание",
				"Checklist": "Чеклист",
				"Quote": "Цитата",
				"Code": "Код",
				"Delimiter": "Разделитель",
				"Raw HTML": "HTML-фрагмент",
				"Table": "Таблица",
				"Link": "Ссылка",
				"Marker": "Маркер",
				"Bold": "Полужирный",
				"Italic": "Курсив",
				"InlineCode": "Моноширинный",
			},
			tools: {
				"warning": {
					"Title": "Название",
					"Message": "Сообщение",
				},
				"link": {
					"Add a link": "Вставьте ссылку"
				},
				"stub": {
					"The block can not be displayed correctly.": "Блок не может быть отображен"
				},
				"list": {
					"Ordered": "Нумерованный",
					"Unordered": "Маркированный",
				},
				"image": {
					"With border": "С границей",
					"With background": "C фоном",
					"Stretch image": "Растянуть на ширину",
				}, 
			},
			blockTunes: {
				"delete": {
					"Delete": "Удалить"
				},
				"moveUp": {
					"Move up": "Переместить вверх"
				},
				"moveDown": {
					"Move down": "Переместить вниз"
				}, 
			},
		}
	},
	onReady: () => {
		if (newData) {
			editor.render(newData);
		}
	},
	onChange: () => {
		// var titleCaption = document.querySelector(".ce-preview");
		// if (!titleCaption) {
		// 	editor.blocks.insert("preview", {
		// 		value: ""
		// 	}, {}, 0, true);
		// }
	}
}); 

const testButton = document.getElementById("test-button");
const output = document.getElementById("output");
const detail_text = document.getElementById("detail_text");
const jsonData = document.getElementById("jsonData");

// Сохранить
submitElement.addEventListener("click", () => { 
	editor.save().then(savedData => {
		savedDataInput = JSON.stringify(savedData, null, 4); 
		detailText = jsonToHtml(savedData);
		jsonData.innerHTML = savedDataInput;
		detail_text.innerHTML = detailText; 
	});
});

// Предварительный просмотр.
$(document).on("click", ".newPreviewbtn", function (e) {
	e.preventDefault(); 
	var nameEl = document.getElementById("lk_name");
	var prevTextEl = document.getElementById("ce-preview_text");
	var companyNameEl = document.getElementById("personalPageCompanyName");
	var companyName = "Имя вашей компании"; 
 
	editor.save().then(savedData => {
		savedDataInput = JSON.stringify(savedData, null, 4); 
		detailText = jsonToHtml(savedData);
		
		if (!!companyNameEl)
		companyName = companyNameEl.textContent;

		if (!!nameEl)
			var name = nameEl.value

		if (!!prevTextEl)
			var prevText = prevTextEl.value;
		else
			var prevText = ""; 

		var prewHead = '<div class="detailinfo clearfix"><div class="detailinfofirm floatleft">Публикация компании <a href="#">' + companyName + '</a></div><div class="detailinfolink floatleft"><a href="#"><i class="icon-icons_main-10"></i><span>Все новости компании</span></a></div></div>';

		prevText = '<div class="descrcontent">' + prevText + '</div>'; 

		$('.previewBlock').empty().append('<h1>' + name + '</h1><div class="block-default in block-shadow content-margin previewBlock detailblock"><div class="row">' + prewHead + prevText + detailText + '</div></div>');
	});

});
// // тест перед сохранением
// testButton.addEventListener("click", () => { 
// 	editor.save().then(savedData => { 
// 		savedDataInput = JSON.stringify(savedData, null, 4);
		
// 		detailText = jsonToHtml(savedData);

// 		console.log(savedDataInput);
// 		detail_text.innerHTML = detailText;
// 		jsonData.innerHTML = savedDataInput;
// 	});
// });
/** <!--~~~~~~~ Чеклист ~~~~~~~~~--> 
 * 
 * 1) Переделать заголовок ☑
 * 2) В идеале сделать свой компонент под анонс, либо вариант переделать первый параграф под анонс ☑
 * 3) Анонс использовать по умолчанию? Настроил скрипт который можно включать/выключать, найти зависимости для анонса ☑
 * 4) Модуль загрузки картинок ☑
 * 5) Первая загруженная картинка будет анонсом и заглавной одновременно? -> заглавную не будем трогать, пока не будет ясен функционал ☑
 * 6) Настройки картинки (вширь или врезка) ☑
 * 7) Почему-то не работают обычные ссылки -> поправил ☑
 * 8) Парсим теги? 
 * 9) Модерацию из личного кабинета ☑
 * 10) История изменений
//  <!--~~~~~~~ Чеклист ~~~~~~~~~-->  */