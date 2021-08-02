<div class="py-4 px-6 text-gray-500 font-medium bg-white">
    <?= $package_name ?>
</div>
<form class="py-4 px-6 bg-white space-y-2" action="" method="post">
    <?php if ($available_methods): ?>
        <?php foreach ($available_methods as $method): ?>
            <div class="grid grid-flow-col gap-3 justify-start items-center">
                <?php if (1 < count( $available_methods )): ?>
                    <input class="" type="radio" name="<?= "shipping_method[{$index}]" ?>" value="<?= $method->id ?>" onchange="this.form.submit()" <?= checked($method->id, $chosen_method, false) ?>>
                <?php else: ?>
                    <input class="" type="hidden" name="<?= "shipping_method[{$index}]" ?>" value="<?= $method->id ?>">
                <?php endif ?>
                <label class="grid grid-flow-col gap-1 justify-start items-center">
                    <?= wc_cart_totals_shipping_method_label($method) ?>
                    <?php if ($method->cost <= 0 && $method->method_id !== 'local_pickup'): ?>
                        <span class="px-2 inline-block text-xs text-green-800 font-semibold leading-5 bg-green-100 rounded-full">
                            Darmowa
                        </span>
                    <?php endif ?>
                </label>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</form>