<div class="showbyblock floatright">
    <form action='<? echo $action; ?>' method='POST'>
		<span class="showbytitle">Показывать по</span>
        <select class="selectpicker selectboxbtn elemNumChange" name='elemNum'>
		<?
$selected12 = '';
$selected24 = '';
$selected36 = '';
$selected48 = '';

switch ($elemNum)
{
    case '12':
    {
        $selected10 = 'selected';
        break;
    }

    case '24':
    {
        $selected20 = 'selected';
        break;
    }

    case '36':
    {
        $selected30 = 'selected';
        break;
    }

    case '48':
    {
        $selected40 = 'selected';
        break;
    }

    default:
        $selected10 = 'selected';
}
?>
            <option value='12' id='12' <? echo $selected10; ?>>12</option>
            <option value='24' id='24' <? echo $selected20; ?>>24</option>
            <option value='36' id='36' <? echo $selected30; ?>>36</option>
            <option value='48' id='48' <? echo $selected40; ?>>48</option>
        </select>
    </form>
</div>