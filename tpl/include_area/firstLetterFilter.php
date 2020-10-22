<?
$page = $APPLICATION->GetCurPage();

if ('/company/' == $page)
	$link = '/company/list/';
elseif ('/brands/' == $page)
	$link = '/brands/list/';
elseif ('/license/' == $page)
	$link = '/license/list/';
else
	$link = $page;

if (!empty($_GET))
{
	$params = '&';
	foreach ($_GET as $key => $value)
	{
		if ('firstLetter' != $key)
			$params .= $key . '=' . $value . '&';
	}

	$params = substr($params, 0, -1);
}
?>
			<ul class="pagination alphabetslider rus_alf clearfix">
<?
$rusLettersArray = array('А', 
'Б', 
'В', 
'Г', 
'Д', 
'Е', 
'Ж', 
'З', 
'И', 
'Й', 
'К', 
'Л', 
'М', 
'Н', 
'О', 
'П', 
'Р', 
'С', 
'Т', 
'У', 
'Ф', 
'Х', 
'Ц', 
'Ч', 
'Ш', 
'Щ', 
'Э', 
'Ю', 
'Я');


$engLettersArray = array('A', 
'B', 
'C', 
'D', 
'E', 
'F', 
'G', 
'H', 
'I', 
'J', 
'K', 
'L', 
'M', 
'N', 
'O', 
'P', 
'Q', 
'R', 
'S', 
'T', 
'U', 
'V', 
'W', 
'X', 
'Y', 
'Z');


foreach ($rusLettersArray as $letter)
	echo '<li><a href="' . $link . '?firstLetter=' . $letter . $params . '">' . $letter . '</a></li>';
?>
		</ul>
		<ul class="pagination alphabetslider2 eng_alf clearfix">
<?
foreach ($engLettersArray as $letter)
	echo '<li><a href="' . $link . '?firstLetter=' . $letter . $params . '">' . $letter . '</a></li>';
?>
			<!--<li class="active"><a href="#">E</a></li> -->
		</ul>