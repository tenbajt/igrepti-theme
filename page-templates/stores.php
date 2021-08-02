<?php
/**
 * Template Name: Sklepy
 * Template Post Type: page
 */
?>

<?php get_header() ?>

<div class="pt-4 md:pt-6 xl:pt-8 pb-24 xl:pb-32">
    <div class="max-w-screen-xl mx-auto px-4 lg:px-6 xl:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8 items-center">
            <div class="max-w-screen-sm mt-12 lg:mt-0 row-start-2 lg:row-start-1">
                <h1 class="text-4xl md:text-5xl text-gray-900 font-extrabold tracking-tight">
                    <?= get_the_title() ?>
                </h1>
                <p class="mt-5 text-base md:text-lg text-gray-700 leading-relaxed">
                    <?= get_field('masthead')['lead'] ?>
                </p>
                <a class="btn w-full md:w-auto mt-8 py-3 md:py-4 px-8 md:px-10 text-base md:text-lg font-medium" href="<?= get_field('masthead')['file'] ?>" download>
                    Dołącz do programu
                </a>
            </div>
            <img src="<?= get_field('masthead')['image']['url'] ?>" alt="<?= get_field('masthead')['image']['alt'] ?>">
        </div>
    </div>
</div>
<?php

$stores_query_args = [
    'post_type' => 'store',
    'posts_per_page' => -1,
];

if (isset($_GET['miasto'])) {
    $stores_query_args['tax_query'] = [
        [
            'field' => 'slug',
            'terms' => $_GET['miasto'],
            'taxonomy' => 'city',
        ]
    ];
}

$stores = new WP_Query($stores_query_args); ?>

<?php if ($stores->have_posts()): ?>
    <div class="py-24 xl:py-32 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-6 xl:px-8">
            <form class="mb-4 grid justify-end" method="get">
                <select name="miasto" onchange="this.form.submit();">
                    <option value="">Wszystkie</option>
                    <?php foreach (get_terms(['taxonomy' => 'city']) as $term): ?>
                        <option value="<?= $term->slug ?>" <?= isset($_GET['miasto']) && $_GET['miasto'] == $term->slug ? 'selected' : '' ?>><?= $term->name ?></option>
                    <?php endforeach ?>
                </select>
            </form>
            <ul class="m-0 p-0 grid grid-cols-1 lg:grid-cols-2 gap-2 list-none">
                <?php while ($stores->have_posts()): $stores->the_post() ?>
                    <li class="py-5 px-4 bg-white shadow rounded overflow-hidden space-y-5 sm:p-6 sm:space-y-6">
                        <div>
                            <h2 class="text-lg text-gray-900 font-medium">
                                <?= get_the_title() ?>
                            </h2>
                            <div class="text-sm text-gray-900">
                                <?= get_field('address')['street'] ?>,
                                <?= get_field('address')['postcode'] ?> <?= get_field('address')['city']->name ?>
                            </div>
                        </div>
                        <div class="grid grid-cols-[auto,1fr] gap-3 text-sm text-gray-900">
                            <div>
                                Poniedziałek - Piątek:<br>
                                Sobota:<br>
                                Niedziela:
                            </div>
                            <div>
                                <?= get_field('open')['business'] ?>
                                <br>
                                <?php if (! empty(get_field('open')['saturday'])): ?>
                                    <?= get_field('open')['saturday'] ?>
                                <?php else: ?>
                                    <span class="text-red-600">nieczynne</span>
                                <?php endif ?>
                                <br>
                                <?php if (! empty(get_field('open')['sunday'])): ?>
                                    <?= get_field('open')['sunday'] ?>
                                <?php else: ?>
                                    <span class="text-red-600">nieczynne</span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="grid grid-cols-[140px,1fr] gap-3 text-sm text-gray-900">
                            <div>
                                Telefon:<br>
                                Adres e-mail:<br>
                                Strona internetowa:<br>
                            </div>
                            <div>
                                <?= get_field('contact')['phone'] ?><br>
                                <?= get_field('contact')['email'] ?>
                                <?php if (! empty(get_field('contact')['website'])): ?>
                                    <br><?= get_field('contact')['website'] ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="h-64 leading-none">
                            <iframe src="<?= get_field('address')['map'] ?>" width="100%" height="100%" frameborder="0" style="display:block;border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <div class="relative border-b border-solid border-gray-200">
                            <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 px-2 text-sm text-gray-500 bg-white">
                                Skontaktuj się
                            </span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <a class="material-icons btn py-2 px-4 text-2xl text-gray-500 leading-none bg-white border-gray-300 shadow-sm hover:bg-gray-50" href="tel:<?= get_field('contact')['phone'] ?>">
                                phone
                            </a>
                            <a class="material-icons btn py-2 px-4 text-2xl text-gray-500 leading-none bg-white border-gray-300 shadow-sm hover:bg-gray-50" href="mailto:<?= get_field('contact')['email'] ?>">
                                mail
                            </a>
                            <?php if (! empty(get_field('contact')['website'])): ?>
                                <a class="material-icons btn py-2 px-4 text-2xl text-gray-500 leading-none bg-white border-gray-300 shadow-sm hover:bg-gray-50" href="<?= get_field('contact')['website'] ?>" target="_blank">
                                    language
                                </a>
                            <?php endif ?>
                        </div>
                    </li>
                <?php endwhile ?>
            </ul>
        </div>
    </div>
<?php endif ?>

<?php wp_reset_postdata() ?>

<?php get_footer() ?>