<ul class="m-0 lg:ml-10 p-0 pt-4 lg:pt-0 border-solid border-gray-200 list-none lg:self-stretch lg:grid lg:grid-flow-col lg:gap-x-10 lg:justify-center lg:items-center lg:border-r">
    <?php foreach ($args['items'] as $item): ?>
        <?php if ($item->children): ?>
            <?php if (reset($item->children)->children): ?>
                <li>
                    <a class="group py-2 lg:py-0 px-3 lg:px-0 grid grid-flow-col justify-start items-center text-base text-gray-700 lg:text-gray-500 hover:text-gray-900 whitespace-nowrap hover:bg-gray-50 lg:hover:bg-transparent" href="#" data-action="toggle" data-target="dropdown-<?= $item->ID ?>">
                        <?= $item->title ?>
                        <i class="material-icons ml-1 text-xl text-gray-400 font-bold leading-none group-hover:text-gray-500">
                            expand_more
                        </i>
                    </a>
                    <div class="hidden ml-6 lg:ml-0 py-3 lg:py-6 bg-white toggled:block lg:absolute lg:top-[calc(100%+1px)] lg:left-0 lg:w-full lg:shadow-lg" id="dropdown-<?= $item->ID ?>">
                        <ul class="m-0 mx-auto max-w-screen-xl p-0 grid lg:grid-flow-col gap-y-6 justify-start list-none sm:px-2 md:px-4">
                            <?php foreach ($item->children as $child): ?>
                                <li class="space-y-2 lg:space-y-4">
                                    <h6 class="px-4 text-green-600 text-xs font-semibold tracking-wide uppercase whitespace-nowrap">
                                        <?= $child->title ?>
                                    </h6>
                                    <div class="grid lg:grid-flow-col">
                                        <?php foreach (array_chunk($child->children, 5, true) as $chunk): ?>
                                            <ul class="m-0 w-[calc((100vw-(100vw-1280px)-2rem)/5)] p-0 list-none">
                                                <?php foreach ($chunk as $grandchild): ?>
                                                    <li>
                                                        <a class="py-2 px-4 grid grid-flow-col items-center justify-start text-base lg:text-sm text-gray-700 whitespace-nowrap rounded-sm hover:text-gray-900 hover:bg-gray-100" href="<?= $grandchild->url ?>">
                                                            <?php $image = get_field('logo_profile', "manufacturer_{$grandchild->object_id}") ?>
                                                            <?php if ($image): ?>
                                                                <img class="mr-2 w-6 h-6 object-cover bg-white border border-gray-100 rounded-sm  overflow-hidden" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                                            <?php endif ?>
                                                            <?= $grandchild->title ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        <?php endforeach ?>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            <?php else: ?>
                <li class="relative">
                    <a class="group py-2 lg:py-0 px-3 lg:px-0 grid grid-flow-col justify-start items-center text-base text-gray-700 lg:text-gray-500 hover:text-gray-900 whitespace-nowrap hover:bg-gray-50 lg:hover:bg-transparent" href="#" data-action="toggle" data-target="dropdown-<?= $item->ID ?>">
                        <?= $item->title ?>
                        <i class="material-icons ml-1 text-xl text-gray-400 font-bold leading-none group-hover:text-gray-500">
                            expand_more
                        </i>
                    </a>
                    <ul class="hidden m-0 p-0 list-none toggled:block lg:absolute lg:top-[calc(100%+23px)] lg:left-[-1rem] lg:min-w-[calc(100%+(2*1rem))] lg:py-2 lg:bg-white lg:border lg:border-solid lg:border-gray-100 lg:shadow-lg lg:rounded" id="dropdown-<?= $item->ID ?>">
                        <?php foreach ($item->children as $child): ?>
                            <li>
                                <a class="block py-2 px-4 text-sm text-gray-700 whitespace-nowrap hover:text-gray-900 hover:bg-gray-100" href="<?= $child->url ?>">
                                    <?= $child->title ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endif ?>
        <?php else: ?>
            <li>
                <a class="block py-2 lg:py-0 px-3 lg:px-0 text-base text-gray-700 lg:text-gray-500 hover:text-gray-900 whitespace-nowrap hover:bg-gray-50 lg:hover:bg-transparent" href="<?= $item->url ?>">
                    <?= $item->title ?>
                </a>
            </li>
        <?php endif ?>
    <?php endforeach ?>
</ul>