<div class="pt-4 pb-16 bg-gray-50 sm:pb-20 md:pb-24 xl:pb-32">
	<div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
		<h1 class="text-xl text-gray-900 font-medium">
			Koszyk
		</h1>
		<form class="mt-4 shadow rounded overflow-x-scroll lg:overflow-hidden" action="<?= wc_get_cart_url() ?>" method="post">
			<input type="hidden" name="update_cart" value="update_cart">
			<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce') ?>
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							<!-- Placeholder for product's thumbnail column -->
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							Nazwa
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							Indeks
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							Cena
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							Ilość
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							Suma
						</th>
						<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
							<!-- Placeholder for product's delete action button -->
						</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>
						<?php $_product = $cart_item['data'] ?>
						<?php if ($_product && $_product->exists() && $cart_item['quantity'] > 0): ?>
							<?php $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key) ?>
							<tr class="text-sm text-gray-900">
								<td>
									<a class="relative block" href="<?= $product_permalink ?>">
										<img class="w-20 h-20 object-cover" src="<?= wp_get_attachment_url($_product->get_image_id()) ?>" alt="<?= get_post_meta($_product->get_image_id(), '_wp_attachment_image_alt', true) ?>">
										<?php $manufacturer = get_field('manufacturer', $_product->get_id()) ?>
										<?php if (is_object($manufacturer)): ?>
											<?php $manufacturer_logo = get_field('logo_profile', "manufacturer_{$manufacturer->term_id}") ?>
											<?php if (is_array($manufacturer_logo) && ! empty($manufacturer_logo)): ?>
												<img class="absolute top-1 left-1 w-3 h-3 object-cover" src="<?= $manufacturer_logo['url'] ?>" alt="<?= $manufacturer_logo['alt'] ?>">
											<?php endif ?>
										<?php endif ?>
									</a>
								</td>
								<td class="py-4 px-6">
									<a class="hover:underline" href="<?= get_permalink($_product->get_id()) ?>">
										<?= $_product->get_name() ?>
									</a>
								</td>
								<td class="py-4 px-6">
									<?= $_product->get_sku() ?>
								</td>
								<td class="py-4 px-6">
									<?= wc_price(wc_get_price_excluding_tax($_product)) ?><br>
									<span class="text-xs text-gray-500">
										<?php $taxes = (new WC_Tax())->find_rates([
											'country' => WC()->customer->get_billing_country() ?: get_option('woocommerce_default_country'),
											'tax_class' => $_product->get_tax_class(),
										])?>
										(<?= wc_price(wc_get_price_including_tax($_product)) ?> z VAT <?= reset($taxes)['rate'] ?>%)
									</span>
								</td>
								<td class="py-4 px-6">
									<input
										min="<?= $_product->get_min_purchase_quantity() ?>"
										max="<?= $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : '' ?>"
										step="1"
										size="4"
										type="number"
										name="<?= "cart[{$cart_item_key}][qty]" ?>"
										class="w-[70px]"
										value="<?= $cart_item['quantity'] ?>"
										onchange="this.form.submit()"
									>
								</td>
								<td class="py-4 px-6">
									<?= wc_price(wc_get_price_excluding_tax($_product, ['qty' => $cart_item['quantity']])) ?><br>
									<span class="text-xs text-gray-500">
										<?php $taxes = (new WC_Tax())->find_rates([
											'country' => WC()->customer->get_billing_country() ?: get_option('woocommerce_default_country'),
											'tax_class' => $_product->get_tax_class(),
										])?>
										(<?= wc_price(wc_get_price_including_tax($_product, ['qty' => $cart_item['quantity']])) ?> z VAT <?= reset($taxes)['rate'] ?>%)
									</span>
								</td>
								<td class="py-4 px-6">
									<a class="material-icons p-1 text-red-600 hover:text-red-800" href="<?= wc_get_cart_remove_url($cart_item_key) ?>">
										clear
									</a>
								</td>
							</tr>
						<?php endif ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
		<?php do_action('woocommerce_cart_collaterals') ?>
	</div>
</div>
