<?php if (! apply_filters('woocommerce_order_item_visible', true, $item)): return; endif ?>

<tr class="text-sm text-gray-900">
	<td class="py-4 px-6">
		<a class="hover:underline" href="<?= get_permalink($product->get_id()) ?>">
			<?= $item->get_name() ?>
		</a>
	</td>
    <td class="py-4 px-6">
        <?= $item->get_quantity() ?>
    </td>
	<td class="py-4 px-6">
		<?= wc_price(wc_get_price_excluding_tax($product)) ?><br>
        <span class="text-xs text-gray-500">
            <?php $taxes = (new WC_Tax())->find_rates([
                'country' => WC()->customer->get_billing_country() ?: get_option('woocommerce_default_country'),
                'tax_class' => $product->get_tax_class(),
            ])?>
            (<?= wc_price(wc_get_price_including_tax($product)) ?> z VAT <?= reset($taxes)['rate'] ?>%)
        </span>
	</td>
</tr>
