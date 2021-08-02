<?php $order = wc_get_order($order_id); if (! $order) return ?>
<?php $order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item')) ?>
<?php $show_purchase_note  = $order->has_status(apply_filters( 'woocommerce_purchase_note_order_statuses', array('completed', 'processing'))) ?>
<?php $show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id() ?>

<div class="col-span-4 col-start-2 bg-white shadow rounded overflow-hidden">
    <div class="py-5 px-4 sm:px-6">
        <div class="grid grid-flow-col justify-start">
            <h2 class="text-lg text-gray-900 font-medium">
                Zamówienie #<?= $order->get_order_number() ?>
            </h2>
            <div class="ml-2">
                <?php $color = [
                    'bg' => 'bg-gray-100',
                    'text' => 'text-gray-800',
                ];
                switch ($order->get_status()) {
                    case 'pending':
                    case 'processing':
                    case 'on-hold':
                    case 'payu-waiting':
                        $color = [
                            'bg' => 'bg-yellow-100',
                            'text' => 'text-yellow-800',
                        ];
                        break;
                    case 'completed':
                        $color = [
                            'bg' => 'bg-green-100',
                            'text' => 'text-green-800',
                        ];
                        break;
                    case 'failed':
                    case 'cancelled':
                        $color = [
                            'bg' => 'bg-red-100',
                            'text' => 'text-red-800',
                        ];
                        break;
                }?>
                <span class="px-2 inline-block text-xs <?= $color['text'] ?> font-semibold leading-5 <?= $color['bg'] ?> rounded-full">
                    <?= wc_get_order_status_name($order->get_status()) ?>
                </span>
            </div>
        </div>
        <div class="text-xs text-gray-500">
            <?= wc_format_datetime($order->get_date_created()) ?>
        </div>
    </div>
	<table class="min-w-full border-b border-gray-200 divide-y divide-gray-200">
		<thead class="bg-gray-50 border-t border-gray-200">
			<tr>
				<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Produkt
                </th>
                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Ilość
                </th>
				<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Suma
                </th>
			</tr>
		</thead>
		<tbody class="bg-white divide-y divide-gray-200">
			<?php foreach ($order_items as $item_id => $item): ?>
				<?php $product = $item->get_product() ?>
				<?php wc_get_template( 'order/order-details-item.php', [
                    'order'              => $order,
                    'item_id'            => $item_id,
                    'item'               => $item,
                    'show_purchase_note' => $show_purchase_note,
                    'purchase_note'      => $product ? $product->get_purchase_note() : '',
                    'product'            => $product,
                ])?>
			<?php endforeach ?>
		</tbody>
    </table>
    <table class="mt-14 min-w-full divide-y divide-gray-200">
        <thead class="bg-green-100 border-t border-gray-200">
            <tr>
                <th class="py-3 px-6 text-xs text-green-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Suma
                </th>
                <th class="py-3 px-6 text-xs text-green-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Wysyłka
                </th>
                <th class="py-3 px-6 text-xs text-green-500 text-left font-medium tracking-wide uppercase" scope="col">
                    Razem
                </th>
            <tr>
        </thead>
        <tbody class="bg-white">
            <tr class="text-sm text-gray-900">
                <td class="py-4 px-6">
                    <?= $order->get_subtotal_to_display(false, 'excl') ?><br>
                    <span class="text-xs text-gray-500">
                        (<?= $order->get_subtotal_to_display(false, 'incl') ?> z VAT)
                    </span>
                </td>
                <td class="py-4 px-6">
                    <?php if ($order->get_shipping_total() <= 0): ?>
                        <?= $order->get_shipping_method() ?>
                        <span class="ml-1 px-2 inline-block text-xs text-green-800 font-semibold leading-5 bg-green-100 rounded-full">
                            Darmowa
                        </span>
                    <?php else: ?>
                        <?= $order->get_shipping_method() ?>: <?= wc_price($order->get_shipping_total()) ?><br>
                        <span class="text-xs text-gray-500">
                            (<?= wc_price($order->get_shipping_total() + $order->get_shipping_tax()) ?> z VAT 23%)
                        </span>
                    <?php endif ?>
                </td>
                <td class="py-4 px-6">
                    <?= $order->get_formatted_order_total() ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
