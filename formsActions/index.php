<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
define('NEW_STAFF_THEME', 'Заявка от нового сотрудника');
define('NEW_STAFF_MESSAGE', 'В компанию подана заявка от нового сотрудника USER_NAME. <a href="/personal/company/staff/?">Список сотрудников</a>');
define('FIRE_STAFF_THEME', 'Уведомление об увольнении');
define('FIRE_STAFF_MESSAGE', 'Вас уволили из компании');

use \Bitrix\Main\Application;
use \Bitrix\Main\UserTable;
use \Bitrix\Main\UserGroupTable;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Type\DateTime;
use \Bitrix\Main\Context;
use \Bitrix\Currency\CurrencyManager;
use \Bitrix\Sale;

global $USER;

function createMessage($template, $include)
{
	$message = $template;

	foreach ($include as $pattern => $replacement)
		$message = str_replace($pattern, $replacement, $message);

	return $message;
}

function sendMessage($authorId, $theme, $message, $recipientId)
{
	$result = false;

	if (Loader::includeModule('forum'))
	{
		$arFields = Array(
			"AUTHOR_ID"    => $authorId,
			"POST_SUBJ"    => $theme,
			"POST_MESSAGE" => $message,
			"USER_ID"      => $recipientId,
			"FOLDER_ID"    => 1,
			"IS_READ"      => "N",
			"USE_SMILES"   => "Y"
			);

		$ID = CForumPrivateMessage::Send($arFields);

		if ((int)($ID) > 0)
			$result = true;
	}

	return $result;
}

function deletePriceList($id, $sesId)
{
	$result = false;
	if (bitrix_sessid() == $sesId)
	{
		global $USER;
		// Проверим принадлежность елемента пользователю.
		$userId = $USER->GetID();
		$rsUser = CUser::GetByID($userId); // получаем поля авторизованного пользователя
		$arUser = $rsUser->Fetch();
		if (!empty($arUser['UF_ID_COMPANY']))
		{
			if (Loader::includeModule('iblock'))
			{
				$res = CIBlockElement::GetByID($id);
				if ($elArray = $res->GetNextElement())
				{
					if ($prop = $elArray->GetProperties())
					{
						if (!empty($prop['companyID']['VALUE']) && ($prop['companyID']['VALUE'] == $arUser['UF_ID_COMPANY']))
							$result = CIBlockElement::Delete($id);
					}
				}
			}
		}
	}

	return $result;
}

// Функция обработки добавления сотрудника в компанию.
function companyStaff($action, $fireUserId)
{
	global $USER;
	$companyId = null;

	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	$companyId = $arUser['UF_ID_COMPANY'];

	if (null !== $companyId)
	{
		if (Loader::includeModule('iblock'))
		{
			// Выберем всех сотрудников.
			$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_COMPANY, "ID" => $companyId);
			$res = CIBlockElement::GetList(Array(), $arFilter);
			if ($ob = $res->GetNextElement())
				$arProps = $ob->GetProperties(false, array('ID' => PROPERTY_ID_STAFF)); // свойства элемента

			if (isset($arProps))
			{
				$propertyValue = array();
				$propertyId = PROPERTY_ID_STAFF;

				// Переберём список и удалим уволенного или добавим нового.
				$execute = true;
// pre($arProps['staff']['VALUE']);
				foreach ($arProps['staff']['VALUE'] as $key => $value)
				{
					if ($value == $fireUserId)
					{
						// Если просто меняется статус(группа) пользователя, то оставляем текущий массив как есть.
						// Если статус меняется первый раз, то надо ещё и добавить сотрудника в список.
						// Если увольнение - то пропускаем(удаляем) пользователя из массива.
						if ('delete' == $action)
							continue;
						elseif ('add' == $action)
						{
							$execute = false;
							break;
						}
					}

					array_push($propertyValue, array("VALUE" => $value));
				}

				if ('add' == $action)
					array_push($propertyValue, array("VALUE" => $fireUserId));
			}
		}
	}

