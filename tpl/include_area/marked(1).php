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