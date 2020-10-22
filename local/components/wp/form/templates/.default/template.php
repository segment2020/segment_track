<div class="block-default in block-shadow content-margin">
	<form action='' method='POST' id='feedBack'>
		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="name">Имя*</label>
					<input type="text" class="form-control" id="name" name='name' value="">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="email">E-mail*</label>
					<input type="text" class="form-control" id="email" name='email' value="">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="title">Заголовок*</label>
					<input type="text" class="form-control" id="title" name='title' value="">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="comment">Комментарий*</label>
					<textarea class='form-control maintextarea' id='comment' name="comment"></textarea>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="control-label mainlabel" for="recaptcha"></label>
					<div class="g-recaptcha" id='recaptcha' data-sitekey="<?=RE_SITE_KEY?>"></div>
				</div>
			</div>
		</div>

		<div class="seporator lksep"></div>
		<input type="submit" name="iblock_submit" id='sendFeedBack' value="Отправить" class="btn btn-blue-full minbr" />
		
	</form>
	<style>
	   .mess-red {color:red}
	   .mess-green {color:green}
	</style>
	<div id='mess' class="" style='margin-top: 10px;'></div>
</div>

<script>
$(document).ready(function () {
	function isValidEmailAddress(emailAddress) {
		var pattern = /^[-a-z0-9~!$&%^*_=|~+}{\'?]+(\.[-a-z0-9~!$&%^*_=|~+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|asia|biz|ru|com|coop|edu|gov|info|int|jobs|mil|museum|name|net|org|pro|tel|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
		var res = pattern.test(emailAddress);
		return res;
    }

	$("#sendFeedBack").on('click', function(event){
		event.preventDefault();
		var feedBack = $("#feedBack");
		var name = $("#name");
		var email = $("#email");
		var title = $("#title");
		var comment = $("#comment");
		var mess = $("#mess");
		var error = false;

		if (name.val() == "")
        {
			error = true;
			name.addClass("errorField");
		}
        else
        {
			name.removeClass("errorField");
		}

		if (email.val() == "" || (false == isValidEmailAddress(email.val())))
        {
			error = true;
			email.addClass("errorField");
		}
        else
        {			
			email.removeClass("errorField");
		}

		if (title.val() == "")
        {
			error = true;
			title.addClass("errorField");
		}
        else
        {
			title.removeClass("errorField");
		}

		if (comment.val() == "")
        {
			error = true;
			comment.addClass("errorField");
		}
        else
        {
			comment.removeClass("errorField");
		}

		if (!error){
			var data = $("#feedBack").serialize();
			$.post(
				"",
				data,
				function(req){
					if (req.success) {
                        console.log('send OK');
                        mess.removeClass("mess-red");
                        mess.addClass("mess-green");
                        feedBack.hide();
                        $('html, body').animate({scrollTop: 0},500);
					} else {
						console.log('send FAIL');
						mess.addClass("mess-red");
					}

					$('#mess').text(req.message);					
				},
				"JSON"
			);
		} else {
			mess.text("Одно из полей не заполнено или введено некорректное значение!");
			mess.addClass("mess-red");
		}
		
		return false;
	});
});
</script>