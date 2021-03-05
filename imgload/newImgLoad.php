<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if ($_FILES["image"]["size"] > 1024 * 3 * 1024) {
	echo ("Размер файла превышает три мегабайта");
	exit;
}
$response = $_FILES["image"]["error"];
$responseJson = [];
if ($response == 0) {

	if (isset($_FILES["image"]["name"])) {

		move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/upload/tmp/" . $_FILES["image"]["name"]);
		$arFile = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/tmp/" . $_FILES["image"]["name"]);
		$arFile["MODULE_ID"] = "iblock";
		$fid = CFile::SaveFile($arFile, "usersImg");

		if (intval($fid) > 0) {
			$imgPath = CFile::GetPath($fid);
			unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/tmp/" . $_FILES["image"]["name"]);

			$responseJson = ['success' => '1', 'file' => ['url' => $imgPath]];
			header('Content-Type: application/json');
			echo json_encode($responseJson);
			exit;
		} else {
			echo ("Ошибка сохранения файла. Попробуйте ещё");
		}
	}
} else {
	echo ("Ошибка загрузки файла. Код: " . $response);
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
