<form class="relative" method="get">
    <input type="hidden" name="paged" value="1">
    <a class="material-icons scale-x-[-1] p-1 text-3xl text-gray-500 hover:text-gray-900" href="#" data-action="toggle" data-target="orderby-dropdown">
        sort
    </a>
    <div class="absolute top-full right-0 z-10 py-2 hidden bg-white border border-gray-100 shadow-lg rounded toggled:block" id="orderby-dropdown">
        <ul class="m-0 p-0 list-none">
            <?php foreach ($catalog_orderby_options as $id => $name): ?>
                <li>
                    <label class="py-2 px-4 grid grid-flow-col justify-start items-center text-sm text-gray-700 whitespace-nowrap rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100" for="orderby-<?= $id ?>">
                        <input class="mr-3" id="orderby-<?= $id ?>"  type="radio" name="orderby" value="<?= $id ?>" onchange="this.form.submit()" <?= checked($orderby, $id, false) ?>>
                        <?= $name ?>
                    </label>
                </li>
            <?php endforeach ?>
        </ul>
        <?php if (! is_string(get_query_var('manufacturer', []))): ?>
            <div class="py-2">
                <div class="border-t border-gray-200"></div>
            </div>
            <ul class="m-0 p-0 list-none">
                <?php foreach (get_terms(['taxonomy' => 'manufacturer']) as $manufacturer): ?>
                    <li>
                        <label class="py-2 px-4 grid grid-flow-col justify-start items-center text-sm text-gray-700 whitespace-nowrap rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                            <input class="mr-3" id="manufacturer-<?= $manufacturer->term_id ?>" type="checkbox" name="<?= $manufacturer->taxonomy ?>[]" value="<?= $manufacturer->slug ?>" onchange="this.form.submit()" <?= in_array($manufacturer->slug, get_query_var('manufacturer', [])) ? 'checked' : '' ?>>
                            <?= $manufacturer->name ?>
                        </label>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
</form>