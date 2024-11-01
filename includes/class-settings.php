<?php

/*
* @Author 		pluginbazar
* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wcd_settings{
	
	public function __construct(){
		
		add_action('admin_menu', array( $this, 'wcd_menu_init' ));
		
	}

	public function wcd_menu_settings(){
		include('menu/settings.php');	
	}
	
	public function wcd_menu_faq(){
		include('menu/faq.php');	
	}
	
	public function wcd_delivery_time(){
		include('menu/delivery.php');	
	}
	
	

	public function wcd_menu_init() {
		add_submenu_page('edit.php?post_type=delivery_hour', __('Settings',WOCTEXTDOMAIN), __('Settings',WOCTEXTDOMAIN), 'manage_options', 'wcd_menu_settings', array( $this, 'wcd_menu_settings' ));	
		// add_submenu_page('edit.php?post_type=delivery_hour', __('Delivery',WOCTEXTDOMAIN), __('Delivery',WOCTEXTDOMAIN), 'manage_options', 'wcd_delivery_time', array( $this, 'wcd_delivery_time' ));	
		add_submenu_page('edit.php?post_type=delivery_hour', __('FAQ',WOCTEXTDOMAIN), __('FAQ',WOCTEXTDOMAIN), 'manage_options', 'wcd_menu_faq', array( $this, 'wcd_menu_faq' ));	
	}
	
	
} new class_wcd_settings();