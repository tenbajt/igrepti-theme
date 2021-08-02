<?php

global $product;

if (empty($product) || ! $product->is_visible()) {
	return;
}?>

<tr class="text-sm text-gray-900">
    <td>
        <a class="relative block" href="<?= get_permalink($product->get_id()) ?>">
            <img class="w-20 h-20 object-cover" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true) ?>">
            <?php $manufacturer = get_field('manufacturer', $product->get_id()) ?>
            <?php if (is_object($manufacturer)): ?>
                <?php $manufacturer_logo = get_field('logo_profile', "manufacturer_{$manufacturer->term_id}") ?>
                <?php if (is_array($manufacturer_logo) && ! empty($manufacturer_logo)): ?>
                    <img class="absolute top-1 left-1 w-3 h-3 object-cover" src="<?= $manufacturer_logo['url'] ?>" alt="<?= $manufacturer_logo['alt'] ?>">
                <?php endif ?>
            <?php endif ?>
        </a>
    </td>
    <td class="py-4 px-6">
        <a class="hover:underline" href="<?= get_permalink($product->get_id()) ?>">
            <?= $product->get_name() ?>
        </a>
    </td>
    <td class="py-4 px-6">
        <?= $product->get_sku() ?>
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
    <td class="py-4 px-6">
        <?= wc_price(wc_format_decimal($product->get_meta('_suggested_detail_price'))) ?>
    </td>
    <td class="py-4 px-6">
        <?php if ('instock' == $product->get_stock_status() || 'yes' == $product->get_backorders()): ?>
            <form id="add-to-cart-<?= $product->get_id() ?>" action="" method="post" enctype="multipart/form-data">
                <input
                    min="<?= $product->get_min_purchase_quantity() ?>"
                    max="<?= $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : '' ?>"
                    step="1"
                    size="4"
                    type="number"
                    name="quantity"
                    class="w-[70px]"
                    value="<?= $product->get_min_purchase_quantity() ?>"
                    inputmode="numeric"
                >
            </form>
        <?php else: ?>
            <span class="px-2 inline-block text-xs text-red-800 font-semibold leading-5 bg-red-100 rounded-full">
                Brak
            </span>
        <?php endif ?>
    </td>
    <td class="py-4 px-6">
        <?php if ('instock' == $product->get_stock_status() || 'yes' == $product->get_backorders()): ?>
            <button class="btn py-2 px-4 justify-start text-sm" name="add-to-cart" value="<?= $product->get_id() ?>" type="submit" form="add-to-cart-<?= $product->get_id() ?>">
                <i class="material-icons-outlined mr-1 text-lg leading-none">
                    add_shopping_cart
                </i>
                Do koszyka
            </button>
        <?php else: ?>
            <form class="inline-block" action="" method="post" enctype="multipart/form-data">
                <?php if (is_array($product->get_meta('back_in_stock_subscribers')) && in_array(get_current_user_id(), $product->get_meta('back_in_stock_subscribers'))): ?>
                    <button class="btn py-2 px-4 text-sm text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50" name="unsubscribe_back_in_stock" value="<?= $product->get_id() ?>" type="submit">
                        <i class="material-icons mr-1 text-lg leading-none">
                            notifications_active
                        </i>
                        Wyłącz
                    </button>
                <?php else: ?>
                    <button class="btn py-2 px-4 justify-start text-sm text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50" name="subscribe_back_in_stock" value="<?= $product->get_id() ?>" type="submit">
                        <i class="material-icons-outlined mr-1 text-lg leading-none">
                            notifications
                        </i>
                        Powiadomienie
                    </button>
                <?php endif ?>
            </form>
        <?php endif ?>
    </td>
</tr>