<?
use \Bitrix\Main\Loader;
?>

<div class="col-xs-12 content-margin">
	<div class="block-default topblockin block-shadow">
		<a href="/top100/">
			<div class="block-title nobmarrgin clearfix">
				Топ 100
			</div>
		</a>
		<div class="row">
<?
if (Loader::includeModule('iblock')) {
	$counter = 1;
	$_sort = 'property_rating';
    $_order = 'DESC';
	$arSelect = Array('NAME', 'DETAIL_PAGE_URL');
	$arFilter = Array("IBLOCK_ID" => IntVal(IBLOCK_ID_COMPANY), "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(array("$_sort" => $_order), $arFilter, false, array("nPageSize"=>3), $arSelect);
	while ($company = $res->GetNextElement()) {
		$companyArray = $company->GetFields();
?>
			<div class="topitem clearfix">
				<a href="<? echo $companyArray['DETAIL_PAGE_URL']; ?>">
					<div class="topitemimg floatleft">
						<img src="/tpl/images/place<? echo $counter; ?>_sm.png">
					</div>
					<div class="topitemlink">
						<span><? echo $companyArray['NAME']; ?></span>
					</div>
				</a>
			</div>
<?
		++$counter;
	}
}
?>
			<div class="text-center buttonblock">
				<a class="btn btn-blue" href="/top100/">Весь топ-100<i class="icon-icons_main-10"></i></a>
			</div>
		</div>
	</div>
</div>