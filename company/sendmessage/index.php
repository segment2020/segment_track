<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

if (isset($_POST['companyId']) && !empty($_POST['companyId']))
	$companyId = $_POST['companyId'];

if (isset($_POST['email']) && !empty($_POST['email']))
	$email = $_POST['email'];

if (isset($_POST['name']) && !empty($_POST['name']))
	$name = $_POST['name'];

if (isset($_POST['title']) && !empty($_POST['title']))
	$title = $_POST['title'];

if (isset($_POST['message']) && !empty($_POST['message']))
	$message = $_POST['message'];

if (isset($_POST['detailPage']) && !empty($_POST['detailPage']))
	$detailPage = $_POST['detailPage'];

$message = $message .
			"\r\nИмя: " . $name .
			"\r\nEmail: " . $email .
			"\r\nPhone: " . $phone;

sendMessageForAdmin($USER->GetID(), $title, $message, $companyId);

$detailPage = isset($detailPage)? $detailPage . '?message=true': '/company/?message=true';
header('Location: ' . $detailPage);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");