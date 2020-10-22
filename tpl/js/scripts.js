$(document).ready(function () {
	//	Mmenuind

	var menu = new MmenuLight(
		document.querySelector('#mmenu'),
		'all'
	);
	var navigator = menu.navigation({
	});

	var drawer = menu.offcanvas({
	});

	document.querySelector('a[href="#mmenu"]').addEventListener('click', evnt => {
		evnt.preventDefault();
		drawer.open();
	});
	document.querySelector('#mmenu-close').addEventListener('click', evnt => {
		evnt.preventDefault();
		drawer.close();
	});


	//	код до 24.09

	$(document).on('change', '.vote_change', function () {
		var clform = $(this).closest('form');
		if ($('div').is('.block-voiting-ajax')) {
			var clbva = $(this).closest('.block-voiting-ajax');
		} else {
			var id = clform.find('input[name=VOTE_ID]').val();;
			var clbva = $('#form' + id);
		}
		$.ajax({
			type: 'POST',
			//url: '/polls/votingcurrent.php',
			//url: '/polls/form.php',
			url: '/polls/result.php',
			dataType: 'html',
			data: $(this).closest('form').serializeArray(),
			beforeSend: function (data) {
				$('#preloaderBlock').fadeIn(0);
				$('#showmoreblock').fadeOut(0);
			},
			complete: function () {
				$('#preloaderBlock').fadeOut(0);
				$('#showmoreblock').fadeIn(0);
			},
			success: function (request) {
				clbva.empty().append(request);
				console.log(id);
				if (id) {
					$('#result' + id).empty();
					var elem = $('#result' + id).closest('.vote-items-list').find('.showVoteResult');
					elem.removeClass('hideResult');
					elem.text('Результаты');
				}

			}
		});
	});


	// Предварительный просмотр.
	$(document).on('click', '.previewbtn', function (e) {
		e.preventDefault();

		var clform = $(this).closest('form');
		var dettext = '';

		// if (!!$('#bx-html-editor-lk_detailText .bx-editor-iframe').contents().find('body').html() !== false) {
		// dettext = $('#bx-html-editor-lk_detailText .bx-editor-iframe').contents().find('body').html();
		// } else if (!!$('#bx-html-editor-lk_previewText .bx-editor-iframe').contents().find('body').html() !== false) {
		// dettext = $('#bx-html-editor-lk_previewText .bx-editor-iframe').contents().find('body').html();
		// }
		var nameEl = document.getElementById('lk_name');
		var prevTextEl = document.getElementById('lk_previewText');
		var detailTextEl = $('.cke_wysiwyg_frame');
		var companyNameEl = document.getElementById('personalPageCompanyName');
		var companyName = 'Имя вашей компании';

		if (!!companyNameEl)
			companyName = companyNameEl.textContent;

		if (!!nameEl)
			var name = nameEl.value

		if (!!prevTextEl)
			var prevText = prevTextEl.value;
		else
			var prevText = '';

		if (!!detailTextEl)
			var detailText = detailTextEl.contents().find('body').html()

		if (!detailText)
			detailText = '';

		var prewHead = '<div class="detailinfo clearfix"><div class="detailinfofirm floatleft">Публикация компании <a href="#">' + companyName + '</a></div><div class="detailinfolink floatleft"><a href="#"> \
						<i class="icon-icons_main-10"></i><span>Все новости компании</span></a></div></div>';

		prevText = '<div class="descrcontent">' + prevText + '</div>';

		detailText = '<div class="block-default in block-shadow content-margin previewBlock detailblock"><div class="row">' + prewHead + prevText + detailText + '</div></div>';

		$('.previewBlock').empty().append('<h1>' + name + '</h1>' + detailText);
	});


	$('.scrollup').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 1000);
	})

	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});


	$('.open-popup-link').magnificPopup({
		type: 'inline',
		callbacks: {
			open: function () {
				$('.mfp-content').addClass('full-width');
			}
		}
	});

	$('.open-gallery').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});
	if ($('div').is('#aside1')) {
		var a = document.querySelector('#aside1'), b = null, P = 0;
		window.addEventListener('scroll', Ascroll, false);
		document.body.addEventListener('scroll', Ascroll, false);

		function Ascroll() {
			if (b == null) {
				var Sa = getComputedStyle(a, ''), s = '';
				for (var i = 0; i < Sa.length; i++) {
					if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
						s += Sa[i] + ': ' + Sa.getPropertyValue(Sa[i]) + '; '
					}
				}
				b = document.createElement('div');
				b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
				a.insertBefore(b, a.firstChild);
				var l = a.childNodes.length;
				for (var i = 1; i < l; i++) {
					b.appendChild(a.childNodes[1]);
				}
				a.style.height = b.getBoundingClientRect().height + 'px';
				a.style.padding = '0';
				a.style.border = '0';
			}
			var Ra = a.getBoundingClientRect(),
				R = Math.round(Ra.top + b.getBoundingClientRect().height - document.querySelector('#article').getBoundingClientRect().bottom);  // селектор блока, при достижении нижнего края которого нужно открепить прилипающий элемент
			if ((Ra.top - P) <= 0) {
				if ((Ra.top - P) <= R) {
					b.className = 'stop';
					b.style.top = - R + 'px';
				} else {
					b.className = 'sticky';
					b.style.top = P + 'px';
				}
			} else {
				b.className = '';
				b.style.top = '10px';
			}
			window.addEventListener('resize', function () {
				a.children[0].style.width = getComputedStyle(a, '').width
			}, false);
		}

		$('#collapselkmenu').on('shown.bs.collapse', function () {
			Ascroll();
		}).on('show.bs.collapse', function () {
			Ascroll();
		});
	}
	$('.dropdown-top .dropdown-toggle').dropdownHover();

	$('.selectpicker').selectpicker({
		style: 'btn-gray btn-main-filter',
		dropupAuto: false,
		noneSelectedText: 'Ничего не выбрано'
	});

	var mainbxslider = $('.mainbxslider').bxSlider({
		adaptiveHeight: true,
		nextText: '',
		prevText: '',
		auto: true,
		pause: 3000
	});

	var hitsbxslider = $('.hitsbxslider').bxSlider({
		adaptiveHeight: true,
		nextText: '',
		prevText: '',
		pager: false
	});
	if ($(window).width() > 760) {
		$(".segmentscroll").mCustomScrollbar({
			scrollbarPosition: "outside"
		});
	} 
	$(window).resize(function () {

		if (mainbxslider.length) {
			mainbxslider.reloadSlider();
		}
		if (hitsbxslider.length) {
			hitsbxslider.reloadSlider();
		}
	});

	// upload
	/*
	var wrapper = $(".file_upload"),
		inp = wrapper.find( "input" ),
		btn = wrapper.find( "button" ),
		lbl = wrapper.find( "div" );

	btn.focus(function(){
		inp.focus()
	});
	// Crutches for the :focus style:
	inp.focus(function(){
		wrapper.addClass( "focus" );
	}).blur(function(){
		wrapper.removeClass( "focus" );
	});
	*/

	var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;

	$(document).on('change', '.file_upload input', function () {
		var file_name,
			inp = $(this),
			btn = $(this).prev();

		if (file_api && inp[0].files[0])
			file_name = inp[0].files[0].name;
		else
			file_name = inp.val().replace("C:\\fakepath\\", '');

		console.log(file_name);

		if (!file_name.length)
			return;

		btn.text(file_name);

	}).change();

	var alphabetslider = $('.alphabetslider').bxSlider({
		minSlides: 3,
		maxSlides: 50,
		adaptiveHeight: true,
		slideWidth: 30,
		nextText: '',
		prevText: '',
		infiniteLoop: false,
		pager: false,
		controls: false
	});

	var alphabetslider2 = $('.alphabetslider2').bxSlider({
		minSlides: 3,
		maxSlides: 50,
		adaptiveHeight: true,
		slideWidth: 30,
		nextText: '',
		prevText: '',
		infiniteLoop: false,
		pager: false,
		controls: false
	});

	$('.fliteralphabet .prewslid').on('click', function () {
		alphabetslider.goToPrevSlide();
		alphabetslider2.goToPrevSlide();

	});

	$('.fliteralphabet .nextslid').on('click', function () {
		alphabetslider.goToNextSlide();
		alphabetslider2.goToNextSlide();
	});

	$('.langselect input').on('change', function () {
		$('.fliteralphabetblock').toggleClass('show_rus show_eng');
		alphabetslider.reloadSlider();
		alphabetslider2.reloadSlider();
	});

	$('.catalogmainopen').on('click', function () {
		var catalogmainitem = $(this).parent().parent();
		catalogmainitem.toggleClass('cmiclose cmiopen');

		(catalogmainitem.find('.catalogmainopen').text() === '+') ? catalogmainitem.find('.catalogmainopen').text('-') : catalogmainitem.find('.catalogmainopen').text('+');
		console.log($(this).parent().parent().find('.catalogmainopen').text());
		catalogmainitem.children('.catalogmainsubsec').stop().slideToggle();
	});

	//$('.popup-login, .nonpayersfind').tabslet();
	$('.popup-login').tabslet();

	$('.moarfilterblock .btn').on('click', function () {
		$('.advancedsearchblock').stop(true, true).fadeToggle();
	});


	$('.data-table-links tbody tr').on('click', function (e) {
		window.location = $(this).data('link');
	});



	//-----------------------------------------------------
	// Подгрузка событий.
	$('#showmoreblock').on('click', function (e) {
		var elem = $(this);
		var page = elem.attr('data');
		var id = '';

		$('.pastevents div.eventitem').each(function () {
			id += $(this).attr('id') + ',';
		});

		id = id.slice(0, -1);

		$.ajax({
			type: 'POST',
			url: '/ajax/eventsAjax.php',
			dataType: 'html',
			data: 'PAGEN_1=' + page + '&id=' + id,
			beforeSend: function (data) {
				$('#preloaderBlock').fadeIn(0);
				$('#showmoreblock').fadeOut(0);
			},
			complete: function () {
				$('#preloaderBlock').fadeOut(0);
				$('#showmoreblock').fadeIn(0);
			},
			success: function (request) {
				$('.pastevents').append(request);

				var navPageCount = $('.navPageCount').val();
				if (parseInt(page) != parseInt(navPageCount)) {
					++page;
					elem.attr('data', page);
				}
				else {
					elem.remove();
				}
			}
		});
	});
	//-----------------------------------------------------

	//-----------------------------------------------------
	// Опросы.
	$('.showVoteResult').on('click', function (e) {
		var elem = $(this);
		var id = elem.attr('id');

		if (elem.hasClass('hideResult')) {
			$('#result' + id).empty();
			elem.removeClass('hideResult');
			elem.text('Результаты');
		}
		else {
			$.ajax({
				type: 'POST',
				url: '/polls/result.php',
				dataType: 'html',
				data: 'id=' + id,
				beforeSend: function (data) {
					elem.fadeOut(0);
				},
				complete: function () {
					elem.fadeIn(0);
				},
				success: function (request) {
					$('#result' + id).append(request);
					elem.text('Скрыть результаты');
					elem.addClass('hideResult');
				}
			});
		}
	});

	$('.showVoteForm').on('click', function (e) {
		var elem = $(this);
		var id = elem.attr('id');

		if (elem.hasClass('hideForm')) {
			$('#form' + id).empty();
			elem.removeClass('hideForm');
			elem.text('[Голосовать]');
		}
		else {
			$.ajax({
				type: 'POST',
				url: '/polls/form.php',
				dataType: 'html',
				data: 'id=' + id,
				beforeSend: function (data) {
					elem.fadeOut(0);
				},
				complete: function () {
					elem.fadeIn(0);
				},
				success: function (request) {
					$('#form' + id).append(request);
					elem.text('[Скрыть форму]');
					elem.addClass('hideForm');
				}
			});
		}
	});
	//-----------------------------------------------------

	//-----------------------------------------------------
	// Пагинация по количеству элементов.
	$('.elemNumChange').on('change', function () {
		var elem = $(this).parent().submit();
	});
	//-----------------------------------------------------


	// ---------------------------------------------------------
	// Auth modal
	// ---------------------------------------------------------
	var auth_url = '/tpl/ajax/auth.php';
	var auth_timeout = 5000;
	var auth_error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
	var auth_error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';

	$('#h-auth').on('submit', 'form', function () {
		console.log('h-auth_submit');
		$.ajax({
			type: "POST",
			url: auth_url,
			data: $(this).serializeArray(),
			timeout: auth_timeout,
			error: function (request, error) {
				if (error == "timeout") {
					alert(auth_error_timeout);
				}
				else {
					alert(auth_error_default);
				}
			},
			success: function (data) {
				$('.mfp-content #h-auth').html(data);
				//$('#auth-modal .backurl').val(window.location.pathname); - возвратный урл
			}
		});

		return false;
	});

	$('#h-reg').on('submit', 'form', function () {
		console.log('h-reg_submit');
		$.ajax({
			type: "POST",
			url: auth_url,
			data: $(this).serializeArray(),
			timeout: auth_timeout,
			error: function (request, error) {
				if (error == "timeout") {
					alert(auth_error_timeout);
				}
				else {
					alert(auth_error_default);
				}
			},
			success: function (data) {
				$('.mfp-content #h-reg').html(data);
				//$('#auth-modal .backurl').val(window.location.pathname); - возвратный урл
				$('.selectpicker').selectpicker({
					style: 'btn-gray btn-main-filter',
					dropupAuto: false,
					noneSelectedText: 'Ничего не выбрано'
				});
			}
		});

		return false;
	});

	$('.auth-popup-link').magnificPopup({
		type: 'inline',
		callbacks: {
			beforeOpen: function () {
				$('.popup-login ul li a').eq(0).trigger('click');
				/*
				$.ajax({
					type: "POST",
					url: auth_url,
					timeout: auth_timeout,
					error: function(request,error) {
						if (error == "timeout") {
							alert(auth_error_timeout);
						}
						else {
							alert(auth_error_default);
						}
					},
					success: function(data) {
						$('.mfp-content #h-auth').html(data);
						//$(modal.target).find('.backurl').val(window.location.pathname);
					}
				});	
				$.ajax({
					type: "POST",
					url: auth_url,
					timeout: auth_timeout,
					data: 'TYPE=REGISTRATION',
					error: function(request,error) {
						if (error == "timeout") {
							alert(auth_error_timeout);
						}
						else {
							alert(auth_error_default);
						}
					},
					success: function(data) {
						$('.mfp-content #h-reg').html(data);
						//$(modal.target).find('.backurl').val(window.location.pathname);
						$('.selectpicker').selectpicker({
							style: 'btn-gray btn-main-filter',
							dropupAuto: false
						});						
					}
				});	
				*/
			},
			open: function () {
				$('.mfp-content').addClass('auth-width');
			}
		}
	});
	$('.reg-popup-link').magnificPopup({
		type: 'inline',
		callbacks: {
			beforeOpen: function () {
				$('.popup-login ul li a').eq(1).trigger('click');
				/*
				$.ajax({
					type: "POST",
					url: auth_url,
					timeout: auth_timeout,
					error: function(request,error) {
						if (error == "timeout") {
							alert(auth_error_timeout);
						}
						else {
							alert(auth_error_default);
						}
					},
					success: function(data) {
						$('.mfp-content #h-auth').html(data);
						//$(modal.target).find('.backurl').val(window.location.pathname);
					}
				});	
				$.ajax({
					type: "POST",
					url: auth_url,
					timeout: auth_timeout,
					data: 'TYPE=REGISTRATION',
					error: function(request,error) {
						if (error == "timeout") {
							alert(auth_error_timeout);
						}
						else {
							alert(auth_error_default);
						}
					},
					success: function(data) {
						$('.mfp-content #h-reg').html(data);
						//$(modal.target).find('.backurl').val(window.location.pathname);
						$('.selectpicker').selectpicker({
							style: 'btn-gray btn-main-filter',
							dropupAuto: false
						});
					}
				});	
				*/
			},
			open: function () {
				$('.mfp-content').addClass('auth-width');

			}
		}
	});


	//-----------------------------------------------------
	// Фильтр компаний по первой букве.
	// $('a.companyFirstLetter').on('click', function(event){
	// event.preventDefault();

	// var firstLetter = $(this).attr('id');
	// var params = window.location.search;

	// if ('URLSearchParams' in window)
	// {
	// var paramsObj = new URLSearchParams(params);
	// paramsObj.set('firstLetter', firstLetter);
	// params = paramsObj.toString();

	// var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params;
	// document.location.href = newUrl;
	// }
	// });

	// $('#showAllcompany').on('click', function(event){
	// event.preventDefault();
	// var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
	// document.location.href = newUrl;
	// });
	//-----------------------------------------------------


	//--------------------------------------------------------------
	//------ Подгрузка областей и городов в расширенном фильтре ----
	$('#regionsList').on('change', function () {
		$('#citiesListBlock').addClass('hide');
		var id = $("option:selected", this).val();
		$.ajax({
			type: 'GET',
			url: '/ajax/cities.php',
			dataType: 'html',
			data: 'sectionId=' + id,
			success: function (request) {
				$('#areaList').empty();
				$('#areaList').append(request);

				$('#areaList').selectpicker('refresh');
				$('#areaListBlock').removeClass('hide');
			}
		});
	});

	$('#areaList').on('change', function () {
		var id = $("option:selected", this).val();
		$.ajax({
			type: 'GET',
			url: '/ajax/cities.php',
			dataType: 'html',
			data: 'subSectionId=' + id,
			success: function (request) {
				$('#citiesList').empty();
				$('#citiesList').append(request);

				$('#citiesList').selectpicker('refresh');
				$('#citiesListBlock').removeClass('hide');
			}
		});
	});
	//--------------------------------------------------------------

	//--------------------------------------------------------------
	//---------- Подгрузка категорий при добавлении товара ---------
	$('#catalogId').on('change', function () {
		$('#subCategoryListBlock').addClass('hide');
		var id = $("option:selected", this).val();
		$.ajax({
			type: 'GET',
			url: '/ajax/categories.php',
			dataType: 'html',
			data: 'sectionId=' + id,
			success: function (request) {
				$('#categoryId').empty();
				$('#subCategoryId').empty();
				$('#categoryId').append(request);

				$('#categoryId').selectpicker('refresh');
				$('#categoryListBlock').removeClass('hide');
			}
		});
	});
	/*
		$('#categoryId').on('change', function(){
			var id = $("option:selected", this).val();
			$.ajax({
				type: 'GET',
				url: '/ajax/categories.php',
				dataType: 'html',
				data: 'subSectionId=' + id,
				success: function (request){
					$('#subCategoryId').empty();
					$('#subCategoryId').append(request);
	
					$('#subCategoryId').selectpicker('refresh');
					$('#subCategoryListBlock').removeClass('hide');
				}
			});
		});
		*/
	//--------------------------------------------------------------


	//----------------------------------------------------------------------
	//---- Подстановка даты начала активности в форме добавления из ЛК. ----
	function createDateTime(date, hours, minutes) {
		var time = '';
		var currentDate = new Date();
		var day = (currentDate.getDate() < 10) ? '0' + currentDate.getDate() : currentDate.getDate();
		var month = (currentDate.getMonth() < 9) ? '0' + (currentDate.getMonth() + 1) : currentDate.getMonth() + 1;
		var newDate = day + '.' + month + '.' + currentDate.getFullYear();


		if ('' != hours)
			time = hours;
		else
			time = '00';

		if ('' != minutes)
			time += ':' + minutes + ':00';
		else
			time += ':00:00';

		if ('' != date)
			newDate = date + ' ' + time;
		else
			newDate += ' ' + time;

		return newDate;
	}

	$('.addItemFromPersonalPage').on('submit', function (event) {
		var date = $('.dateActiveFrom').val();
		var hours = $("#hours option:selected", this).val();
		var minutes = $("#minutes option:selected", this).val();
		var newDate = createDateTime(date, hours, minutes);

		$('.dateActiveFrom').val(newDate);

		// return false;
	});

	$('.addEventFromPersonalPage').on('submit', function (event) {
		var date = $('.dateBegin').find('input').val();
		var hours = $("#hoursEvent option:selected", this).val();
		var minutes = $("#minutesEvent option:selected", this).val();
		var newDate = createDateTime(date, hours, minutes);

		var dateEnd = $('#lk_evED').find('input').val();
		var hoursEnd = $("#hoursEventEnd option:selected", this).val();
		var minutesEnd = $("#minutesEventEnd option:selected", this).val();
		var newDateEnd = createDateTime(dateEnd, hoursEnd, minutesEnd);

		$('#lk_beginEventTime').val(newDate);
		$('#lk_beginEventTimeEnd').val(newDateEnd);

		date = $('.dateActiveFrom').val();
		hours = $("#hours option:selected", this).val();
		minutes = $("#minutes option:selected", this).val();
		newDate = createDateTime(date, hours, minutes);

		$('.dateActiveFrom').val(newDate);

		// return false;
	});
	//----------------------------------------------------------------------


	//----------------------------------------------------------------------
	//----------------- Подстановка имени выбранного файла и превью выбранного изображения. ----------------
	$("div.content-margin, div.lk_companylogobtn").on('change', 'input[type=file].fileUpload', setFileName);

	function setFileName() {
		// console.log($(this).closest('.lk_companylogoblock').html());
		var thisinput = $(this);
		var id = $(this).attr('id');
		var fileName = $(this).val().replace(/.*\\/, "");
		var elem = $("#" + id + "FileName");
		var input = this;

		$("#" + id + "FileName").text(fileName);
		// console.log(id);
		// console.log(fileName);
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				//$(this).closest('.lk_companylogoblock').find('img').attr('src', e.target.result);
				thisinput.closest('.lk_companylogoblock').find('img').attr('src', e.target.result);

			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	//----------------------------------------------------------------------


	//-------------------------------------------------------------------------------
	//--- Добавление поля для телефона в форме добавления/редактирования событий. ---
	$('.addPhone').on('click', function () {
		var name = $('.templatePhone').find('input').attr('name');
		var nameNum = $('.templatePhone').find('input').attr('id');
		var posNum = name.lastIndexOf('[');
		var tempName = name.slice(0, posNum + 1);

		$('.templatePhone input').clone().appendTo('.phoneList');

		++nameNum;
		var newName = tempName.concat(nameNum, ']');
		$('.templatePhone input').attr('id', nameNum);
		$('.templatePhone input').attr('name', newName);
	});
	//-------------------------------------------------------------------------------




	// Попробуем нативный JS...
	// document.addEventListener('DOMContentLoaded', function(){    ---   уже находимся в $(document).ready(function () {

	// Универсальная функция для создания нового объекта XMLHttpRequest
	function getXhrObject() {
		if (typeof XMLHttpRequest === 'undefined') {
			XMLHttpRequest = function () {
				try {
					return new window.ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) { }
			};
		}

		return new XMLHttpRequest();
	}

	var applyBtn = document.querySelectorAll('.apply');
	var fireBtn = document.querySelectorAll('.fire');

	// querySelectorAll возвращает все элементы с классом apply, поэтому пройдёмся по каждому элементу списка.
	[].forEach.call(applyBtn, function (el) {
		el.addEventListener('click', handler); // Такой способ экономит память, т.к на каждую итерацию цикла будет создана только маленькая новая функция, а большая будет всего-лишь вызываться.
	});

	[].forEach.call(fireBtn, function (el) {
		el.addEventListener('click', handlerFire); // Такой способ экономит память, т.к на каждую итерацию цикла будет создана только маленькая новая функция, а большая будет всего-лишь вызываться.
	});


	function handlerFire() {
		var userId = this.id;

		return changeStatus(2, userId);
	}

	function handler() {
		var userId = this.id;

		//var selectElement = document.querySelectorAll('#s' + userId, 'select');
		var selectedIndex = document.getElementById('s' + userId).selectedIndex;
		var userStatus = document.getElementById('s' + userId).options[selectedIndex].value;

		return changeStatus(1, userId, userStatus);
	}

	function toggleClass(userId) {
		var message = document.getElementById('statusOk' + userId);
		message.classList.toggle('hideElement');
		setTimeout(function () { message.classList.toggle('hideElement'); }, 2000);
	}

	function changeStatus(actionNum, userId, userStatus) {
		// получаем новый XMLHttpRequest-объект
		var xhr = getXhrObject();
		if (xhr) {
			var url = '/formsActions/';
			var params = new Array('actionNum=' + actionNum, 'userId=' + userId);

			if (1 == actionNum)
				params.push('groupId=' + userStatus);

			// Для GET-запроса 
			//url += '?' + params.join('&');

			xhr.open('POST', url, true); // открываем соединение
			// заголовки - для POST-запроса
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			//xhr.setRequestHeader('Content-length', params.length);
			//xhr.setRequestHeader('Connection', 'close');

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) { // проверяем стадию обработки и статус ответа сервера
					console.log(xhr.responseText);
					response = JSON.parse(xhr.responseText);
					if ('OK' != response.status)
						console.log('status FAIL, message: ', response.message);
					else {
						if (2 == actionNum)
							document.getElementById('userBlock' + userId).remove();
						else
							toggleClass(userId);
					}

					console.log('readyState OK');

					//output.innerHTML = JSON.parse(xhr.responseText); // если все хорошо, то выводим полученный ответ
				}
				else {
					console.log('readyState != 4');
				}
			}

			// стартуем ajax-запрос
			xhr.send(params.join('&')); // для GET запроса - xhr.send(null);
		}

		return false;
	}
	//});

	$('.printBlock').click(function () {
		$('body').addClass('printSelected'); //добавляем класс <body>      
		$('body').append("<div class='printSelection'></div>"); //создаем "призрачный" блок для печати      
		$('.printblock').clone().appendTo('.printSelection');  // вставляем в блок то, что нужно вывести на печать (в данном случае лишь картинку)        
		//$("<p><img src='../images/logo-grey.jpg'></p>").insertBefore('.printSelection img'); // в шаблон печати добавляем сверху логотип компании      
		window.print(); // выводи на печать      
		window.setTimeout(pageCleaner, 0); // затираем следы 
	});


	//-----------------------------------------------------------------------------------
	// Проверка на пустые поля элемента(публикации).
	var btn = document.getElementById('addElement');
	if (!!btn) {
		btn.addEventListener('click', function (event) {
			var error = false;

			// Проверка на пустое имя элемента(публикации).
			var elName = document.getElementById('lk_name');
			if (!!elName && '' == elName.value) {
				error = true;
				elName.classList.add('errorField');
			}
			else {
				elName.classList.remove('errorField');
			}

			var brand = document.getElementById('brands');
			if (!!brand) {

			}

			// Анонс не более 500 знаков.
			var previewText = document.querySelector('#lk_previewText');
			if (!!previewText && previewText.value.length > 500) {
				previewText.classList.add('errorField');
				$('#errorText500').removeClass('hide');
				event.preventDefault();
				return false;
			}
			else {
				$('#errorText500').addClass('hide');
			}

			// Проверка на пустое поле ДАТА НАЧАЛА и ДАТА ОКОНЧАНИЯ для событий.
			var beginDateInput = document.querySelector('div#lk_evBD input');
			if (!!beginDateInput && '' == beginDateInput.value) {
				beginDateInput.classList.add('errorField');
				error = true;
			}

			var endDateInput = document.querySelector('div#lk_evED input');
			if (!!endDateInput && '' == endDateInput.value) {
				endDateInput.classList.add('errorField');
				error = true;
			}

			// Проверка на пустое поле ИМЯ АВТОРА для мнений.
			var nameAuthor = document.getElementById('lk_nameAuthor');
			if (!!nameAuthor && '' == nameAuthor.value) {
				nameAuthor.classList.add('errorField');
				error = true;
			}

			// Проверка на пустое поле ЦЕНА.
			var price = document.getElementById('lk_price');
			if (!!price && '' == price.value) {
				price.classList.add('errorField');
				error = true;
			}

			// Проверка на пустое поле Ссылка в баннерах.
			var bannerLink = document.getElementById('lk_link');
			if (!!bannerLink && '' == bannerLink.value) {
				bannerLink.classList.add('errorField');
				error = true;
			}

			// Проверка на выбранный раздел в баннерах.
			var hostingPage = document.getElementById('lk_hostingPage');
			if (!!hostingPage && '' == hostingPage.value) {
				document.getElementById('errorPage').classList.remove('hide');
				error = true;
			}
			else if (!!hostingPage && '' != hostingPage.value) {
				document.getElementById('errorPage').classList.add('hide');
			}

			// Проверка типа баннера.
			var bannerType = document.getElementById('lk_bannerType');
			if (!!bannerType && '62' == bannerType.value) // 62 - id типа 'обычный'.
			{
				var flashBanner = document.getElementById('flashBanner');
				if (null === flashBanner) {
					var file = document.getElementById('previewPicture');
					if (!!file && '' == file.value) {
						document.getElementById('previewPictureBlock').classList.add('errorField');
						error = true;
					}
				}
			}
			else if (!!bannerType && '63' == bannerType.value) // 63 - id типа 'html'.
			{
				var htmlCode = document.getElementById('lk_htmlCode');
				if (0 == htmlCode.value.length) {
					htmlCode.classList.add('errorField');
					error = true;
				}
			}

			// Проверка даты 'выделено до'.
			var inTheTop = document.getElementById('inTheTop');
			if (!!inTheTop && inTheTop.checked) {
				var dateMarkedTo = document.getElementById('inTopDate');
				var date = dateMarkedTo.nextElementSibling;
				if ('' == date.value) {
					date.classList.add('errorField');
					error = true;
				}
			}

			// Проверка на прикреплённый файл в каталогах PDF.
			var file = document.getElementById('catalog');
			if (!!file && '' == file.value) {
				document.getElementById('catalogFile').classList.add('errorField');
				error = true;
			}
			else if (!!file) {
				var parts = file.files[0].name.split('.');

				if (parts.length > 1)
					var ext = parts.pop().toLowerCase();

				if (!!ext && 'pdf' != ext) {
					document.getElementById('errorExt').classList.remove('hide');
					error = true;
				}
				else
					document.getElementById('errorExt').classList.add('hide');
			}

			if (error) {
				document.getElementById('errorText').classList.remove('hide');
				event.preventDefault();
			}
		});
	}

	// Проверка на пустые поля элемента(публикации).
	var btn = document.getElementById('updateElement');
	if (!!btn) {
		btn.addEventListener('click', function (event) {
			var error = false;

			// Проверка на пустое имя элемента(публикации).
			var elName = document.getElementById('lk_name');
			if (!!elName && '' == elName.value) {
				error = true;
				elName.classList.add('errorField');
			}
			else {
				elName.classList.remove('errorField');
			}

			// Анонс не более 500 знаков.
			var previewText = document.querySelector('#lk_previewText');
			if (!!previewText && previewText.value.length > 500) {
				previewText.classList.add('errorField');
				$('#errorText500').removeClass('hide');
				event.preventDefault();
				return false;
			}
			else {
				$('#errorText500').addClass('hide');
			}

			if (error) {
				document.getElementById('errorText').classList.remove('hide');
				event.preventDefault();
			}
		});
	}

	//-----------------------------------------------------------------------------------


	var addPriceListBtn = document.getElementById('addPriceList');
	if (!!addPriceListBtn) {
		addPriceListBtn.addEventListener('click', function (event) {
			var priceListName = document.getElementById('priceListName');
			if ('' == priceListName.value) {
				event.preventDefault()
				priceListName.classList.add('errorField');
				return false;
			}
		});
	}

	// Установим фокус на поле ЗАГОЛОВОК при добавлении элемента.
	var nameElement = document.getElementById("lk_name")
	if (!!nameElement)
		nameElement.focus();

	$('#inTheTop').on('change', function () {
		if ($(this).prop("checked"))
			$('#markedTo').removeClass('hide');
		else
			$('#markedTo').addClass('hide');
	});


	// Выбор страны в фильтре фирм.
	var selectCountry = document.getElementById('country');
	if (!!selectCountry) {
		selectCountry.addEventListener('change', function () {
			var optionCountry = selectCountry.options[selectCountry.selectedIndex].text;
			if ('Россия' !== optionCountry) {
				document.getElementById('cityNameBlock').classList.remove('hide');
				document.getElementById('regionListBlock').classList.add('hide');
			}
			else {
				document.getElementById('cityNameBlock').classList.add('hide');
				document.getElementById('regionListBlock').classList.remove('hide');
			}
		});
	}



	$('a.viewCalc').on('click', function (event) {
		var id = $(this).attr('id');
		viewCalc(id);
	})


	$('.bannerClick').on('click', function () {
		var id = $(this).attr('id');
		var href = '/banners/?id=' + id;

		// window.location.href = href;
		window.open(href);
	});
}); // end $(document).ready(function () {


function viewCalc(id) {
	$.ajax({
		method: 'POST',
		url: '/ajax/viewCalc.php',
		dataType: 'json',
		data: { id: id },
		success: function (request) {
		}
	});
}

function pageCleaner() {
	$('body').removeClass('printSelected');
	$('.printSelection').remove();
}


