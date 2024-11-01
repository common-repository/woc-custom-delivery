<?php
/*
	Plugin Name: WooCommerce Custom Delivery
	Plugin URI: http://pluginbazar.ml/blog/woc-open-close/
	Description: This plugin allows your customers to choose custom delivery date or time.
	Version: 1.0.
	Author: pluginbazar
	Author URI: http://pluginbazar.ml/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class WooCommerceCustomDelivery{
	
	public function __construct(){
	
		define('wcd_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
		define('wcd_plugin_dir', plugin_dir_path( __FILE__ ) );
		define('wcd_plugin_name', 'Woocommerce Open Close' );
		define('wcd_plugin_version', '2.4' );
		define('wcd_video_code', 'uixkTmKrQBA' );
		define('wcd_contact_url', 'http://pluginbazar.ml/contact/' );
		define('WOCTEXTDOMAIN', 'woc-custom-delivery' );
		

		require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');

		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-types.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-settings.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-column.php');
		
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-pluginbazar-plugins.php');		
		
		
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
		add_action( 'wp_enqueue_scripts', array( $this, 'wcd_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'wcd_admin_scripts' ) );
		
	}
	
	public function wcd_front_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_style('wcd_style', wcd_plugin_url.'resources/front/css/style.css');
	}

	public function wcd_admin_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp_poll_color_picker', plugins_url('/resources/back/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
						
		wp_enqueue_script('wcd_admin_js', plugins_url( '/resources/back/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'wcd_admin_js', 'wcd_ajax', array( 'wcd_ajaxurl' => admin_url( 'admin-ajax.php')));
	
		
		wp_enqueue_style('wcd_admin_style', wcd_plugin_url.'resources/back/css/style.css');
		
		//both
		wp_enqueue_style('font-awesome', wcd_plugin_url.'resources/both/css/font-awesome.css');
		
		
		//BackAdmin
		wp_enqueue_style('BackAdmin', wcd_plugin_url.'resources/BackAdmin/BackAdmin.css');		
		wp_enqueue_script('BackAdmin', plugins_url( 'resources/BackAdmin/BackAdmin.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('jquery-time-picker' ,  wcd_plugin_url. '/resources/BackAdmin/jquery.timepicker.js',  array('jquery' ));	

	}
} new WooCommerceCustomDelivery();

