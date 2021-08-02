<?php get_header() ?>

<?php while (have_posts()): the_post() ?>
    <div class="pb-24 xl:pb-32 bg-gray-50">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="space-y-1" data-type="gallery">
                    <div class="aspect-w-1 aspect-h-1 bg-white">
                        <img class="object-contain" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true) ?>" data-type="preview">
                        <?php $manufacturer = get_field('manufacturer', $product->get_id()) ?>
                        <?php if (is_object($manufacturer)): ?>
                            <?php $manufacturer_logo = get_field('logo', "manufacturer_{$manufacturer->term_id}") ?>
                            <?php if (is_array($manufacturer_logo) && ! empty($manufacturer_logo)): ?>
                                <img class="top-3 left-4 w-32 h-32 object-contain object-left-top" src="<?= $manufacturer_logo['url'] ?>" alt="<?= $manufacturer_logo['alt'] ?>">
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <ul class="m-0 p-0 grid grid-flow-col gap-1 justify-start list-none overflow-x-scroll" data-type="thumbnails">
                        <li class="bg-white border-2 border-solid border-white cursor-pointer rounded-sm overflow-hidden selected:border-green-600" data-state="selected">
                            <img class="w-24 h-24" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true) ?>">
                        </li>
                        <?php foreach ($product->get_gallery_image_ids() as $image_id): ?>
                            <li class="bg-white border-2 border-solid border-white cursor-pointer rounded-sm overflow-hidden selected:border-green-600">
                                <img class="w-24 h-24" src="<?= wp_get_attachment_url($image_id) ?>" alt="<?= get_post_meta($image_id, '_wp_attachment_image_alt', true) ?>">
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="lg:mt-12">
                    <h1 class="text-3xl text-gray-900 font-bold">
                        <?= $product->get_name() ?>
                    </h1>
                    <div class="text-sm text-gray-600">
                        Indeks: <?= $product->get_sku() ?> | EAN-13: <?= $product->get_meta('_ean') ?>
                    </div>
                    <div class="mt-8 text-base text-gray-900">
                        <?= $product->get_short_description() ?>
                    </div>
                    <div class="mt-10">
                        <?php if (current_user_can('order_products')): ?>
                            <div>
                                <span class="text-2xl text-gray-900 font-bold">
                                    <?= wc_price(wc_get_price_excluding_tax($product)) ?>
                                </span>
                                <span class="ml-1 inline-block text-sm text-gray-600">
                                    <?php $taxes = (new WC_Tax())->find_rates([
                                        'country' => WC()->customer->get_billing_country() ?: get_option('woocommerce_default_country'),
                                        'tax_class' => $product->get_tax_class(),
                                    ])?>
                                    (<?= wc_price(wc_get_price_including_tax($product)) ?> z VAT <?= reset($taxes)['rate'] ?>%)
                                </span>
                                <div class="mt-[1px] text-sm text-gray-900">
                                    Sugerowana cena detaliczna: <?= wc_price(wc_format_decimal($product->get_meta('_suggested_detail_price'))) ?>
                                </div>
                            </div>
                            <?php if ($product->is_purchasable() && $product->is_in_stock()): ?>
                                <div class="mt-8 mb-1 text-sm text-green-600">
                                    <?= $product->get_availability()['availability'] ?>
                                </div>
                                <form class="grid grid-flow-col gap-2 justify-start" action="<?= $product->get_permalink() ?>" method="post" enctype="multipart/form-data">
                                    <?php woocommerce_quantity_input([
                                        'classes' => 'w-[70px] py-3',
                                        'min_value' => $product->get_min_purchase_quantity(),
                                        'max_value' => $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : '',
                                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                                    ]);?>
                                    <button class="btn" type="submit" name="add-to-cart" value="<?= $product->get_id() ?>">
                                        <i class="material-icons-outlined mr-1 text-lg leading-none">
                                            add_shopping_cart
                                        </i>
                                        Dodaj do koszyka
                                    </button>
                                </form>
                            <?php else: ?>
                                <div class="mt-8 mb-1 text-sm text-red-600">
                                    <?= $product->get_availability()['availability'] ?>
                                </div>
                                <form class="product__notify" method="post" action="">
                                    <?php if (is_array($product->get_meta('back_in_stock_subscribers')) && in_array(get_current_user_id(), $product->get_meta('back_in_stock_subscribers'))): ?>
                                        <button class="btn text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50" name="unsubscribe_back_in_stock" value="<?= $product->get_id() ?>" type="submit">
                                            <i class="material-icons mr-1 text-lg leading-none">
                                                notifications_active
                                            </i>
                                            Wyłącz powiadomienie
                                        </button>
                                    <?php else: ?>
                                        <button class="btn text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50" name="subscribe_back_in_stock" value="<?= $product->get_id() ?>" type="submit">
                                            <i class="material-icons-outlined mr-1 text-lg leading-none">
                                                notifications
                                            </i>
                                            Włącz powiadomienie
                                        </button>
                                    <?php endif ?>
                                </form>
                            <?php endif ?>
                        <?php else: ?>
                            <p class="text-base text-gray-900">
                                Cena produktu i moliwość jego zamówienia są dostępne tylko dla zweryfikowanych klientów.
                            </p>
                            <a class="btn mt-3" href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')) ?>">
                                Zaloguj się
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="mt-12 max-w-screen-md text-base text-gray-900">
                <?= $product->get_description() ?>
            </div>
        </div>
    </div>
<?php endwhile ?>

<?php get_footer() ?>