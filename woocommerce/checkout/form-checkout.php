<div class="pt-6 pb-16 bg-gray-50 sm:pb-20 md:pb-24 xl:pb-32">
	<form class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8" name="checkout" action="<?= wc_get_checkout_url() ?>" method="post" enctype="multipart/form-data">
		<?php if ($checkout->get_checkout_fields()): ?>
			<?php do_action('woocommerce_checkout_billing') ?>
			<?php do_action('woocommerce_checkout_shipping') ?>
		<?php endif ?>
		<div class="py-5 hidden sm:block">
			<div class="border-t border-gray-200"></div>
		</div>
		<div class="md:grid md:grid-cols-3 md:gap-6">
			<h3 class="px-4 text-lg text-gray-900 font-medium sm:px-0 md:col-span-1">
				Zamówienie
			</h3>
			<div class="mt-5 grid grid-cols-6 gap-6 md:mt-0 md:col-span-2">
				<?php do_action('woocommerce_checkout_order_review') ?>
			</div>
		</div>
	</form>
</div>
