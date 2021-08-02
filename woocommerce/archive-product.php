<?php get_header() ?>

<div class="min-h-[80vh] pb-24 xl:pb-32 bg-gray-50">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
        <div class="mb-2 py-4 grid grid-cols-[1fr,auto] items-center">
            <div class="grid grid-flow-col gap-2 justify-start items-center">
                <?php if (isset(get_queried_object()->term_id)): ?>
                    <?php $image = get_field('logo_profile', 'manufacturer_'.get_queried_object()->term_id) ?>
                    <?php if ($image): ?>
                        <div class="mr-2 bg-white border border-gray-100">
                            <img class="w-12 h-12 object-cover rounded-sm overflow-hidden" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                        </div>
                    <?php endif ?>
                <?php endif ?>
                <div>
                    <h1 class="text-xl text-gray-900 font-medium">
                        <?php woocommerce_page_title() ?>
                    </h1>
                    <span class="text-sm text-gray-600">
                        <?php woocommerce_result_count() ?>
                    </span>
                </div>
            </div>
            <?php woocommerce_catalog_ordering() ?>
        </div>
        <?php if (have_posts()): ?>
            <?php if (current_user_can('order_products')): ?>
                <div class="shadow rounded overflow-y-hidden overflow-x-scroll">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    <!-- Placeholder for product's thumbnail column -->
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    Nazwa
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    Indeks
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    Cena
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    Detal
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    Ilość
                                </th>
                                <th class="py-3 px-6 text-xs text-gray-500 text-left font-medium tracking-wide uppercase" scope="col">
                                    <!-- Placeholder for product's action button -->
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php while (have_posts()): the_post() ?>
                                <?php wc_get_template_part('miniature', 'product-customer') ?>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <ul class="m-0 p-0 grid gap-1 list-none md:gap-y-7 lg:grid-cols-4">
                    <?php while (have_posts()): the_post() ?>
                        <?php wc_get_template_part('miniature', 'product-guest') ?>
                    <?php endwhile ?>
            <?php endif ?>
        <?php else: ?>
            <h1 class="py-48 text-xl text-gray-400 text-center font-medium">
                <?php if ($GLOBALS['wp_query']->is_search()): ?>
                    Brak produktów
                <?php else: ?>
                    Brak produktów
                <?php endif ?>
            </h1>
        <?php endif ?>
    </div>
</div>

<?php get_footer() ?>