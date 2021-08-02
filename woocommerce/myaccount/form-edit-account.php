<div class="bg-white shadow rounded overflow-hidden">
    <div class="py-5 px-4 sm:p-6">
        <h3 class="grid grid-flow-col gap-2 justify-start items-center text-lg text-gray-900 leading-6 font-medium">
            Dane firmy
            <?php if (current_user_can('order_products')): ?>
                <span class="px-2 inline-block text-xs text-green-800 font-semibold leading-5 bg-green-100 rounded-full">
                    Zweryfikowane
                </span>
            <?php else: ?>
                <span class="px-2 inline-block text-xs text-red-800 font-semibold leading-5 bg-red-100 rounded-full">
                    Niezweryfikowane
                </span>
            <?php endif ?>
        </h3>
        <?php if (! current_user_can('order_products')): ?>
            <p class="mt-1 max-w-screen-md text-sm text-gray-700">
                <?= get_option('igrepti_unverified_customer_message_text') ?>
            </p>
        <?php endif ?>
    </div>
    <form action="" method="post">
        <div class="py-5 px-4 grid md:grid-cols-6 gap-6 border-t border-gray-200 sm:p-6">
            <div class="md:col-span-6">
                <label class="block text-sm text-gray-700 font-medium">
                    Nazwa
                </label>
                <input class="mt-1 w-full" name="billing_company" type="text" autocomplete="organization" value="<?= get_user_meta($user->ID, 'billing_company', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div class="md:col-span-6">
                <label class="block text-sm text-gray-700 font-medium">
                    Ulica
                </label>
                <input class="mt-1 w-full" name="billing_address_1" type="text" autocomplete="street-address" value="<?= get_user_meta($user->ID, 'billing_address_1', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm text-gray-700 font-medium">
                    Miasto
                </label>
                <input class="mt-1 w-full" name="billing_city" type="text" pattern="\p{L}+" autocomplete="address-level2" value="<?= get_user_meta($user->ID, 'billing_city', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div>
                <label class="block text-sm text-gray-700 font-medium">
                    Kod pocztowy
                </label>
                <input class="mt-1 w-full" name="billing_postcode" type="text" pattern="[0-9]{2}[-][0-9]{3}" autocomplete="postal-code" value="<?= get_user_meta($user->ID, 'billing_postcode', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-700 font-medium">
                    NIP
                </label>
                <input class="mt-1 w-full" name="billing_nip" type="text" pattern="[^a-zA-Z]{10,13}" value="<?= get_user_meta($user->ID, 'billing_nip', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div class="md:col-span-4">
                <label class="block text-sm text-gray-700 font-medium">
                    Adres e-mail
                </label>
                <input class="mt-1 w-full" name="account_email" type="email" autocomplete="email" value="<?= $user->user_email ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-700 font-medium">
                    Telefon
                </label>
                <input class="mt-1 w-full" name="billing_phone" type="tel" pattern="[^a-zA-Z]{9,}" autocomplete="tel" value="<?= get_user_meta($user->ID, 'billing_phone', true) ?>" required <?= current_user_can('order_products') ? 'disabled' : '' ?>>
            </div>
            <?php if (! current_user_can('order-products')): ?>
                <?php wp_nonce_field('save_account_details', 'save-account-details-nonce') ?>
                <input type="hidden" name="action" value="save_account_details">
            <?php endif ?>
        </div>
        <?php if (! current_user_can('order_products')): ?>
            <div class="py-3 px-4 text-right bg-gray-50 sm:px-6">
                <button class="btn py-2 px-4 text-sm" type="submit" name="save_account_details" value="Zapisz">
                    Zapisz
                </button>
            </div>
        <?php endif ?>
    </form>
</div>
<div class="mt-6 bg-white shadow rounded overflow-hidden">
    <h2 class="py-5 px-4 text-lg text-gray-900 leading-6 font-medium sm:p-6">
        Adres dostawy
    </h2>
    <form action="" method="post">
        <div class="py-5 px-4 grid md:grid-cols-6 gap-6 border-t border-gray-200 sm:p-6">
            <div class="md:col-span-6">
                <label class="block text-sm text-gray-700 font-medium">
                    Ulica
                </label>
                <input class="mt-1 w-full" name="shipping_address_1" type="text" autocomplete="street-address" value="<?= get_user_meta($user->ID, 'shipping_address_1', true) ?>" required>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm text-gray-700 font-medium">
                    Miasto
                </label>
                <input class="mt-1 w-full" name="shipping_city" type="text" pattern="\p{L}+" autocomplete="address-level2" value="<?= get_user_meta($user->ID, 'shipping_city', true) ?>" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700 font-medium">
                    Kod pocztowy
                </label>
                <input class="mt-1 w-full" name="shipping_postcode" type="text" pattern="[0-9]{2}[-][0-9]{3}" autocomplete="postal-code" value="<?= get_user_meta($user->ID, 'shipping_postcode', true) ?>" required>
            </div>
        </div>
        <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce') ?>
        <input type="hidden" name="action" value="edit_address">
        <input type="hidden" name="shipping_country" value="PL">
        <div class="py-3 px-4 text-right bg-gray-50 sm:px-6">
            <button class="btn py-2 px-4 text-sm" type="submit" name="save_address" value="Zapisz">
                Zapisz
            </button>
        </div>
    </form>
</div>
<div class="mt-6 bg-white shadow rounded overflow-hidden">
    <h2 class="py-5 px-4 text-lg text-gray-900 leading-6 font-medium sm:p-6">
        Zmiana hasła
    </h2>
    <form action="" method="post">
        <fieldset class="py-5 px-4 grid md:grid-cols-6 gap-6 border-t border-gray-200 sm:p-6">
            <div class="md:col-span-6">
                <label class="block text-sm text-gray-700 font-medium">
                    Aktualne hasło
                </label>
                <input class="mt-1 w-full" name="password_current" type="password" autocomplete="current-password">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm text-gray-700 font-medium">
                    Nowe hasło
                </label>
                <input class="mt-1 w-full" name="password_1" type="password" autocomplete="new-password">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm text-gray-700 font-medium">
                    Potwierdź nowe hasło
                </label>
                <input class="mt-1 w-full" name="password_2" type="password" autocomplete="new-password">
            </div>
        </fieldset>
        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce') ?>
        <input type="hidden" name="action" value="save_account_details">
        <div class="py-3 px-4 text-right bg-gray-50 sm:px-6">
            <button class="btn py-2 px-4 text-sm" type="submit" name="save_account_details" value="Zapisz">
                Zmień hasło
            </button>
        </div>
    </form>
</div>
