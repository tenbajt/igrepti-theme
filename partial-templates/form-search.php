<form class="relative row-start-1 lg:row-start-auto self-center mx-3 lg:mr-0" action="<?= $args['action'] ?>" method="get" role="search">
    <input type="hidden" name="post_type" value="product">
    <input class="w-full lg:max-w-[16rem] pl-[42px]" type="search" name="s" placeholder="Szukaj produktów"></input>
    <button class="absolute top-0 left-0 bottom-0 w-[42px] text-gray-500 hover:text-black material-icons" type="submit" value="Szukaj">
        search
    </button>
</form>