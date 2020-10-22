<?
function createSelectTimeEvent($end, $time)
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

if (!empty($time))
{
	$beginTime = explode(' ', $time);
	if (!empty($beginTime[1]))
	{
		$hours = explode(':', $beginTime[1]);
		$minutes = $hours[1];
		$hours = $hours[0];
	}
}

if (!empty($timeEnd))
{
	$endTime = explode(' ', $timeEnd);
	if (!empty($endTime[1]))
	{
		$hoursEnd = explode(':', $endTime[1]);
		$minutesEnd = $hoursEnd[1];
		$hoursEnd = $hoursEnd[0];
	}
}
?>

<div class='row'>
	<div class="col-xs-6">
		<div class="form-group dateBegin calendar-block" id="lk_evBD">
			<label class="control-label mainlabel" for="PROPERTY['<? echo $dateBeginPropId; ?>'][0]">Дата начала события*</label>
<?
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            'calendarEventStartDate',
                            array(
                                'SHOW_INPUT' => 'Y',
                                'FORM_NAME' => 'iblock_add',
                                'INPUT_NAME' => 'PROPERTY[' . $dateBeginPropId . '][0]',
                                'INPUT_VALUE' => $dateBegin,
                                'SHOW_TIME' => 'N'
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );
?>
		</div>
	</div>

	<div class="col-xs-3">
		<label class="control-label mainlabel" for="hoursEvent">Часы (начало)</label>
		<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="hoursEvent" name="hoursEvent" tabindex="-98">
		<?
			createSelectTimeEvent(24, $hours);
		?>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label mainlabel" for="minutesEvent">Минуты (начало)</label>
		<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="minutesEvent" name="minutesEvent" tabindex="-98">
		<?
			createSelectTimeEvent(60, $minutes);
		?>
		</select>
	</div>
	</div>


	<div class='row'>
	<div class="col-xs-6">
		<div class="form-group calendar-block" id="lk_evED">
			<label class="control-label mainlabel" for="PROPERTY['<? echo $dateEndPropId; ?>'][0]">Дата окончания события*</label>
<?
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            'calendarEventStartDate',
                            array(
                                'SHOW_INPUT' => 'Y',
                                'FORM_NAME' => 'iblock_add',
                                'INPUT_NAME' => 'PROPERTY[' . $dateEndPropId . '][0]',
                                'INPUT_VALUE' => $dateEnd,
                                'SHOW_TIME' => 'N'
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );
?>
		</div>
	</div>
	<div class="col-xs-3">
		<label class="control-label mainlabel" for="hoursEventEnd">Часы (окончание)</label>
		<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="hoursEventEnd" name="hoursEventEnd" tabindex="-98">
			<? createSelectTimeEvent(24, $hoursEnd); ?>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label mainlabel" for="minutesEventEnd">Минуты (окончание)</label>
		<select class="selectpicker selectboxbtn form-control minbr" data-live-search="true" id="minutesEventEnd" name="minutesEventEnd" tabindex="-98">
			<? createSelectTimeEvent(60, $minutesEnd); ?>
		</select>
	</div>

	<div class="col-xs-12 hide">
		<div class="form-group">
			<label class="control-label mainlabel" for="lk_beginEventTime">Время начала</label>
			<input type="text" class="form-control" id="lk_beginEventTime" name='PROPERTY[<? echo $timePropId; ?>][0]' value="">
		</div>
	</div>
	<div class="col-xs-12 hide">
		<div class="form-group">
			<label class="control-label mainlabel" for="lk_beginEventTimeEnd">Время окончания</label>
			<input type="text" class="form-control" id="lk_beginEventTimeEnd" name='PROPERTY[<? echo $timeEndPropId; ?>][0]' value="">
		</div>
	</div>
</div>