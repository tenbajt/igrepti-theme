<div class="col-span-6 md:col-span-3 shadow rounded overflow-hidden">
    <h6 class="py-4 px-6 text-base text-gray-900 font-medium bg-white">
		Płatność
	</h6>
	<?php if (WC()->cart->needs_payment()): ?>
		<ul class="m-0 py-4 px-6 grid grid-cols-[auto,1fr] text-sm text-gray-900 bg-gray-50 border-t border-t-gray-200 list-none">
			<?php if (! empty($available_gateways)): ?>
				<?php foreach ($available_gateways as $gateway): ?>
                    <li class="grid grid-flow-col gap-4 justify-start items-center">
                        <input type="radio" name="payment_method" value="<?= $gateway->id ?>" <?php checked($gateway->chosen, true) ?>>
                        <label>
                            <?= $gateway->get_icon() ?>
                        </label>
                    </li>
				<?php endforeach ?>
			<?php else: ?>
				<li class="woocommerce-notice woocommerce-notice--info woocommerce-info"><?= apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) ?></li>
			<?php endif ?>
		</ul>
	<?php endif ?>
	<div class="py-4 px-6 grid grid-cols-[auto,1fr] content-start bg-white">
        <input type="hidden" name="terms-field" value="1">
        <input type="checkbox" name="terms" <?php checked(isset($_POST['terms'])) ?> required>
        <label class="mt-[-1px] ml-3 text-sm">
            Akceptuję regulamin.<br>
        </label>
        <label class="mt-2 col-span-2 text-xs">
            <?php wc_checkout_privacy_policy_text() ?>
        </label>
    </div>
    <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce') ?>
    <button class="btn w-full py-3 px-8 rounded-none md:py-4 md:px-10 md:text-lg" type="submit" name="woocommerce_checkout_place_order" value="Zapłać">
        Zapłać
    </button>
</div>