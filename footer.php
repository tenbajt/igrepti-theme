            </main>
            <footer class="pt-24 xl:pt-32 pb-12 bg-black">
                <div class="max-w-screen-xl mx-auto px-4 lg:px-6 xl:px-8 divide-y divide-white divide-opacity-[0.11]">
                    <ul class="m-0 p-0 pb-14 grid text-sm font-medium list-none sm:pb-20 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <li class="space-y-5">
                            <h6 class="text-xs text-gray-100 font-semibold tracking-wide uppercase">
                                <?= get_menu('footer_1')->name ?>
                            </h6>
                            <ul class="m-0 mt-4 p-0 space-y-4 list-none">
                                <?php foreach (get_menu_items('footer_1') as $item): ?>
                                    <li>
                                        <a class="text-gray-500 hover:text-gray-100" href="<?= get_field('file', $item) ?>" target="_blank">
                                            <?= $item->title ?>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    </ul>
                    <div class="pt-10 sm:pt-12">
                        <p class="text-xs text-gray-500">
                            &copy; 2021 <?php bloginfo('name') ?> | Wszystkie prawa zastrzeżone.
                        </p>
                    </div>
                </div>
            </footer>
            <?php wp_footer() ?>
        </div>
    </body>
</html>