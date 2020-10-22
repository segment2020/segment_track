<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Написать в компанию");
?>

<div class="container-fluid">
	<div class="row row-flex">
		<div class="col-sm-3 col-xs-12 order-xs-1">
			<div class="row">
				<? $APPLICATION->IncludeFile('/tpl/widgets/left/new-members.php', array(), array()); ?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>		
				<? $APPLICATION->IncludeFile('/tpl/widgets/left/top100.php', array(), array()); ?>
				<div class="col-xs-12 content-margin">
					<div class="infoblock"></div>
				</div>
				<? $APPLICATION->IncludeFile('/tpl/widgets/left/viewpoint.php', array(), array()); ?>
			</div>					
		</div>
		<div class="col-sm-9 col-xs-12 content-margin">
			<h1>Написать в компанию</h1>
			<div class="block-default in block-shadow content-margin">
				<div class="row">
					<form action='/company/sendmessage/' method='POST' id='messageForm'>
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label mainlabel" for="email">Email</label>
								<input type="text" class="form-control mess" id="email" name='email' value="">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label mainlabel" for="phone">Телефон</label>
								<input type="text" class="form-control mess" id="phone" name='phone' value="">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label mainlabel" for="name">Имя</label>
								<input type="text" class="form-control mess" id="name" name='name' value="">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label mainlabel" for="title">Заголовок</label>
								<input type="text" class="form-control mess" id="title" name='title' value="">
							</div>
						</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label mainlabel" for="message">Сообщение</label>
								<textarea class='form-control maintextarea' id="message" name="message"></textarea>
							</div>
						</div>

						<div class="col-xs-12">
							Все поля обязательны к заполнению
						</div>

						<div class="col-xs-12">
							<input type="submit" name="iblock_submit" value="Отправить" id='send' class="btn btn-blue-full minbr">
							<input type="hidden" name="companyId" value="<? echo $_GET['companyId']; ?>" id='companyId'>
							<input type="hidden" name="detailPage" value="<? echo $_GET['detailPage']; ?>" id='detailPage'>
						</div>
					</form>
				</div> <!-- end div class="row"> -->
			</div>
		</div> <!-- end div class="col-xs-9 content-margin"> -->
	</div>
</div>

<script type='text/javascript'>
$('form').on('submit', function(event) {
	var error = false;
	$('input.mess').each(function() {
		var val = $(this).val();
		if ('' == val)
		{
			$(this).addClass('errorField');
			error = true;
		}
		else
		{
			$(this).removeClass('errorField');
		}
	});

	if ('' == $('#message').val())
	{
		$('#message').addClass('errorField');
		error = true;
	}
	else
	{
		$('#message').removeClass('errorField');
	}

	if (error)
		return false;
})
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>