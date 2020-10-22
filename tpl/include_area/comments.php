<div class="block-default commentblock mainblock block-shadow clearfix">
	<div class="block-title clearfix">
		
		<!-- <a class="notitlestyle" href="/forum/?PAGE_NAME=forums&GID=5">Комментарии</a> -->
		<span class="notitlestyle">Комментарии</span>
	</div>
<?
		$count = 0;
		CModule::IncludeModule("forum"); 
		CModule::IncludeModule("iblock"); 

		// $db_res = CForumMessage::GetListEx(array("ID"=>"DESC"), array("@FORUM_ID"=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18)), false, 2);
		// $db_res = CForumMessage::GetListEx(array("POST_DATE"=>"DESC"), array("@FORUM_ID"=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18)), false, 2);
		$db_res = CForumMessage::GetListEx(array("POST_DATE"=>"DESC"), array(), false);
		while ($ar_res = $db_res->Fetch()) {
			if (3 == $count)
				break;

			// pre($ar_res);
			// pre('count: ' . $count);
			// continue;
			if ('Y' != $ar_res['NEW_TOPIC'])
			{ 
					$ress = CIBlockElement::GetByID($ar_res["PARAM2"]); 

					if ($arElem = $ress->GetNext())
					{
						// pre('44');
						// pre($arElem);
						$login = ($ar_res["LOGIN"] != "")? $ar_res["LOGIN"]: $ar_res["AUTHOR_NAME"];
						$mess = $arElem["NAME"];
						if (strlen($mess) > 25)
							$mess = substr($mess, 0, 25) . '&nbsp;...';
?>
							<div class="newsbitem clearfix">
								<div class="commenttitlelink">
									<a href="<? echo $arElem["DETAIL_PAGE_URL"]; ?>">
										<? echo $mess; ?>
									</a>
								</div>
								<div class="infotvc">
									<span class="infotime"><? echo $ar_res['POST_DATE']?></span>
								</div>
								<div class="commentdescr nodisp1320">
									<?
									// pre($ar_res["POST_MESSAGE"]);
									// echo $ar_res["POST_MESSAGE_HTML"]; 
									$ar_res["POST_MESSAGE"] = preg_replace('/\[(\w+)(?!\w)[^\]]*\]((?:(?!\[\/\1).)*?)\[\/\1\]/i', ' \2 ', $ar_res["POST_MESSAGE"]);	
									echo (strlen($ar_res["POST_MESSAGE"]) > 30)? substr($ar_res["POST_MESSAGE"], 0, 30) . '&nbsp;...': $ar_res["POST_MESSAGE"]; ?>
								</div>
	 
							</div>
							<div class="seporator">
							</div>
<?
						++$count;
					}   
			}
			else
			{
				 
			}
		}
?>
	<!-- <div class="text-center buttonblock">
		<a class="btn btn-blue" href="/forum/?PAGE_NAME=forums&GID=5">Все комментарии<i class="icon-icons_main-10"></i></a>
	</div> -->
</div>