// pre($propertyValue, EXIT_PRE);
	// Установим новое значение для данного свойства данного элемента
	if ($execute)
		CIBlockElement::SetPropertyValuesEx($companyId, IBLOCK_ID_COMPANY, array($propertyId => $propertyValue));
}



function changeGroup($userId, $groupId)
{
	// Проверим, состоит ли пользователь в группе, в которую его пытаются добавить.
	$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $userId, 'GROUP_ID' => $groupId)));
	if (!$row = $res->fetch())
	{
		// Тут изменяем группу пользователя.
		if (ID_GROUP_COMPANY_STAFF === (int)$groupId)
		{
			UserGroupTable::add(array('GROUP_ID' => ID_GROUP_COMPANY_STAFF, 'USER_ID' => $userId)); // Добавить группу.
			UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_ADMIN, 'USER_ID' => $userId)); // Удалить группу.
		}
		elseif (ID_GROUP_COMPANY_ADMIN === (int)$groupId)
		{
			UserGroupTable::add(array('GROUP_ID' => ID_GROUP_COMPANY_ADMIN, 'USER_ID' => $userId)); // Добавить группу.
			UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_STAFF, 'USER_ID' => $userId)); // Удалить группу.
		}
		elseif (ID_GROUP_USER === (int)$groupId)
		{
			UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_STAFF, 'USER_ID' => $userId)); // выход
			UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_ADMIN, 'USER_ID' => $userId)); // выход
		}

		companyStaff('add', $userId);
	}
}

$request = Application::getInstance()->getContext()->getRequest(); 

$userId = $request->getPost('userId');
$status = 'FAIL';

