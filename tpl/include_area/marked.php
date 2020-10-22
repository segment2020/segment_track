<div class="col-xs-12">
Редакция портала «Сегмент.ру» оставляет за собой право изменять текст публикации под установленный формат новостей, принятый на сайте.
	<div class="lk_inTop" style="margin-top: 0;margin-bottom: 0;">
		<div class="mycheckbox"> 
			<label>
				<a href="/news/companynews/pravila_razmescheniya_nekommercheskoy_informatsii_v_rubrike_novosti_kompaniy/" target="_blank" style=" text-decoration: underline; position: relative; left: -20px;">Правила размещения некоммерческой информации в рубрике «Новости компаний»</a> 
			</label>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<div class="lk_inTop">
		<div class="mycheckbox">
		<?
		$propertyEnums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), array("IBLOCK_ID" => $iBlockId, 'CODE' => $code));
		if ($enumFields = $propertyEnums->GetNext())
			$propId = $enumFields['ID'];
		?>
			<label for='inTheTop'>
				<input type="checkbox" id='inTheTop' class="" name='PROPERTY[<? echo $propInTopId; ?>]' value="<? echo $propId; ?>">
				Выделить
			</label>
		</div>
	</div>
</div>
<div class="col-xs-12 hide" id='markedTo'>
	<div class="form-group" id="lk_BD">
		<label class="control-label mainlabel" id='inTopDate' for="PROPERTY[<? echo $propMarkedToId; ?>][0]">Выделено до</label>
<?
			$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'calendarDateMarkedTo',
				array(
					'SHOW_INPUT' => 'Y',
					'FORM_NAME' => 'iblock_add',
					'INPUT_NAME' => 'PROPERTY['. $propMarkedToId . '][0]',
					'INPUT_VALUE' => '',
					'SHOW_TIME' => 'N'
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);

			//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
?>
	</div>
</div>