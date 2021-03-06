<?php $notes = $order->get_customer_order_notes() ?>
<?php if ($notes ): ?>
	<h2>
        <?php esc_html_e( 'Order updates', 'woocommerce' ); ?>
    </h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ($notes as $note): ?>
            <li class="woocommerce-OrderUpdate comment note">
                <div class="woocommerce-OrderUpdate-inner comment_container">
                    <div class="woocommerce-OrderUpdate-text comment-text">
                        <p class="woocommerce-OrderUpdate-meta meta">
                            <?= date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date)) ?>
                        </p>
                        <div class="woocommerce-OrderUpdate-description description">
                            <?= wpautop(wptexturize($note->comment_content)) ?>
                        </div>
                    </div>
                </div>
            </li>
		<?php endforeach ?>
	</ol>
<?php endif ?>

<?php do_action('woocommerce_view_order', $order_id) ?>