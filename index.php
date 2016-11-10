<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/*
Plugin Name: Woocommerce BACS Indonesian Local Bank
Plugin URI: https://github.com/harryagustiana/wc-id-local-bank
Description: Plugin ini merupakan hasil modifikasi dari plugin Epeken JNE versi gratis. Plugin ini mengambil fitur pilihan jenis pembayaran transfer bank lokal pada plugin Epeken JNE versi gratis dan menghilangkan fitur selainnya.
Version: 1.0
Author: Harry Agustiana
Author URI: https://harryagustiana.web.id
License: GPL2
*/

if (in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins'))) || array_key_exists( 'woocommerce/woocommerce.php', maybe_unserialize( get_site_option( 'active_sitewide_plugins') ) )) {

	add_action( 'plugins_loaded', 'bank_mandiri_payment_method_init', 0 );
	function bank_mandiri_payment_method_init(){
		if(!class_exists('Mandiri')){
			include_once('class/mandiri_payment_method.php');
		}
	}
	function add_bank_mandiri_payment_method( $methods ) {
          $methods[] = 'Mandiri';
          return $methods;
    	}	
	add_filter( 'woocommerce_payment_gateways', 'add_bank_mandiri_payment_method' );
	add_action( 'plugins_loaded', 'bank_bca_payment_method_init', 0 );
	function bank_bca_payment_method_init(){
		if(!class_exists('BCA')){
			include_once('class/bca_payment_method.php');
		}
	}
	function add_bank_bca_payment_method( $methods ) {
          $methods[] = 'BCA';
          return $methods;
    	}	
	add_filter( 'woocommerce_payment_gateways', 'add_bank_bca_payment_method' );
        add_action( 'plugins_loaded', 'bank_bni_payment_method_init', 0 );
	function bank_bni_payment_method_init(){
		if(!class_exists('BNI')){
			include_once('class/bni_payment_method.php');
		}
	}
	function add_bank_bni_payment_method( $methods ) {
          $methods[] = 'BNI';
          return $methods;
    	}	
	add_filter( 'woocommerce_payment_gateways', 'add_bank_bni_payment_method' );

} // End checking if woocommerce is installed.

function redirect_to_front_page() {
  global $redirect_to;
  if (!isset($_GET['redirect_to'])) {
   $redirect_to = get_option('siteurl');
  }
}
add_action('login_form', 'redirect_to_front_page');