if (!empty($request->get('actionNum')))
{
	$actionNum = $request->get('actionNum');

	if (FIRE_STAFF == $actionNum)
	{
		companyStaff('delete', $userId);

		$res = UserGroupTable::getList(array('filter' => array('USER_ID' => $userId, 'GROUP_ID' => array(ID_GROUP_COMPANY_STAFF, ID_GROUP_COMPANY_ADMIN))));
		if ($row = $res->fetch())
		{
			if (ID_GROUP_COMPANY_STAFF == $row['GROUP_ID'])
				UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_STAFF, 'USER_ID' => $userId)); // Удалить группу.
			elseif (ID_GROUP_COMPANY_ADMIN == $row['GROUP_ID'])
				UserGroupTable::delete(array('GROUP_ID' => ID_GROUP_COMPANY_ADMIN, 'USER_ID' => $userId)); // Удалить группу.
		}

		$user = new CUser;
		$fields = array("UF_ID_COMPANY" => '');
		$user->Update($userId, $fields);
		$message = $user->LAST_ERROR;
		if (!empty($message))
			$status = 'FAIL';
		else
			$status = 'OK';

		$self = $request->getPost('self');
		if (isset($self) && 'true' == $self)
		{
			if (empty($message))
				$message = 'OK';
		}
		else
		{
			$senderId = $USER->GetID();
			$res = sendMessage($senderId, FIRE_STAFF_THEME, FIRE_STAFF_MESSAGE, $userId);
		}
	}
	elseif (NEW_STAFF == $actionNum)
	{
		if (!empty($request->getPost('companyId')))
			$companyId = $request->getPost('companyId');

		$userId = $USER->GetID();

		$rsUser = CUser::GetByID($userId); // получаем поля авторизованного пользователя
		$arUser = $rsUser->Fetch();
		if (empty($arUser['UF_ID_COMPANY']) && isset($companyId))
		{
			// Если у пользователь не состоит в компании то добавим его в компанию в которую он "просится" и оповестим от этом админа.
			$user = new CUser;
			$fields = array("UF_ID_COMPANY" => $companyId);
			$user->Update($userId, $fields);
			$message = $user->LAST_ERROR;
			if (!empty($message))
				$status = 'FAIL';
			else
				$status = 'OK';

			$notice = createMessage(NEW_STAFF_MESSAGE, array('USER_NAME' => $arUser['LOGIN']));

			$result = sendMessageForAdmin($userId, NEW_STAFF_THEME, $notice, $companyId);

			// Выберем админов компании.
			// $arFilter = Array(
			    // Array(
					// "LOGIC"=>"OR",
					// Array(),
					// Array(
						// "UF_ID_COMPANY" => $companyId,
						// "Bitrix\Main\UserGroupTable:USER.GROUP_ID" => ID_GROUP_COMPANY_ADMIN
					// )
			    // )
			// );

			// $res = UserTable::getList(Array(
			   // "select"=>Array("ID","NAME"),
			   // "filter"=>$arFilter,
			// ));

			// while ($arRes = $res->fetch()) {
				// $result = sendMessage($userId, NEW_STAFF_THEME, $notice, $arRes['ID']);
			// }
		}
	}
	elseif (CHANGE_STATUS == $actionNum)
	{
		if (!empty($request->getPost("groupId")))
			$groupId = $request->getPost("groupId");

		// Проверим, состоит ли пользователь в группе, в которую его пытаются добавить.
		changeGroup($userId, $groupId);

		$status = 'OK';
	}
	elseif (REVOKE == $actionNum)
	{
		$user = new CUser;
		$fields = array("UF_ID_COMPANY" => '');
		$user->Update($USER->GetID(), $fields);
		$message = $user->LAST_ERROR;
		if (!empty($message))
			$status = 'FAIL';
		else
			$status = $message = 'OK';
	}
	elseif ('delete' == $actionNum)
	{
		$sesId = $request->getQuery('sesId');
		$id = $request->getQuery('id');

		$result = deletePriceList($id, $sesId);
		if ($result)
			header('location: /personal/company/?edit=Y&CODE=' . $arUser['UF_ID_COMPANY'] . '&strIMessage=Файл удалён');
		else
			header('location: /personal/company/?edit=Y&CODE=' . $arUser['UF_ID_COMPANY'] . '&strIMessage=При удалении возникла ошибка');
	}
	elseif ('addStaffFromCompany' == $actionNum)
	{
		$usersId = $request->getPost('userId');

		$adminId = $USER->GetID();
		$admin = CUser::GetByID($adminId); // получаем поля авторизованного пользователя
		$adminArr = $admin->Fetch();
		if (!empty($adminArr['UF_ID_COMPANY'])) {
			foreach ($usersId as $key => $newStaffId) {
				// Проверим, вдруг пользователя уже добавили в компанию...
				$userInfo = CUser::GetByID($newStaffId);
				$arUser = $userInfo->Fetch();
				if (empty($arUser['UF_ID_COMPANY'])) {
					$user = new CUser;
					$fields = array("UF_ID_COMPANY" => $adminArr['UF_ID_COMPANY']);
					$user->Update($newStaffId, $fields);
					$message = $user->LAST_ERROR;
					if (empty($message))
					{
						companyStaff('add', $newStaffId);
						changeGroup($newStaffId, ID_GROUP_COMPANY_STAFF);
						$message = 'Сотрудники успешно добавлены';
					}
				}
			}
		}

		header('location: /personal/company/staff/?message=' . $message);
	}
	elseif ('createOrder' == $actionNum)
	{
		$message = 'Возникли проблемы с оформлением заказа';
		$companyId = $request->getPost('companyId');
		if (!empty($companyId) && Loader::includeModule('iblock'))
		{
			$arSelect = Array("NAME");
			$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_COMPANY, "ID" => $companyId);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			if ($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$companyName = $arFields['~NAME'];
			}

			if (!empty($companyName))
			{
				if (Loader::includeModule('sale'))
				{
					$productsId = array();
					$siteId = Context::getCurrent()->getSite();
					$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $siteId);

					$basketItems = $basket->getBasketItems();
					foreach ($basketItems as $item)
					{
						$basketPropertyCollection = $item->getPropertyCollection(); 
						$property = $basketPropertyCollection->getPropertyValues();
						if ($companyName == $property['companyId']['VALUE'])
						{
							$productsId[] = $item->getId();
						}
					}
				}
			}

			if (!empty($productsId))
			{
				$tmpBasket = Sale\Basket::create($siteId);
				$product = array();
				foreach ($productsId as $prodId)
				{
					$item = $basket->getItemById($prodId);

					// Создаём новый товар во временной корзине.
					$tmpItem = $tmpBasket->createItem($item->getField("MODULE"), $item->getProductId());
					$tmpItem->initFields($item->getFields()->getValues());

					// Удаляем товар из текущей корзины.
					$basket->getItemById($prodId)->delete();
				}
				// $basket->save();
				$tmpBasket->save();

				// Создаём новый заказ.
				$currencyCode = CurrencyManager::getBaseCurrency();
				$order = Sale\Order::create($siteId, $USER->GetID(), $currencyCode);
				$order->setPersonTypeId(1);

				// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
				$shipmentCollection = $order->getShipmentCollection();
				$shipment = $shipmentCollection->createItem(Sale\Delivery\Services\Manager::getObjectById(1));
				$shipmentItemCollection = $shipment->getShipmentItemCollection();
				$shipment->setField('CURRENCY', $order->getCurrency());

				$order->setBasket($tmpBasket);
				// $order->setBasket($basket);

				foreach ($order->getBasket() as $item)
				{
					// @var Sale\ShipmentItem $shipmentItem
					$shipmentItem = $shipmentItemCollection->createItem($item);
					$shipmentItem->setQuantity($item->getQuantity());
				}

				// Устанавливаем свойства
				$phone = $request->getPost('phone');
				$name = $request->getPost('name');
				$email = $request->getPost('email');
				$comments = $request->getPost('comments');
				$propertyCollection = $order->getPropertyCollection();

				if ($phone)
				{
					$phoneProp = $propertyCollection->getPhone();
					$phoneProp->setValue($phone);
				}

				if ($name)
				{
					$nameProp = $propertyCollection->getPayerName();
					$nameProp->setValue($name);
				}

				if ($email)
				{
					$emailProp = $propertyCollection->getUserEmail();
					$emailProp->setValue($email);
				}

				if ($comments)
					$order->setField('USER_DESCRIPTION', $comments); // Устанавливаем поля комментария покупателя


				// Payment.
				$arPaySystemServiceAll = [];
				$paySystemId = 1;
				$paymentCollection = $order->getPaymentCollection();

				$remainingSum = $order->getPrice() - $paymentCollection->getSum();
				if ($remainingSum > 0 || $order->getPrice() == 0)
				{
					$extPayment = $paymentCollection->createItem();
					$extPayment->setField('SUM', $remainingSum);
					$arPaySystemServices = Sale\PaySystem\Manager::getListWithRestrictions($extPayment);

					$arPaySystemServiceAll += $arPaySystemServices;

					if (array_key_exists($paySystemId, $arPaySystemServiceAll))
					{
						$arPaySystem = $arPaySystemServiceAll[$paySystemId];
					}
					else
					{
						reset($arPaySystemServiceAll);

						$arPaySystem = current($arPaySystemServiceAll);
					}

					if (!empty($arPaySystem))
					{
						$extPayment->setFields(array(
							'PAY_SYSTEM_ID' => $arPaySystem["ID"],
							'PAY_SYSTEM_NAME' => $arPaySystem["NAME"]
						));
					}
					else
						$extPayment->delete();
				}

				// Сохраняем.
				$order->doFinalAction(true);
// pre($order, EXIT_PRE);

				$result = $order->save();

				$orderId = $order->getId();

				if ($orderId)
					$message = 'Ваш заказ успешно оформлен!';
				else
					$message = 'Возникли проблемы с оформлением заказа!';
			}
			else
			{
				$message = 'Возникли проблемы с оформлением заказа!';
			}
		}

		header('location: /personal/basket/?message=' . $message);
	}
}

echo json_encode(array('status' => $status, 'message' => $message));

?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>