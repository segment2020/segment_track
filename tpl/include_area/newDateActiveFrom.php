<?
function createSelectTime($end, $time)
{
	echo '<option value=""></option>';
	for ($i = 0; $i < $end; ++$i)
	{
		$selected = '';

		if ($i < 10)
			$val = '0' . $i;
		else
			$val = $i;

		if ($val == $time)
				$selected = 'selected';

		echo '<option value="' . $val . '"' . $selected . '>' . $val . '</option>';
	}
}

$date = '';
if (!empty($dateActiveFrom))
{
	$date = explode(' ', $dateActiveFrom);
	if (!empty($date[1]))
	{
		$hours = explode(':', $date[1]);
		$minutes = $hours[1];
		$hours = $hours[0];
	}
}
?>  
		<div class="col-xs-8">
			<div class="form-group" id="lk_BD">
				<label class="control-label mainlabel" for="PROPERTY[DATE_ACTIVE_FROM][0]">Начало активности(если пусто, то с текущего момента)</label>
		<?
								$APPLICATION->IncludeComponent(
									'bitrix:main.calendar',
									'calendarDateActiveFrom',
									array(
										'SHOW_INPUT' => 'Y',
										'FORM_NAME' => 'iblock_add',
										'INPUT_NAME' => 'PROPERTY[DATE_ACTIVE_FROM][0]',
										'INPUT_VALUE' => $date[0],
										'SHOW_TIME' => 'N'
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);

								//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
		?>
			</div>
		</div>
		<div class="col-xs-2">
			<label class="control-label mainlabel" for="hours">Часы</label>
			<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="hours" name="hours" tabindex="-98">
			<?
				createSelectTime(24, $hours);
			?>
			</select>
		</div>
		<div class="col-xs-2">
			<label class="control-label mainlabel" for="minutes">Минуты</label>
			<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="minutes" name="minutes" tabindex="-98">
			<?
				createSelectTime(60, $minutes);
			?>
			</select>
		</div> 

<script>
$('input.dateActiveFrom').on('keyup keypress', function(e) {
	$(this).val('');
});
</script>