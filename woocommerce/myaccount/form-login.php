<div class="min-h-[80vh] pt-24 pb-24 xl:pb-32 bg-gray-50">
	<div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
        <div class="mb-12">
            <img class="mx-auto max-w-[214px]" src="<?= wp_get_attachment_url(get_theme_mod('custom_logo')) ?>" alt="<?= get_post_meta(get_theme_mod('custom_logo'), '_wp_attachment_image_alt', true) ?: get_bloginfo('name', 'display') ?>">
            <p class="mt-1 mx-auto max-w-lg text-gray-900 text-center">
                <?= get_bloginfo('description') ?>
            </p>
        </div>
        <div class="grid lg:grid-flow-col justify-center">
            <form class="w-full max-w-sm" method="post">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce') ?>
                <input type="hidden" name="rememberme" type="checkbox" value="forever" checked>
                <input class="mb-4 w-full py-2 px-3 text-sm text-gray-900 placeholder-gray-400" placeholder="Adres e-mail" type="text" name="username" autocomplete="username" value="<?= (! empty($_POST['username']))? esc_attr(wp_unslash($_POST['username'])) : '' ?>">
                <input class="mb-6 w-full py-2 px-3 text-sm text-gray-900 placeholder-gray-400" placeholder="Hasło" type="password" name="password" autocomplete="current-password">
                <button class="btn mb-10 w-full py-2 px-3 text-sm" type="submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                    Zaloguj się
                </button>
                <div class="text-center">
                    <a class="text-sm text-green-600 underline hover:text-green-900" href="<?= wp_lostpassword_url() ?>">
                        Nie pamiętasz hasła?
                    </a>
                </div>
            </form>
            <div class="max-h-40 px-12 hidden sm:block">
                <div class="w-full lg:w-auto lg:h-full border-l border-gray-200"></div>
            </div>
            <h3 class="lg:hidden mt-16 text-xl text-gray-900 font-bold text-center">
                Nie masz jeszcze konta?
            </h3>
            <form class="mt-4 lg:mt-0 w-full max-w-sm" method="post">
                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce') ?>
                <input class="mb-4 w-full py-2 px-3 text-sm text-gray-900 placeholder-gray-400" placeholder="Adres e-mail" type="email" name="email" autocomplete="email" value="<?= (! empty($_POST['email']))? esc_attr(wp_unslash($_POST['email'])) : '' ?>">
                <input class="mb-6 w-full py-2 px-3 text-sm text-gray-900 placeholder-gray-400" placeholder="Hasło" type="password" name="password" autocomplete="new-password">
                <button class="btn mb-10 w-full py-2 px-3 text-sm" type="submit" name="register" value="Zarejestruj się">
                    Zarejestruj się
                </button>
            </form>
        </div>
    </div>
</div>
