<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


$request = Application::getInstance()->getContext()->getRequest();

$bannerId = $request->getQuery('id');

if (!empty($bannerId))
// if (false)
{
	if (Loader::includeModule('iblock'))
	{
		$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, "ID" => $bannerId);
		$res = CIBlockElement::GetList(Array(), $arFilter);
		if ($ob = $res->GetNextElement())
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties(false, array('CODE' => 'companyId')); // свойства элемента
	}
// pre($arFields['ACTIVE']);
// pre($bannerId, EXIT_PRE);
	if ('Y' == $arFields['ACTIVE'])
	{
		$companyId = (!empty($arProps['companyId']['VALUE']))? $arProps['companyId']['VALUE']: 0;

		$connection = Application::getConnection();
		$sqlHelper = $connection->getSqlHelper();

		// Проверим, есть ли запись текущего дня по требуемому баннеру.
		$query = "SELECT id FROM `segment_banners` WHERE `bannerid` = '" . $sqlHelper->forSql($bannerId) . "' AND `datecreate` = '" . date('Y-m-d') . "'";
		$row = $connection->query($query)->fetch();
		if ($row['id'])
		{
			// Обновим счётчик на +1.
			$query = "UPDATE `segment_banners` SET `clicksnumber` = `clicksnumber` + 1 WHERE `id` = '" . $row['id'] . "'";
			$res = $connection->query($query);
		}
		else
		{
			$query = "INSERT INTO `segment_banners` (bannerid, companyid, datecreate) VALUES ('" . $sqlHelper->forSql($bannerId) . "', '" . $companyId . "', '" . date('Y-m-d') . "')";
			$res = $connection->query($query);
		}

		if (Loader::includeModule('iblock'))
		{
			$arFilter = Array("IBLOCK_ID" => IBLOCK_ID_BANNERS, "ID" => $bannerId);
			$res = CIBlockElement::GetList(Array(), $arFilter);
			if ($ob = $res->GetNextElement()) {
				$arProps = $ob->GetProperties(false, array('ID' => PROPERTY_ID_LINK_IN_BANNERS)); // свойства элемента
				$link = $arProps['link']['VALUE'];
			}

			header('location: ' . $link);
		}
	}
}
else
{
	header('location: /marketing/');
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>