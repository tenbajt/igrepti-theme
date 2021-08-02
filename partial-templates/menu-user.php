<ul class="m-0 p-0 mx-3 lg:mr-0 pt-2 pb-6 lg:py-0 grid grid-flow-col gap-x-2 justify-end items-center list-none">
    <?php if ($args['user']): ?>
        <li>
            <a class="material-icons-outlined p-1 text-gray-500 hover:text-black-high" href="<?= $args['account_url'] ?>">
                account_circle
            </a>
        </li>
        <?php if ($args['cart']['count'] > 0): ?>
            <li class="relative">
                <a class="material-icons-outlined p-1 text-gray-500 hover:text-black-high" href="<?= $args['cart']['url'] ?>">
                    shopping_cart
                </a>
                <span class="absolute top-0 right-0 w-3 h-3 grid place-items-center text-[8px] text-white bg-red-600 rounded-sm pointer-events-none">
                    <?= $args['cart']['count'] ?>
                </span>
            </li>
        <?php endif ?>
    <?php else: ?>
        <li>
            <a class="grid content-center text-black-high text-center font-bold uppercase hover:text-green-600" href="<?= $args['account_url'] ?>">
                Hurtownia
            </a>
        </li>
    <?php endif ?>
</ul>