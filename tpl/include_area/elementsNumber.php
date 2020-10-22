<div class="showbyblock floatright">
    <form action='<? echo $action; ?>' method='POST'>
		<span class="showbytitle">Показывать по</span>
        <select class="selectpicker selectboxbtn elemNumChange" name='elemNum'>
		<?
$selected10 = '';
$selected20 = '';
$selected30 = ''; 
$selected40 = '';

switch ($elemNum)
{
    case '10':
    {
        $selected10 = 'selected';
        break;
    }

    case '20':
    {
        $selected20 = 'selected';
        break;
    }

    case '30':
    {
        $selected30 = 'selected';
        break;
    }

    case '40':
    {
        $selected40 = 'selected';
        break;
    }

    default:
        $selected10 = 'selected';
}
?>
            <option value='10' id='10' <? echo $selected10; ?>>10</option>
            <option value='20' id='20' <? echo $selected20; ?>>20</option>
            <option value='30' id='30' <? echo $selected30; ?>>30</option>
            <option value='40' id='40' <? echo $selected40; ?>>40</option>
        </select>
    </form>
</div>