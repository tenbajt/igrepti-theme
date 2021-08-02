<?php
/**
 * Template Name: Kontakt
 * Template Post Type: page
 */
?>

<?php $has_sent_form = apply_filters('igrepti_process_contact_form', null) ?>

<?php get_header() ?>

<div class="pt-6 lg:pt-20 pb-24 xl:pb-32 bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4 lg:px-6 xl:px-8 grid gap-12 items-center lg:gap-10 lg:grid-flow-col lg:justify-center">
        <form class="row-start-2 lg:row-start-1 shadow rounded lg:max-w-sm" method="post" action="">
            <div class="py-5 px-4 bg-white space-y-6 sm:p-6">
                <?php if ($has_sent_form === true): ?>
                    <div class="contact__sent">
                        Wiadomość została wysłana
                    </div>
                <?php elseif ($has_sent_form === false): ?>
                    <div class="contact__sent contact__sent--error">
                        Błąd. Wiadomość nie została wysłana.
                    </div>
                <?php endif ?>
                <div class="">
                    <label class="block text-sm text-gray-700 font-medium" for="email">
                        Adres e-mail
                    </label>
                    <input class="mt-1 w-full" id="email" type="email" name="email" autocomplete="email" required>
                </div>
                <div class="">
                    <label class="block text-sm text-gray-700 font-medium" for="email">
                        Wiadomość
                    </label>
                    <textarea class="mt-1 w-full" rows="6" name="message" required></textarea>
                </div>
                <div class="grid grid-flow-col content-start">
                    <input class="consent__checkbox" type="checkbox" required/>
                    <div class="ml-3 text-xs text-gray-600">
                        <?= get_option('igrepti_contact_privacy_policy_text') ?>
                    </div>
                </div>
            </div>
            <div class="py-3 px-4 text-right bg-gray-50 sm:px-6">
                <button class="btn py-2 px-4 text-sm" type="submit" name="contact_form_submit">
                    Wyślij
                </button>
            </div>
        </form>
        <div>
            <h1 class="text-4xl font-black">
                <span class="text-green-600">
                    <?= get_bloginfo('name') ?>
                </span><br>
                <span class="text-gray-900">
                    <?= get_bloginfo('description') ?>
                </span>
            </h1>
            <div class="mt-1 text-sm text-gray-900">
                <?= get_option('woocommerce_store_address') ?>, 
                <?= get_option('woocommerce_store_postcode') ?> 
                <?= get_option('woocommerce_store_city') ?>, 
                <?= WC()->countries->countries[get_option('woocommerce_default_country')] ?>
            </div>
            <div class="mt-6 grid grid-cols-[auto,1fr] gap-3 text-sm text-gray-900">
                <div>
                    Poniedziałek - Piątek:<br>
                    Sobota:<br>
                    Niedziela:
                </div>
                <div>
                    <?= get_option('igrepti_store_open_business_days') ?><br>
                    <?php if (! empty(get_option('igrepti_store_open_sunday'))): ?>
                        <?= get_option('igrepti_store_open_sunday') ?>
                    <?php else: ?>
                        <span class="text-red-600">zamknięte</span>
                    <?php endif ?><br>
                    <?php if (! empty(get_option('igrepti_store_open_sunday'))): ?>
                        <?= get_option('igrepti_store_open_sunday') ?>
                    <?php else: ?>
                        <span class="text-red-600">zamknięte</span>
                    <?php endif ?>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-[140px,1fr] gap-3 text-sm text-gray-900">
                <div>
                    Telefon:<br>
                    Adres e-mail:
                </div>
                <div>
                    <a class="hover:text-green-700 hover:underline" href="tel:<?= get_option('igrepti_store_contact_phone') ?>">
                        <?= get_option('igrepti_store_contact_phone') ?>
                    </a><br>
                    <a class="hover:text-green-700 hover:underline" href="mailto:<?= get_option('igrepti_store_contact_email') ?>">
                        <?= get_option('igrepti_store_contact_email') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>