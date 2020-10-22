<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>

<?
if (!empty($item['~PREVIEW_PICTURE']))
	$fileImg = CFile::ResizeImageGet($item['PREVIEW_PICTURE']["ID"], array('width'=>160, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>

<div class="col-sm-4 col-xs-6 cell-12-xs content-margin">

	<span class="hide product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
		  style="display: none;" data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
	</span>
	<span class="hide product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
		style="background-image: url(<?=$bgImage?>); display: <?=($showSlider ? 'none' : '')?>;">
	</span>

	<div class="block-default block-shadow hitssecitem text-center">
		<div class="hitssecimg" style="background-image: url('<? echo !empty($fileImg['src'])? $fileImg['src']: EMPTY_IMAGE_PATH; ?>');">
			<a href="<? echo $item['DETAIL_PAGE_URL']; ?>"></a>
		</div>
		<div class="hitssectext">
			<div class="hitssectitle">
				<a href="<? echo $item['DETAIL_PAGE_URL']; ?>"><? echo $item['~NAME']; ?></a>
			</div>
			<div class="hitssecfirm">
				<? echo $item['DISPLAY_PROPERTIES']['brand']['DISPLAY_VALUE']; ?>
			</div>
			<div class="hitssecprice">
				<span id="<?=$itemIds['PRICE']?>">
					<? echo $price['PRICE']; ?>
				</span>
				<span>руб</span>
			</div>
			<div class="text-center buttonblock">
				<a class="btn minbr btn-blue-full" href="<? echo $item['DETAIL_PAGE_URL']; ?>"><span class="arrow text-center"><i class="icon-icons_main-10"></i></span><span class="text">Подробнее</span></a>
			</div>

			<?
			/*
			<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
				<div class="product-item-amount">
					<div class="product-item-amount-field-container">
						<a class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"
							href="javascript:void(0)" rel="nofollow">
						</a>
						<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="tel"
							name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
							value="<?=$measureRatio?>">
						<a class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP']?>"
							href="javascript:void(0)" rel="nofollow">
						</a>
						<span class="product-item-amount-description-container">
							<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
								<?=$actualItem['ITEM_MEASURE']['TITLE']?>
							</span>
							<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
						</span>
					</div>
				</div>
			</div>

			<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
				<a class="btn btn-blue <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
					href="javascript:void(0)" rel="nofollow">
					<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
				</a>
			</div>

			*/
			?>
			<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
<?
				foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) { ?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
						value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
<?
					unset($item['PRODUCT_PROPERTIES'][$propID]);
				}
?>
			</div>
		</div>
	</div>
</div>




<?
/*
<div class="product-item">
	<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
		data-entity="image-wrapper">
		<span class="product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
			style="display: none;" data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
		</span>

		<?
		if ($item['SECOND_PICT'])
		{
			$bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
			?>
			<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
				style="background-image: url(<?=$bgImage?>); display: <?=($showSlider ? 'none' : '')?>;">
			</span>
			<?
		}
		?>

	</a>
	<div class="product-item-title">
		<a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><?=$productTitle?></a>
	</div>
	<?
	if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
	{
		foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
		{
			switch ($blockName)
			{
				
				
				case 'price': 
				
				pre('price');
				?>
					<div class="product-item-info-container product-item-price-container" data-entity="price-block">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<span class="product-item-price-old" id="<?=$itemIds['PRICE_OLD']?>"
								<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
								<?=$price['PRINT_RATIO_BASE_PRICE']?>
							</span>&nbsp;
							<?
						}
						?>
						<span class="product-item-price-current" id="<?=$itemIds['PRICE']?>">
							<?
							if (!empty($price))
							{
								if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
								{
									echo Loc::getMessage(
										'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
										array(
											'#PRICE#' => $price['PRINT_RATIO_PRICE'],
											'#VALUE#' => $measureRatio,
											'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
										)
									);
								}
								else
								{
									echo $price['PRINT_RATIO_PRICE'];
								}
							}
							?>
						</span>
					</div>
					<?
					break;

				case 'quantityLimit':
				pre('quantityLimit');
					if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
					{
						if ($haveOffers)
						{
							if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
							{
								?>
								<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>"
									style="display: none;" data-entity="quantity-limit-block">
									<div class="product-item-info-container-title">
										<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
										<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
									</div>
								</div>
								<?
							}
						}
						else
						{
							if (
								$measureRatio
								&& (float)$actualItem['CATALOG_QUANTITY'] > 0
								&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
								&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
							)
							{
								?>
								<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>">
									<div class="product-item-info-container-title">
										<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
										<span class="product-item-quantity">
											<?
											if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
											{
												if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
												{
													echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
												}
												else
												{
													echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
												}
											}
											else
											{
												echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
											}
											?>
										</span>
									</div>
								</div>
								<?
							}
						}
					}

					break;

				case 'quantity':
						pre('quantity');
					if (!$haveOffers)
					{
						if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
								<div class="product-item-amount">
									<div class="product-item-amount-field-container">
										<a class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"
											href="javascript:void(0)" rel="nofollow">
										</a>
										<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="tel"
											name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
											value="<?=$measureRatio?>">
										<a class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP']?>"
											href="javascript:void(0)" rel="nofollow">
										</a>
										<span class="product-item-amount-description-container">
											<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
												<?=$actualItem['ITEM_MEASURE']['TITLE']?>
											</span>
											<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
										</span>
									</div>
								</div>
							</div>
							<?
						}
					}
					elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
					{
						if ($arParams['USE_PRODUCT_QUANTITY'])
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
								<div class="product-item-amount">
									<div class="product-item-amount-field-container">
										<a class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"
											href="javascript:void(0)" rel="nofollow">
										</a>
										<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="tel"
											name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
											value="<?=$measureRatio?>">
										<a class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP']?>"
											href="javascript:void(0)" rel="nofollow">
										</a>
										<span class="product-item-amount-description-container">
											<span id="<?=$itemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
											<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
										</span>
									</div>
								</div>
							</div>
							<?
						}
					}

					break;

					
					
					
				case 'buttons':
					?>
					<div class="product-item-info-container product-item-hidden" data-entity="buttons-block">
						<?
						if (!$haveOffers)
						{
							if ($actualItem['CAN_BUY'])
							{
								?>
								<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
									<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
										href="javascript:void(0)" rel="nofollow">
										<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
									</a>
								</div>
								<?
							}
							else
							{
								?>
								<div class="product-item-button-container">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $actualItem['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => true,
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<a class="btn btn-link <?=$buttonSizeClass?>"
										id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow">
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
								</div>
								<?
							}
						}
						else
						{
							if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
							{
								?>
								<div class="product-item-button-container">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $item['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<a class="btn btn-link <?=$buttonSizeClass?>"
										id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
										style="display: <?=($actualItem['CAN_BUY'] ? 'none' : '')?>;">
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
									<div id="<?=$itemIds['BASKET_ACTIONS']?>" style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;">
										<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
											href="javascript:void(0)" rel="nofollow">
											<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
										</a>
									</div>
								</div>
								<?
							}
							else
							{
								?>
								<div class="product-item-button-container">
									<a class="btn btn-default <?=$buttonSizeClass?>" href="<?=$item['DETAIL_PAGE_URL']?>">
										<?=$arParams['MESS_BTN_DETAIL']?>
									</a>
								</div>
								<?
							}
						}
						?>
					</div>
					<?
					break;

				case 'props':
					if (!$haveOffers)
					{
						pre('1');
						if (!empty($item['DISPLAY_PROPERTIES']))
						{
							pre('2');
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
									{
										?>
										<dt<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=$displayProperty['NAME']?>
										</dt>
										<dd<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=(is_array($displayProperty['DISPLAY_VALUE'])
												? implode(' / ', $displayProperty['DISPLAY_VALUE'])
												: $displayProperty['DISPLAY_VALUE'])?>
										</dd>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}

						if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']))
						{
							pre('3');
							?>
							<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
								<?
								if (!empty($item['PRODUCT_PROPERTIES_FILL']))
								{
									pre('4');
									foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
									{
										
										?>
										<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
											value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
										<?
										unset($item['PRODUCT_PROPERTIES'][$propID]);
									}
								}

								if (!empty($item['PRODUCT_PROPERTIES']))
								{
									pre('5');
									?>
									<table>
										<?
										foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo)
										{
											?>
											<tr>
												<td><?=$item['PROPERTIES'][$propID]['NAME']?></td>
												<td>
													<?
													if (
														$item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
														&& $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
													)
													{
														foreach ($propInfo['VALUES'] as $valueID => $value)
														{
															?>
															<label>
																<? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
																<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
																	value="<?=$valueID?>" <?=$checked?>>
																<?=$value?>
															</label>
															<br />
															<?
														}
													}
													else
													{
														?>
														<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]">
															<?
															foreach ($propInfo['VALUES'] as $valueID => $value)
															{
																$selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
																?>
																<option value="<?=$valueID?>" <?=$selected?>>
																	<?=$value?>
																</option>
																<?
															}
															?>
														</select>
														<?
													}
													?>
												</td>
											</tr>
											<?
										}
										?>
									</table>
									<?
								}
								?>
							</div>
							<?
						}
					}
					else
					{
						$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
						$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

						if ($showProductProps || $showOfferProps)
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									if ($showProductProps)
									{
										foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
										{
											?>
											<dt<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<?=$displayProperty['NAME']?>
											</dt>
											<dd<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<?=(is_array($displayProperty['DISPLAY_VALUE'])
													? implode(' / ', $displayProperty['DISPLAY_VALUE'])
													: $displayProperty['DISPLAY_VALUE'])?>
											</dd>
											<?
										}
									}

									if ($showOfferProps)
									{
										?>
										<span id="<?=$itemIds['DISPLAY_PROP_DIV']?>" style="display: none;"></span>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}
					}

					break;

				
			}
		}
	}

	if (
		$arParams['DISPLAY_COMPARE']
		&& (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
	)
	{
		?>
		<div class="product-item-compare-container">
			<div class="product-item-compare">
				<div class="checkbox">
					<label id="<?=$itemIds['COMPARE_LINK']?>">
						<input type="checkbox" data-entity="compare-checkbox">
						<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
					</label>
				</div>
			</div>
		</div>
		<?
	}
	?>
</div>