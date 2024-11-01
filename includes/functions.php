<?php
/*
* @Author 		pluginbazar
* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	add_action( 'admin_notices', 'wcd_err_notice' );
	function wcd_err_notice() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) || class_exists( 'WooCommerce' ) ) 
		{}
		else 
		{
			?><div class="error"><?php
			?><p><?php _e( 'Error: Woocommerce is Not Ready !' , 'woc' ); ?></p><?php
			?></div><?php
		}
			
		$wcd_active_set = get_option('wcd_active_set');
		if ( empty($wcd_active_set) )
		{
			?><div class="error"><?php
			?><p><?php _e( 'Error: No Active Hour Set !' , 'woc' ); ?></p><?php
			?></div><?php
		}
	}
	
	add_action( 'init', 'wcd_cart_button' );
	function wcd_cart_button(){ 
		
		$wcd_active_set = get_option( 'wcd_active_set', '' );
		
		if( !empty( $wcd_active_set )  ) {
			
			add_action( 'woocommerce_after_order_notes', 'wcd_delivery_wrap_function' );
			
		}
		
	}	

	function wcd_delivery_wrap_function( $checkout ) {
		
		$zone	=  get_option('timezone_string');
		date_default_timezone_set("$zone");	
		$time = date('H:i');
		
		echo '<div id="wcd_delivery_wrap">';
		echo '<h3>' . __('Estimated Delivery Time', WOCTEXTDOMAIN) . '</h3>';
		
		$set_id 			= get_option( 'wcd_active_set', '' );
		$current_day 		= strtolower(date('D'));
		$delivery_hours_meta= get_post_meta( $set_id, 'delivery_hours_meta', true );
		$delivery_message	= isset( $delivery_hours_meta['delivery_message'] ) ? __( $delivery_hours_meta['delivery_message'], WOCTEXTDOMAIN )  : __( 'We will ship your items on the time given below.', WOCTEXTDOMAIN );
		$delivery_hours		= isset( $delivery_hours_meta[$current_day] ) ? $delivery_hours_meta[$current_day] : '';
		
		echo '<p class="wcd_delivery_message">'.$delivery_message.'</p>';

		foreach( $delivery_hours as $hour_id => $hour_details ) {
			
			$disabled = 'disabled';
			if( $time <= $hour_details['close'] ) $disabled = '';
			
			$shipping_time = __( 'From '. $hour_details['open'] .' to '. $hour_details['close'], WOCTEXTDOMAIN );
			
			echo '<div class="wcd_delivery_single '.$disabled.'">';
			echo '<input '.$disabled.' type="radio" name="wcd_shipping_time" value="'.$shipping_time.'" id="'.$hour_id.'" >';
			echo '<label for="'.$hour_id.'">'. $shipping_time .'</label></div>';
			
		}
		
		echo '</div>';	
	}

	
	//Update the order meta with field value
	add_action( 'woocommerce_checkout_update_order_meta', 'wcd_shipping_time_update_order_meta' );

	function wcd_shipping_time_update_order_meta( $order_id ) {
		if ( ! empty( $_POST['wcd_shipping_time'] ) ) {
			update_post_meta( $order_id, 'wcd_shipping_time', sanitize_text_field( $_POST['wcd_shipping_time'] ) );
		}
	}

	// Display field value on the order edit page
	add_action( 'woocommerce_admin_order_data_after_billing_address', 'wcd_shipping_time_display_admin_order_meta', 10, 1 );

	function wcd_shipping_time_display_admin_order_meta($order){
		echo '<p><strong>'.__('Estimated Shipping Time', WOCTEXTDOMAIN ).':</strong> ' . get_post_meta( $order->id, 'wcd_shipping_time', true ) . '</p>';
	}

	//Process the checkout
	add_action('woocommerce_checkout_process', 'wcd_shipping_time_field_process');

	function wcd_shipping_time_field_process() {
		
		$wcd_delivery_required 	= get_option( 'wcd_delivery_required', 'yes' );

		if ( $wcd_delivery_required == 'yes' && ! $_POST['wcd_shipping_time'] ) 
			wc_add_notice( __( 'You must select a delivery time' ), 'error' );
	}

	add_filter('woocommerce_email_order_meta_keys', 'wcd_shipping_time_order_meta_keys');

	function wcd_shipping_time_order_meta_keys( $keys ) {
		 $keys[] = 'wcd_shipping_time';
		 return $keys;
	}










	

	
	function wcd_get_hour_sets() {
		$array_sets = array();
		$array_sets[''] = 'None';
		
		$wp_query = new WP_Query(
			array (
				'post_type' => 'delivery_hour',
				'post_status' => 'publish',
			) 
		);
				
		if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	
			
			$title = get_the_title();
			
			if( empty( $title ) ) $array_sets[get_the_ID()] = '#'.get_the_ID();
			else $array_sets[get_the_ID()] = get_the_title();
		
		endwhile;
		endif;
		
		return $array_sets;
	}

	function wcd_add_more_time_slot(){
	
		$day_key = sanitize_text_field( $_POST['day_key'] );
		
		echo '
		<li class="wcd_single_schedule" id="'.time().'">
			<label for="wcd_mon_open_'.time().'"><i class="fa fa-angle-up"></i> Opening Time </label>
			<input type="text" name="delivery_hours_meta['.$day_key.']['.time().'][open]" id="wcd_'.$day_key.'_open_'.time().'" placeholder="Click to set time"/>
							
			<label for="wcd_'.$day_key.'_close_'.time().'"><i class="fa fa-angle-down"></i> Closing Time </label>
			<input type="text" name="delivery_hours_meta['.$day_key.']['.time().'][close]" id="wcd_'.$day_key.'_close_'.time().'" placeholder="Click to set time"/>
							
			<div class="wcd_delete_single_schedule" row_id="'.time().'"><i class="fa fa-times-circle-o"></i></div>
			<div class="wcd_single_sorter"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</li>
		<script>
			jQuery("#wcd_'.$day_key.'_open_'.time().'").timepicker({ "timeFormat": "H:i" }); 
			jQuery("#wcd_'.$day_key.'_close_'.time().'").timepicker({ "timeFormat": "H:i" }); 
		</script> ';

		die();
	}
	
	add_action('wp_ajax_wcd_add_more_time_slot', 'wcd_add_more_time_slot');
	add_action('wp_ajax_nopriv_wcd_add_more_time_slot', 'wcd_add_more_time_slot');
	
