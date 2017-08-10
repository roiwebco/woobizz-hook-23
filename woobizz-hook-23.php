<?php
/*
Plugin Name: Woobizz Hook 23 
Plugin URI: http://woobizz.com
Description: Remove billing company or any other field on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook23
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook23_load_textdomain' );
function woobizzhook23_load_textdomain() {
  load_plugin_textdomain('woobizzhook23', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_filter( 'woocommerce_checkout_fields' , 'woobizzhook23_remove_checkout_fields' );
	
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook23_admin_notice' );
}
//Hook 23
/** Choose the fields you want to remove and add it on line 40
unset($fields['billing']['billing_first_name']);
unset($fields['billing']['billing_last_name']);
unset($fields['billing']['billing_company']);
unset($fields['billing']['billing_address_1']);
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_city']);
unset($fields['billing']['billing_postcode']);
unset($fields['billing']['billing_country']);
unset($fields['billing']['billing_state']);
unset($fields['billing']['billing_phone']);
unset($fields['order']['order_comments']);
unset($fields['billing']['billing_email']);
unset($fields['account']['account_username']);
unset($fields['account']['account_password']);
unset($fields['account']['account_password-2']);
*/
function woobizzhook23_remove_checkout_fields( $fields ) {
	//Add here the fields you want to remove
	//------------------------------------------------
	unset($fields['billing']['billing_company']);
	//------------------------------------------------
	return $fields;
}
//Hook23 Notice
function woobizzhook23_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 23 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook23' ); ?></p>
    </div>
    <?php
}