<?php
/**
|--------------------------------------------------------------------------
| Fires after the theme is loaded.
|--------------------------------------------------------------------------
|
| This hook is called during each page load, after the theme is initialized.
| It is generally used to perform basic setup, registration, and init
| actions for a theme.
|
| @return void
|
| @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
*/

add_action('after_setup_theme', function (): void {
    /**
     * Register menu locations.
     * 
     * @param  array  $locations
     * @return void
     * 
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'nav' => 'Nawigacja',
        'footer_1' => 'Stopka',
    ]);
});

/**
|--------------------------------------------------------------------------
| Fires when front-end scripts and styles are enqueued.
|--------------------------------------------------------------------------
|
| The proper hook to use when enqueuing scripts and styles that are meant
| to appear on the front end. Despite the name, it is used for enqueuing
| both scripts and styles.
|
| @return void
|
| @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
*/

add_action('wp_enqueue_scripts', function (): void {
    /**
     * Enqueue a material icons CSS stylesheet.
     * 
     * @param  string  $id
     * @param  string  $source
     * @param  string[]  $dependencies
     * @param  string|bool|null  $version
     * @param  string  $media
     * @return void
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
     */
    wp_enqueue_style(
        'igrepti-theme-material-icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined',
        [],
        null
    );

    /**
     * Enqueue a roboto font CSS stylesheet.
     * 
     * @param  string  $id
     * @param  string  $source
     * @param  string[]  $dependencies
     * @param  string|bool|null  $version
     * @param  string  $media
     * @return void
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
     */
    wp_enqueue_style(
        'igrepti-theme-roboto-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap',
        [],
        null
    );

    /**
     * Return URL to child theme's root directory.
     * 
     * @return string
     * 
     * @link https://developer.wordpress.org/reference/functions/get_stylesheet_directory_uri/
     */
    $theme_root_dir_url = get_stylesheet_directory_uri();

    /**
     * Enqueue a global theme CSS stylesheet.
     * 
     * @param  string  $id
     * @param  string  $source
     * @param  string[]  $dependencies
     * @param  string|bool|null  $version
     * @param  string  $media
     * @return void
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
     */
    wp_enqueue_style(
        'igrepti-theme',
        "{$theme_root_dir_url}/dist/css/theme.css",
        [],
        '1.0.0'
    );

    /**
     * Enqueue a global theme JS script.
     * 
     * @param  string  $id
     * @param  string  $source
     * @param  string[]  $dependencies
     * @param  string|bool|null  $version
     * @param  string  $in_footer
     * @return void
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
     */
    wp_enqueue_script(
        'igrepti-theme',
        "{$theme_root_dir_url}/dist/js/theme.js",
        [],
        '1.0.0',
        true
    );
});

/**
|--------------------------------------------------------------------------
| Filters WooCommerce's CSS styles.
|--------------------------------------------------------------------------
|
| @return array
|
| @link https://woocommerce.wp-a2z.org/oik_api/wc_frontend_scriptsget_styles/
*/

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
|--------------------------------------------------------------------------
| Filters WooCommerce's user account navigation items.
|--------------------------------------------------------------------------
|
| @return array
|
| @link https://woocommerce.wp-a2z.org/oik_api/wc_get_account_menu_items/
*/

add_filter('woocommerce_account_menu_items', function (array $items): array {
    unset($items['dashboard'], $items['downloads'], $items['edit-address'], $items['customer-logout']);

    if (! current_user_can('order_products')) {
        unset($items['orders'], $items['payment-methods']);
    }

    $items['edit-account'] = 'Dane firmy';

    return $items;
});

/**
|--------------------------------------------------------------------------
| Fires before determining which template to load.
|--------------------------------------------------------------------------
|
| This action hook executes just before WordPress determines which template
| page to load. It is a good hook to use if you need to do a redirect with
| full knowledge of the content that has been queried.
|
| @return void
|
| @link https://developer.wordpress.org/reference/hooks/template_redirect/
*/

add_action('template_redirect', function (): void {
    global $wp;

    if (! empty($wp->query_vars) && isset($_POST['save_address'])) {
        $wp->query_vars['edit-address'] = 'przesylki';
    }

    // Check if 'My Account Dashboard' page has been requested.
    if (! empty($wp->query_vars) && in_array('konto', $wp->query_vars) && array_key_exists('page', $wp->query_vars)) {
        if (current_user_can('order_products')) {
            /**
             * Redirect to other page.
             * 
             * @param  string  $url
             * @param  int  $code
             * @param  string  $name
             * 
             * @return bool
             * 
             * @link https://developer.wordpress.org/reference/functions/wp_redirect/
             */
            if (wp_redirect(wc_get_account_endpoint_url('orders'), 301)) {
                exit;
            }
        } else {
            /**
             * Redirect to other page.
             * 
             * @param  string  $url
             * @param  int  $code
             * @param  string  $name
             * 
             * @return bool
             * 
             * @link https://developer.wordpress.org/reference/functions/wp_redirect/
             */
            if (wp_redirect(wc_get_account_endpoint_url('edit-account'), 301)) {
                exit;
            }
        }
    }

    if (! empty($_POST['shipping_method'])) {
        $chosen_shipping_methods = WC()->session->get('chosen_shipping_methods');
		$posted_shipping_methods = isset($_POST['shipping_method']) ? wc_clean(wp_unslash($_POST['shipping_method'])) : array();

        if (is_array($posted_shipping_methods)) {
			foreach ($posted_shipping_methods as $i => $value) {
				$chosen_shipping_methods[$i] = $value;
			}
		}

		WC()->session->set('chosen_shipping_methods', $chosen_shipping_methods);

        WC()->cart->calculate_totals();
    }
}, 9);

/**
|--------------------------------------------------------------------------
| Filters edit-address form's fields.
|--------------------------------------------------------------------------
|
| This is the proper hook to modify edit-address form's fields like
| changing the required status.
|
| @param  array  $fields
| @return array
|
| @link https://woocommerce.wp-a2z.org/oik_api/wc_countriesget_default_address_fields/
*/

add_filter('woocommerce_default_address_fields', function (array $fields): array {
    // Remove unused address fields.
    unset($fields['first_name'], $fields['last_name'], $fields['state']);

    return $fields;
});

/**
|--------------------------------------------------------------------------
| Filters edit-account form's required fields.
|--------------------------------------------------------------------------
|
| @param  array  $fields
| @return array
|
| @link https://woocommerce.wp-a2z.org/oik_api/wc_form_handlersave_account_details/
*/

add_filter('woocommerce_save_account_details_required_fields', '__return_empty_array');

/**
|--------------------------------------------------------------------------
| Fires after edit-account form submision.
|--------------------------------------------------------------------------
|
| This is the proper hook to save custom data from edit-account form.
|
| @param  int  $user_id
| @return void
|
| @link https://woocommerce.wp-a2z.org/oik_api/wc_form_handlersave_account_details/
*/

add_action('woocommerce_save_account_details', function (int $user_id): void {
    if (isset($_POST['billing_company'])) {
        update_user_meta($user_id, 'billing_company', wc_clean(wp_unslash($_POST['billing_company'])));
    }

    if (isset($_POST['billing_nip'])) {
        update_user_meta($user_id, 'billing_nip', wc_clean(wp_unslash($_POST['billing_nip'])));
    }

    if (isset($_POST['billing_address_1'])) {
        update_user_meta($user_id, 'billing_address_1', wc_clean(wp_unslash($_POST['billing_address_1'])));
    }

    if (isset($_POST['billing_city'])) {
        update_user_meta($user_id, 'billing_city', wc_clean(wp_unslash($_POST['billing_city'])));
    }

    if (isset($_POST['billing_postcode'])) {
        update_user_meta($user_id, 'billing_postcode', wc_clean(wp_unslash($_POST['billing_postcode'])));
    }

    if (isset($_POST['billing_phone'])) {
        update_user_meta( $user_id, 'billing_phone', wc_clean(wp_unslash($_POST['billing_phone'])));
    }
});

/**
 * Return the menu object for the given location.
 * 
 * @param  string  $location
 * @return object|null
 */
function get_menu(string $location) {
    static $resolved = [];

    // If menu has been already resolved just return it.
    if (isset($resolved[$location])) {
        return $resolved[$location];
    }

    /**
     * Return the menus IDs for assigned to all registered locations.
     * 
     * @return array
     * 
     * @link https://developer.wordpress.org/reference/functions/get_nav_menu_locations/
     */
    $locations = get_nav_menu_locations();

    // Bail early if there are no registered locations
    // or there isn't a menu assigned to the given location.
    if (empty($locations) || ! isset($locations[$location])) return null;

    /**
     * Return the menu object.
     * 
     * @param  WP_Term|int|string  $menu
     * @return WP_Term|bool
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_get_nav_menu_object/
     */
    return $resolved[$location] = wp_get_nav_menu_object($locations[$location]);
}

/**
 * Return the menu items for the given menu location.
 * 
 * @param  string  $location
 * @return array
 */
function get_menu_items(string $location): array {
    $menu = get_menu($location);

    // Bail early if there isn't a menu assigned to the given location.
    if (is_null($menu)) return [];

    /**
     * Return the post objects for the given menu ID.
     * 
     * @param  WP_Term|int|string  $menu
     * @param  array  $args
     * @return array|false
     * 
     * @link https://developer.wordpress.org/reference/functions/wp_get_nav_menu_items/
     */
    $items = wp_get_nav_menu_items($menu);

    // Baily early if the menu items are not valid.
    if (! $items) return [];

    // Make an array of items with item's ID as key.
    $items = array_combine(array_map(fn(WP_Post $item) => $item->ID, $items), $items);

    // Assign children items to their parents.
    foreach ($items as $item) {
        // If item has parent add it as a child.
        if ($item->menu_item_parent) {
            // Get the parent WP_Post object.
            $parent = $items[$item->menu_item_parent];

            // If parent has no children make them.
            if (! $parent->children) {
                $parent->children = [];
            }

            // Add item as a parent's child.
            $parent->children[] = $item;
        }
    }

    // Remove items that has a parent but no children,
    // as they were already assigned to their parents.
    foreach ($items as $id => $item) {
        if ($item->menu_item_parent) {
            unset($items[$id]);
        }
    }

    return $items;
}

add_filter( 'loop_shop_per_page', function() {
    return 1000;
}, 20 );








