<div class="mt-6 ml-auto max-w-sm shadow rounded overflow-hidden">
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
        <?php wc_cart_totals_shipping_html() ?>
        <div class="py-4 px-6 text-gray-500 font-medium bg-gray-50">
            Do zapłaty
        </div>
        <div class="py-4 px-6 font-bold bg-gray-50">
            <?= WC()->cart->get_total() ?>
        </div>
    </div>
    <a class="btn w-full py-3 px-8 rounded-none md:py-4 md:px-10 md:text-lg" href="<?= wc_get_checkout_url() ?>">
        Zapłać
    </a>
</div>