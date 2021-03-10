<div class="col-xs-12 content-margin">
	<div class="block-default commentblock block-shadow">				
	<div class="block-title clearfix"><a class="bigRed" href="/forum/?PAGE_NAME=forums&GID=5">Комментарии</a></div>

<? 
	CModule::IncludeModule("forum"); 
	CModule::IncludeModule("iblock"); 

	$db_res = CForumMessage::GetListEx(array("ID"=>"DESC"), array("@FORUM_ID"=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17)), false, 2);
	while ($ar_res = $db_res->Fetch()) {
		$ress = CIBlockElement::GetByID($ar_res["PARAM2"]); 
		if ($arElem = $ress->GetNext()) {
			//pre($ar_res);
			
			$ar_res["POST_MESSAGE"] = preg_replace('/\[(\w+)(?!\w)[^\]]*\]((?:(?!\[\/\1).)*?)\[\/\1\]/i', ' \2 ', $ar_res["POST_MESSAGE"]);
			
			$message = (strlen($ar_res["POST_MESSAGE"]) > 30)? substr($ar_res["POST_MESSAGE"], 0, 30) . '&nbsp;...': $ar_res["POST_MESSAGE"];
			/*
			if ('[IMG' == substr($ar_res['POST_MESSAGE'], 0, 4))
			{
				$tmp = explode(']', $ar_res['POST_MESSAGE']);
				$tmp = explode('[', $tmp[1]);
				$message = '<a href="' . $tmp[0] . '">Изображение</a>';
			}
			*/
			$login = $ar_res["NAME"]; ?>
				<div class="newsbitem clearfix">
					<div class="commenttitlelink">
						<a href="<? echo $arElem["DETAIL_PAGE_URL"]; ?>">
							<? echo $arElem["NAME"]; ?>
						</a>
					</div>
					<div class="infotvc">
						<span class="infotime"><? echo $ar_res['POST_DATE']?></span>
					</div>
					<div class="commentdescr nodisp1320">
						<? echo $message; ?>
					</div>
					<div class="commentautor">
						Автор:
						<? echo $login; ?>
					</div>
				</div>
				<div class="seporator">
				</div>
<?
		}
	} 
?>
		<!-- <div class="text-center buttonblock">
			<a class="btn btn-blue" href="/forum/?PAGE_NAME=forums&GID=5">Все комментарии<i class="icon-icons_main-10"></i></a>
		</div> -->
	</div>					
</div>
<br>