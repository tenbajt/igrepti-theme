<?php
/**
 * Template Name: Strona główna
 * Template Post Type: page
 */
?>

<?php get_header() ?>

<?php if (have_rows('product_catalogs')): ?>
    <div class="pt-4 lg:pt-12 pb-24 xl:pb-32 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-6 xl:px-8">
            <ul class="m-0 p-0 grid grid-cols-1 gap-4 justify-center list-none sm:grid-cols-[repeat(auto-fit,minmax(288px,calc((100%-(2*0.25rem))/2)))] lg:grid-cols-[repeat(auto-fit,minmax(288px,calc((100%-(2*0.25rem))/3)))] sm:gap-1">
            <?php while (have_rows('product_catalogs')): the_row() ?>
                <li class="aspect-w-1 aspect-h-a4 shadow rounded overflow-hidden">
                    <div class="aspect-w-1 aspect-h-1">
                        <img class="object-cover" src="<?= get_sub_field('cover')['url'] ?>" alt="<?= get_sub_field('cover')['alt'] ?>">
                    </div>
                    <div class="top-auto h-auto">
                        <p class="py-5 px-4 text-sm text-gray-100 bg-black bg-opacity-60 sm:p-6">
                            <?= get_sub_field('lead') ?>
                        </p>
                        <div class="py-3 px-4 text-right bg-black bg-opacity-70 sm:px-6">
                            <a class="btn py-2 px-4 text-sm text-gray-700 bg-white hover:bg-gray-200" href="<?= get_sub_field('file') ?>" target="_blank">
                                Podgląd
                            </a>
                            <a class="btn ml-3 py-2 px-4 text-sm" href="<?= get_sub_field('file') ?>" download>
                                Pobierz
                            </a>
                        </div>
                    </div>
                </li>
            <?php endwhile ?>
            </ul>
        </div>
    </div>
<?php endif ?>

<?php get_footer() ?>