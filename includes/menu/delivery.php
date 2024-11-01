<?php	


/*
* @Author 		pluginbazar
* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	global $current_user;
	
	$wcd_contact_name 		= isset( $_POST['wcd_contact_name'] ) ? $_POST['wcd_contact_name'] : '';
	$wcd_contact_email 		= isset( $_POST['wcd_contact_email'] ) ? $_POST['wcd_contact_email'] : '';
	$wcd_contact_subject 	= isset( $_POST['wcd_contact_subject'] ) ? $_POST['wcd_contact_subject'] : '';
	$wcd_contact_message 	= isset( $_POST['wcd_contact_message'] ) ? $_POST['wcd_contact_message'] : '';
	
	$wcd_contact_name		= empty( $wcd_contact_name ) ? $current_user->user_firstname : $wcd_contact_name;
	$wcd_contact_name		= empty( $wcd_contact_name ) ? $current_user->user_login : $wcd_contact_name;
	$wcd_contact_email		= empty( $wcd_contact_email ) ? $current_user->user_email : $wcd_contact_email;
	
	// echo '<pre>'; print_r( $_POST );  echo '</pre>';
	
	if( $_POST ) {
		
		$var = wp_mail( 'pluginbazar@gmail.com', $wcd_contact_subject, $wcd_contact_message );
		if( $var ) $wcd_contact_name = $wcd_contact_email = $wcd_contact_subject = $wcd_contact_message = '';
	}
	
?>
<div class="wcd_delivery_time_wrap">
	<h2>WooCommerce Open Close - Delivery Time</h2>
	
	<div class="wcd_delivery_container">
		
		<div class="add_new_delibery_time">Add New </div>

		<div class="single_delivery" id="1474570020">
			<label for="wcd_mon_open_1474570020"><i class="fa fa-angle-up"></i> Opening Time </label>
			<input type="text" name="delivery_hours_meta[mon][1474570020][open]" value="01:00" id="wcd_mon_open_1474570020" placeholder="Click to set time" class="ui-timepicker-input" autocomplete="off">
							
			<label for="wcd_mon_close_1474570020"><i class="fa fa-angle-down"></i> Closing Time </label>
			<input type="text" name="delivery_hours_meta[mon][1474570020][close]" value="01:30" id="wcd_mon_close_1474570020" placeholder="Click to set time" class="ui-timepicker-input" autocomplete="off">
							
			<div class="wcd_delete_single_schedule" row_id="1474570020"><i class="fa fa-times-circle-o"></i></div>
			<div class="wcd_single_sorter ui-sortable-handle"><i class="fa fa-sort" aria-hidden="true"></i></div>
						
		</div>
	
	
	</div>
	
</div>
