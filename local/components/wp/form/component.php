<?

	if (isset($_POST['name']) && (!empty($_POST['name']))
		&& isset($_POST['email']) && (!empty($_POST['email']))
		&& isset($_POST['title']) && (!empty($_POST['title']))
		&& isset($_POST['comment']) && (!empty($_POST['comment']))
		)
    {
        
        
        
		$email = $_POST['email'];
		$reg = "/[0-9a-z_\.\-]+@[0-9a-z_\.\-]+\.[a-z]{2,5}/i";
		if (!preg_match($reg, $email)) // Нет совпадения.
			exit('Bad email');

		$APPLICATION->RestartBuffer();
		$arEventFields = array(
				"NAME" => $_POST["name"],
				"EMAIL" => $_POST["email"],
                "TITLE" => $_POST["title"],
				"COMMENTS" => $_POST["comment"]
		);
		
		$recaptcha = new \ReCaptcha\ReCaptcha(RE_SEC_KEY);
    		 $resp = $recaptcha->verify($_REQUEST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    		 if (!$resp->isSuccess()){
    		 foreach ($resp->getErrorCodes() as $code) {
    		     echo json_encode(array("success" => false, "message" => "Вы не прошли проверку подтверждения личности!"));
    		     //exit("Ошибка! Проверка не пройдена.");
    		     die();
    		 }
		}

		$eventId = CEvent::Send("feedBack", SITE_ID, $arEventFields);
		// pre($eventId);
		if ($eventId) {
			echo json_encode(array("success" => true, "message" => "Спасибо за обращение, мы свяжемся с Вами в самое ближайшее время!"));
		}else{
			echo json_encode(array("success" => false, "message" => "Не удалось отправить сообщение, свяжитесь с администратором сайта!"));
		}
		die();
	}else{
		$this->IncludeComponentTemplate();
	}
?>