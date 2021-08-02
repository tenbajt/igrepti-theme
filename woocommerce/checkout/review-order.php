<div class="col-span-6 shadow rounded overflow-hidden">
	<table class="min-w-full divide-y divide-gray-200">
		<thead class="bg-gray-50">
			<tr>
				<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
					Produkt
				</th>
				<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
					Ilość
				</th>
				<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
					Kwota
				</th>
			</tr>
		</thead>
		<tbody class="bg-white divide-y divide-gray-200">
			<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>
				<?php $_product = $cart_item['data'] ?>
				<?php if ($_product && $_product->exists() && $cart_item['quantity'] > 0): ?>
					<tr class="text-sm text-gray-900">
						<td class="py-4 px-6">
							<?= $_product->get_name() ?>
						</td>
						<td class="py-4 px-6">
							<?= $cart_item['quantity'] ?>
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
					</tr>
				<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<div class="col-span-6 md:col-span-3 self-start shadow rounded overflow-hidden">
	<h6 class="py-4 px-6 text-base text-gray-900 font-medium bg-white">
		Podsumowanie
	</h6>
	<div class="grid grid-cols-[auto,1fr] text-sm text-gray-900 border-t border-t-gray-200">
		<div class="py-4 px-6 text-gray-500 font-medium bg-gray-50">
			Suma
		</div>
		<div class="py-4 px-6 bg-gray-50">
			<?= wc_price(WC()->cart->get_subtotal()) ?><br>
			<span class="text-xs text-gray-500">
				(<?= wc_price(WC()->cart->get_subtotal() + WC()->cart->get_cart_contents_tax()) ?> z VAT)
			</span>
		</div>
		<div class="py-4 px-6 text-gray-500 font-medium bg-white">
			Wysyłka
		</div>
		<div class="py-4 px-6 grid grid-cols-[auto,1fr] gap-1 justify-start items-center bg-white">
			<?php foreach (WC()->shipping()->get_packages() as $i => $package): ?>
				<?php if (isset(WC()->session->chosen_shipping_methods[$i])): ?>
					<?php $method = $package['rates'][WC()->session->chosen_shipping_methods[$i]] ?>
					<input class="hidden" type="hidden" name="<?= "shipping_method[{$i}]" ?>" value="<?= $method->id ?>">
					<?= $method->get_label() ?>
					<?php if ($method->cost > 0): ?>
						: <?= wc_price($method->cost) ?>
						<span class="col-span-2 text-xs text-gray-500">
							(<?= wc_price($method->cost + reset($method->taxes)) ?> z VAT 23%)
						</span>
					<?php elseif ($method->method_id !== 'local_pickup'): ?>
						<div class="ml-1">
							<span class="px-2 inline-block text-xs text-green-800 font-semibold leading-5 bg-green-100 rounded-full">
								Darmowa
							</span>
						</div>
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
		</div>
		<div class="py-4 px-6 text-gray-500 font-medium bg-gray-50">
			Do zapłaty
		</div>
		<div class="py-4 px-6 font-bold bg-gray-50">
			<?= WC()->cart->get_total() ?>
		</div>
	</div>
</div>