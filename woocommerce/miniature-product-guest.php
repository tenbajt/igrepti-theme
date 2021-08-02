<?php

global $product;

if (empty($product) || ! $product->is_visible()) {
	return;
}?>

<li class="bg-white rounded shadow-sm">
    <a class="block aspect-w-1 aspect-h-1" href="<?= get_permalink($product->get_id()) ?>">
        <img class="object-cover" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true) ?>">
        <?php $manufacturer = get_field('manufacturer', $product->get_id()) ?>
        <?php if (is_object($manufacturer)): ?>
            <?php $manufacturer_logo = get_field('logo_profile', "manufacturer_{$manufacturer->term_id}") ?>
            <?php if (is_array($manufacturer_logo) && ! empty($manufacturer_logo)): ?>
                <img class="m-2 w-16 h-16 object-contain object-left-top" src="<?= $manufacturer_logo['url'] ?>" alt="<?= $manufacturer_logo['alt'] ?>">
            <?php endif ?>
        <?php endif ?>
    </a>
    <div class="py-5 px-4 sm:p-6">
        <a class="block text-base text-gray-900 font-medium hover:underline" href="<?= get_permalink($product->get_id()) ?>">
            <?= $product->get_name() ?>
        </a>
    </div>
</li>