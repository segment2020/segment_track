<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//pre($arResult);

define('SEC_IN_DAY', 86400);

$beginDate = strtotime($arResult['PROPERTIES']['dateBeginDef']['VALUE']);

if (!empty($arResult['PROPERTIES']['maturityDate']['VALUE']))
	$endDate = strtotime($arResult['PROPERTIES']['maturityDate']['VALUE']);
else
	$endDate = strtotime('now');

$daysDef = ceil(($endDate - $beginDate) / SEC_IN_DAY);

$arSelect0 = array('NAME');
$arFilter0 = array("IBLOCK_ID" => IBLOCK_ID_CITY, "ID" => IntVal($arResult['PROPERTIES']['city']['VALUE']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res0 = CIBlockElement::GetList(Array(), $arFilter0, false, array(), $arSelect0);
if ($ob0 = $res0->GetNextElement())
	$cityArFieldsDef = $ob0->GetFields();
?>


<h1>Страница неплательщика</h1>
<div class="block-default in block-shadow content-margin detailblock">
	<h3>Неплательщик</h3>
	<div class="panel panel-default">
		<table class="table table-striped table-hover table-bordered block-default tableblock">
			<tbody>
				<tr>
					<td class="table256">Неплательщик:</td>
					<td><? echo $arResult['~NAME']; ?></td>
				</tr>
				<tr>
					<td class="table256">Город:</td>
					<td><? echo $cityArFieldsDef['NAME']; ?></td>
				</tr>
				<tr>
					<td class="table256">Адрес:</td>
					<td><? echo $arResult['PROPERTIES']['addressDefaulter']["VALUE"]; ?></td>
				</tr>
				<tr>
					<td class="table256">ФИО руководителя/ учредителя:</td>
					<td><? echo $arResult['PROPERTIES']['nameFounder']["VALUE"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<h3>Заявитель</h3>
	<div class="panel panel-default">
		<table class="table table-striped table-hover table-bordered block-default tableblock">
			<tbody>
				<tr>
					<td class="table256">Заявитель:</td>
					<td><? echo $arResult['PROPERTIES']['applicant']['VALUE']; ?></td>
				</tr>
				<tr>
					<td class="table256">Контактное лицо заявителя:</td>
					<td><? echo $arResult['PROPERTIES']['applicantContact']["VALUE"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<h3>Список задолженностей</h3>
	<div class="panel panel-default redborder">
		<table class="table table-bordered block-default tableblock">
			<tbody>
				<tr>
					<td><b>Дата размещения:</b><br /><? echo $arResult['DATE_CREATE']; ?></td>
					<td><b>Юр. название неплательщика:</b><br /><? echo $arResult['PROPERTIES']['defaulter']['~VALUE']; ?></td>
					<td><b>Документ по которому образовалась задолженность:</b><br /><? echo $arResult['PROPERTIES']['document']['VALUE']; ?></td>
					<td>
						<b>Дата возникновения просроченной задолжности:</b><br />
						<? echo $arResult['PROPERTIES']['dateBeginDef']['VALUE']; ?><br />
						<b>Дней просрочки:</b><br />
						<? echo $daysDef; ?><br />
					</td>
					<td><b>Сумма по документу:</b><br /><? echo $arResult['PROPERTIES']['amountOfDebtDoc']['VALUE']; ?></td>
					<td><b>Просроченная сумма:</b><br /><? echo $arResult['PROPERTIES']['amountOfDebt']['VALUE']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>









<?
/*


<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>