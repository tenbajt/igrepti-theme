<?php global $wp ?>

<?php get_header() ?>

<div class="min-h-[80vh] pt-4 lg:pt-6 pb-24 xl:pb-32 bg-gray-100">
    <div class="mx-auto max-w-screen-xl grid lg:grid-cols-[auto,1fr] gap-5 sm:pl-2 md:pl-4 md:pr-8">
        <div class="lg:w-56 max-w-full">
            <ul class="m-0 p-0 list-none">
                <?php foreach (wc_get_account_menu_items() as $endpoint => $label): ?>
                    <li>
                        <?php $endpoint_url = rtrim(wc_get_account_endpoint_url($endpoint), '/') ?>
                        <a class="group py-1 px-4 grid grid-flow-col items-center justify-start text-sm text-gray-700 font-medium whitespace-nowrap rounded-sm hover:text-green-600 hover:bg-gray-50 selected:text-green-600 selected:bg-gray-50" href="<?= $endpoint_url ?>" data-state="<?= strpos(home_url($wp->request), $endpoint_url) !== false ? 'selected' : '' ?>">
                            <i class="material-icons-outlined mr-2 text-2xl text-gray-400 group-hover:text-green-600 group-selected:text-green-600">
                                <?php if ($endpoint == 'orders'): ?>
                                    shopping_cart
                                <?php elseif ($endpoint == 'edit-account'): ?>
                                    business
                                <?php endif ?>
                            </i>
                            <?= $label ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li>
                    <a class="group py-1 px-4 grid grid-flow-col items-center justify-start text-sm text-gray-700 font-medium whitespace-nowrap rounded-sm hover:text-green-600 hover:bg-gray-50" href="<?= wc_get_account_endpoint_url('customer-logout') ?>">
                        <i class="material-icons mr-2 text-2xl text-gray-400 group-hover:text-green-600">
                            logout
                        </i>
                        Wyloguj się
                    </a>
                </li>
            </ul>
        </div>
        <div class="px-4 lg:px-0 overflow-x-scroll">
            <?php do_action('woocommerce_account_content') ?>
        </div>
    </div>
</div>

<?php get_footer() ?>