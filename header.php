<!doctype html>
    <html <?php language_attributes() ?>>
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
            <?php wp_head(); ?>
        </head>
        <body class="font-inter"> <?php wp_body_open(); ?>
            <header class="relative z-10 h-[68px] shadow">
                <div class="max-w-screen-xl h-full mx-auto px-4 grid grid-cols-2 sm:grid-cols-[auto,1fr] items-center lg:px-6 xl:px-8">
                    <?php get_template_part('partial-templates/branding', null, [
                        'url' => get_site_url(),
                        'logo' => [
                            'url' => wp_get_attachment_url(get_theme_mod('custom_logo')),
                            'alt' => get_post_meta(get_theme_mod('custom_logo'), '_wp_attachment_image_alt', true) ?: get_bloginfo('name', 'display'),
                        ],
                    ])?>

                    <button class="hamburger-spin justify-self-end" data-action="toggle" data-target="nav">
                        <div></div>
                    </button>

                    <div id="nav" class="absolute lg:static top-full left-0 right-0 self-stretch px-1 lg:pr-0 hidden toggled:grid lg:grid lg:grid-cols-[1fr,auto,auto] bg-white shadow-lg lg:shadow-none">

                        <?php get_template_part('partial-templates/menu', 'nav', [
                            'items' => get_menu_items('nav'),
                        ]);

                        get_template_part('partial-templates/menu', 'user', [
                            'user' => is_user_logged_in(),
                            'cart' => [
                                'url' => wc_get_cart_url(),
                                'count' => count(WC()->cart->get_cart()),
                            ],
                            'account_url' => get_permalink(get_option('woocommerce_myaccount_page_id')),
                        ]);

                        get_template_part('partial-templates/form', 'search', [
                            'action' => get_site_url(),
                        ])?>

                    </div>
                </div>
            </header>
            <main>

            
