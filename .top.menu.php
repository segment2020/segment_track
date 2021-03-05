<?
$aMenuLinks = Array(
	Array(
		"Новости", 
		"/news/", 
		Array(), 
		Array(), 
		"" 
	), 
	Array(
		"Лонгриды", 
		"/longreads/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Мнения", 
		"/viewpoint/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Медиа", 
		"/photovideo/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Участники рынка", 
		"/company/", 
		Array(), 
		Array(), 
		"" 
	), 
	/*Array(
		"Форум", 
		"/forum/", 
		Array(), 
		Array(), 
		"" 
	),*/
	Array(
		"Календарь событий", 
		"/events/", 
		Array(), 
		Array(), 
		"" 
	)
);

if ((1 == $USER->GetByID()) && $USER->IsAdmin())
{
	$aMenuLinks[] = Array(
		"Статистика", 
		"/bannerstatistic/", 
		Array(), 
		Array(), 
		"" 
	);
}
?>