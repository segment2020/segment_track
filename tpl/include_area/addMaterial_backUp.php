		<div class='block-default in block-shadow content-margin'>
			<div class='block-title clearfix'>
				Дополнительный материал
			</div>
			<div class='row'>
<?				// Выберем все активные информационные блоки для текущего сайта
				$res = CIBlock::GetList(array(), array('SITE_ID' => SITE_ID, 'ACTIVE'=>'Y'), true);
				while ($ar_res = $res->Fetch()) {
					if (IBLOCK_ID_CITY == $ar_res['ID'] || IBLOCK_ID_INFOBLOCKS_LIST == $ar_res['ID'] || IBLOCK_ID_BANNERS == $ar_res['ID'])
						continue;

					$categoryList[$ar_res['ID']] = $ar_res['NAME'];
				}

				for ($n = 0; $n < COUNT_ADD_MATERIAL; ++$n) { ?>
					<div class="col-xs-12">
						Дополнительный материал <? echo ($n + 1); ?>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label class="control-label mainlabel" for="addMaterial">Прикрепить материал - выберите раздел</label>
							<select class="selectpicker selectboxbtn form-control minbr typeselect addCategory" name="<? echo 'PROPERTY[' . $arProps['addBblockId']['ID'] . '][' . $n . ']'; ?>" id="<? echo $n; ?>" tabindex="-98">
								<option value="">Нет</option>
<?								foreach ($categoryList as $id => $name) { ?>
									<option value="<? echo $id; ?>"><? echo $name; ?></option>
<?								} ?>
							</select>
						</div>
					</div>

					<div class="col-xs-12 hide" id='addMatElem_<? echo $n; ?>'>
						<div class="form-group">
							<label class="control-label mainlabel" for="el_<? echo $n; ?>">Прикрепить материал - выберите публикацию</label>
							<select class="selectpicker selectboxbtn form-control minbr typeselect addElement" data-size="10" data-live-search="true" name="<? echo $propertyId . '[' . $n . ']'; ?>" id="el_<? echo $n; ?>" tabindex="-98">
							</select>
						</div>
					</div>
<?				} ?>
			</div>
		</div>
	<script type="text/javascript">
			/*
		$('.addCategory').on('change', function(){
			var id = $(this).attr('id');
			var iBlockId = $(this).val();

			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '/ajax/additionalMaterial.php',
				data: 'iBlockId=' + iBlockId,
				beforeSend: function() {
					$('#addMatElem_' + id).addClass('hide');
				},
				success: function(response) {
					$('#el_' + id).empty();
					$('#el_' + id).append(response);
					$('#el_' + id).selectpicker('refresh');
					$('#addMatElem_' + id).removeClass('hide');
				}
			})
		});
		*/
	</script>