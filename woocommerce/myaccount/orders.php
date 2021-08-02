<?php if ($has_orders): ?>
	<table class="min-w-full divide-y divide-gray-200 shadow rounded overflow-hidden">
		<thead class="bg-gray-50">
			<tr>
				<?php foreach (wc_get_account_orders_columns() as $column_id => $column_name ): ?>
					<th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
						<?= esc_html($column_name) ?>
					</th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody class="bg-white divide-y divide-gray-200">
			<?php foreach ($customer_orders->orders as $customer_order): ?>
				<?php $order = wc_get_order($customer_order) ?>
				<?php $item_count = $order->get_item_count() - $order->get_item_count_refunded() ?>
				<tr class="text-sm text-gray-900">
					<td class="py-4 px-6" data-title="<?= esc_attr($column_name) ?>">
						#<?= $order->get_order_number() ?>
					</td>
					<td class="py-4 px-6">
						<?= wc_format_datetime($order->get_date_created()) ?>
					</td>
					<td class="py-4 px-6">
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
					</td>
					<td class="py-4 px-6">
						<?= $order->get_formatted_order_total() ?>
					</td>
					<td class="py-4 px-6">
						<a class="material-icons text-green-600 rounded-sm hover:text-green-800" href="<?= wc_get_account_orders_actions($order)['view']['url'] ?>">
							search
						</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?php if ($customer_orders->max_num_pages > 1): ?>
		<div class="mt-3 text-sm text-gray-500">
			<?php if ($current_page !== 1): ?>
				<a class="inline-grid grid-flow-col items-center hover:text-gray-900" href="<?= wc_get_endpoint_url('orders', $current_page - 1) ?>">
					<i class="mr-2 material-icons">
						keyboard_backspace
					</i>
					Poprzednie
				</a>
			<?php endif ?>
			<?php if (intval($customer_orders->max_num_pages) !== $current_page): ?>
				<div class="text-right">
					<a class="inline-grid grid-flow-col items-center hover:text-gray-900" href="<?= wc_get_endpoint_url('orders', $current_page + 1) ?>">
						Następne
						<i class="ml-2 material-icons">
							arrow_right_alt
						</i>
					</a>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
<?php else: ?>
	<div class="h-full w-full text-center">
        Żadne zamówienia nie zostały jeszcze złożone.
	</div>
<?php endif ?>
