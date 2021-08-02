<div class="md:grid md:grid-cols-3 md:gap-6">
	<?php if (WC()->cart->needs_shipping_address() === true ): ?>
		<h3 class="px-4 text-lg text-gray-900 font-medium sm:px-0 md:col-span-1">
			Adres dostawy
		</h3>
		<div class="mt-5 md:mt-0 md:col-span-2">
			<div class="py-5 px-4 grid grid-cols-6 gap-6 bg-white shadow sm:p-6 sm:rounded-md sm:overflow-hidden">
				<input type="hidden" name="shipping_country" value="PL">
				<input type="hidden" name="ship_to_different_address" value="1">
				<div class="col-span-6">
					<label class="block text-sm text-gray-700 font-medium">
						Ulica
					</label>
					<input class="mt-1 w-full" name="shipping_address_1" type="text" autocomplete="street-address" value="<?= $checkout->get_value('shipping_address_1') ?>" required>
				</div>
				<div class="col-span-3">
					<label class="block text-sm text-gray-700 font-medium">
						Miasto
					</label>
					<input class="mt-1 w-full" name="shipping_city" type="text" pattern="\p{L}+" autocomplete="address-level2" value="<?= $checkout->get_value('shipping_city') ?>" required>
				</div>
				<div class="col-span-2">
					<label class="block text-sm text-gray-700 font-medium">
						Kod pocztowy
					</label>
					<input class="mt-1 w-full" name="shipping_postcode" type="text" pattern="[0-9]{2}[-][0-9]{3}" autocomplete="postal-code" value="<?= $checkout->get_value('shipping_postcode') ?>" required>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>
<div class="py-5 hidden sm:block">
	<div class="border-t border-gray-200"></div>
</div>
<div class="md:grid md:grid-cols-3 md:gap-6">
	<h3 class="px-4 text-lg text-gray-900 font-medium sm:px-0 md:col-span-1">
		Informacje dodatkowe
	</h3>
	<?php if (get_option('woocommerce_enable_order_comments', 'yes') === 'yes'): ?>
		<div class="mt-5 md:mt-0 md:col-span-2">
			<div class="py-5 px-4 grid grid-cols-6 gap-6 bg-white shadow sm:p-6 sm:rounded-md sm:overflow-hidden">
				<div class="col-span-6">
					<label class="block text-sm text-gray-700 font-medium">
						Uwagi do zamówienia
					</label>
					<textarea class="mt-1 w-full" name="order_comments" value="<?= $checkout->get_value('order_comments') ?>" rows="5"></textarea>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>