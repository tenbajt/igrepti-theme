<div class="pt-24 pb-56 bg-gray-50 sm:pt-28 sm:pb-60 md:pt-32 md:pb-64 xl:pt-40 xl:pb-72">
    <div class="mx-auto w-full max-w-md px-4 space-y-8 sm:px-6 md:px-8">
        <div class="">
            <h2 class="text-3xl text-gray-900 text-center font-extrabold">
                Odzyskiwanie hasła
            </h2>
            <p class="mt-2 text-sm text-gray-700 text-center">
                Podaj adres e-mail swojego konta.
            </p>
        </div>
        <form class="space-y-8" method="post">
            <input class="w-full" type="text" name="user_login" autocomplete="email" placeholder="Adres e-mail">
            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
            <input type="hidden" name="wc_reset_password" value="true">
            <button class="btn w-full py-2 px-4 text-sm" type="submit" value="Resetuj hasło">
                Resetuj
            </button>
        </form>
    </div>
</div>
