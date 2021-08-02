<?php
/**
 * Template Name: Reset password form
 * Template Post Type: page
 * 
 * @link https://tenbajt.pl
 * 
 * @package igrepti
 * @since   1.0.0
 */
/*namespace App;

use Timber;

$context = Timber::context();

if ( isset( $_POST[ 'password_1' ] ) ) {
    $password_1 = wc_clean( $_POST[ 'password_1' ] );
    $password_2 = wc_clean( $_POST[ 'password_2' ] );
    if ( $password_1 !== $password_2 ) {
        $context[ 'form_error_message' ] = 'Hasła muszą być takie same.';
    }
}
if ( isset( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ] ) && 0 < strpos( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ], ':' ) ) {
    list( $rp_id, $rp_key ) = array_map( 'wc_clean', explode( ':', wp_unslash( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ] ), 2 ) );
    $userdata               = get_userdata( absint( $rp_id ) );
    $rp_login               = $userdata ? $userdata->user_login : '';
    $user                   = check_password_reset_key( $key, $login );

    $context[ 'key' ] = $rp_key;
    $context[ 'login' ] = $rp_login;
}

Timber::render( 'woocommerce\myaccount\form-lost-password.twig', $context );*/?>

<div class="px-4 md:px-6">
    <div class="max-w-screen-xl mx-auto pt-32 pb-48">
        <h2 class="mb-1 text-4xl text-center font-bold">
            Ustaw nowe hasło
        </h2>
        {% if form_error_message %}
            <div class="mt-2 text-red-600 text-sm text-center">
                {{form_error_message}}
            </div>
        {% endif %}
        <form class="max-w-xs mx-auto mt-8 text-center" method="post">
            <div class="grid grid-cols-1 gap-3">
                <input type="password" name="password_1" autocomplete="new-password">
                <input type="password" name="password_2" autocomplete="new-password">
                <input type="hidden" name="reset_key" value="{{key}}">
                <input type="hidden" name="reset_login" value="{{login}}">
                <input type="hidden" name="wc_reset_password" value="true">
            </div>
            <button class="btn mt-6" type="submit" value="Zapisz">
                Zapisz
            </button>
            {{function( 'wp_nonce_field', 'lost_password', 'woocommerce-lost-password-nonce' )}}
        </form>
    </div>
</div>

