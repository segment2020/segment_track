<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/*
if($_FILES['catalog'])
{
	$result = 'false';
	if (($_FILES['catalog'] == "none") OR (empty($_FILES['catalog']['name'])) )
		$message = "Вы не выбрали файл";
	else if ($_FILES['catalog']["size"] == 0 OR $_FILES['catalog']["size"] > 31457280) // 30Mb
		$message = "Размер файла не соответствует нормам";
	else if (!is_uploaded_file($_FILES['catalog']["tmp_name"]))
		$message = "Что-то пошло не так. Попытайтесь загрузить файл ещё раз.";
	else
	{
		$fId = CFile::SaveFile($_FILES['catalog'], "usersImg");
		//$path = CFile::GetPath($fId);
		$message = "Файл " . $_FILES['catalog']['name'] . " загружен";


		// $name = rand(1, 1000).'-'.md5($_FILES['upload']['name']).'.'.getex($_FILES['upload']['name']);
		// move_uploaded_file($_FILES['upload']['tmp_name'], "images/".$name);
		// $full_path = 'http://youon.ru/images/'.$name;
		// $message = "Файл ".$_FILES['upload']['name']." загружен";
		// $size=@getimagesize('images/'.$name);
		// if($size[0]<50 OR $size[1]<50) {
			// unlink('images/'.$name);
			// $message = "Файл не является допустимым изображением";
			// $full_path="";
		// }

		$result = 'true';
	}

	echo '{"result" : "' . $result . '", "message" : "' . $message . '"}';
}
*/

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");