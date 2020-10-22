<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

function getex($filename) {
	return end(explode(".", $filename));
}
// pre($_FILES, true);

if($_FILES['upload'])
{
	if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
		$message = "Вы не выбрали файл";
	else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 6050000)
		$message = "Размер файла не соответствует нормам";
	else if (($_FILES['upload']["type"] != "image/jpg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
		$message = "Допускается загрузка только картинок JPG и PNG.";
	else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
		$message = "Что-то пошло не так. Попытайтесь загрузить файл ещё раз.";
	else
	{
		// pre($_FILES, true);
		$fid = CFile::SaveFile($_FILES['upload'], "usersImg");
		// pre($fid);
		$path = CFile::GetPath($fid);
		// pre($path);
		$message = "Файл " . $_FILES['upload']['name'] . " загружен";

		/*
		$name = rand(1, 1000).'-'.md5($_FILES['upload']['name']).'.'.getex($_FILES['upload']['name']);
		move_uploaded_file($_FILES['upload']['tmp_name'], "images/".$name);
		$full_path = 'http://youon.ru/images/'.$name;
		$message = "Файл ".$_FILES['upload']['name']." загружен";
		$size=@getimagesize('images/'.$name);
		if($size[0]<50 OR $size[1]<50) {
			unlink('images/'.$name);
			$message = "Файл не является допустимым изображением";
			$full_path="";
		}
		*/
	}
	$callback = $_REQUEST['CKEditorFuncNum'];
	echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$path.'", "'.$message.'" );</script>';
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");