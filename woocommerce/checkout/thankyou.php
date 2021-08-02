<div class="pt-20 pb-16 bg-gray-50 sm:pb-20 md:pb-24 xl:pb-32">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
        <?php if ($order): ?>
            <?php if ($order->has_status('failed')): ?>
                <p class="text-gray-900 text-center">
                    <?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce') ?>
                </p>
                <p class="mt-2 text-center">
                    <a class="btn" href="<?= $order->get_checkout_payment_url() ?>">
                        Zapłać
                    </a>
                </p>
            <?php else : ?>
                <p class="text-3xl text-gray-900 text-center font-bold">
                    Dziękujemy.
                </p>
                <p class="mt-2 text-sm text-gray-600 text-center">
                    Otrzymaliśmy Twoje zamówienie. Będziemy Cię na bieżąco<br>informować
                    o dalszych postępach w jego realizacji.
                </p>
                <div class="mt-8 grid grid-cols-6 gap-8">
                    <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()) ?>
                    <?php do_action('woocommerce_thankyou', $order->get_id()) ?>
                </div>
            <?php endif ?>
        <?php else : ?>
            <p class="text-gray-900 text-center">
                <?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null) ?>
            </p>
        <?php endif ?>
    </div>
</div>