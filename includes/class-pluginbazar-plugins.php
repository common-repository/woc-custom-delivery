<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_class_pluginbazar_plugins{
	
	public function __construct(){

		add_action( 'pluginbazar_plugins', array( $this, 'function_pluginbazar_plugins' ) );
	}
	
	public function function_pluginbazar_plugins() {
	?>
		
	<div class="pb_other_pluings">
		<div class="pb_other_plugins_header">Our Other Collections</div>
		
		<div class="pb_plugins_container">
		
		<div class="pb_single_item">
			
			<div class="pb_plugin_header"><a href="https://wordpress.org/plugins/woc-order-alert/">WooCommerce Order Alert</a></div>
			
			<div class="pb_plugin_img"><img src="http://ps.w.org/woc-order-alert/assets/icon-128x128.png"></div>
			
			<div class="pb_plugin_content">You can get alert with strong customizable alarm when an order arrive.</div>
			<div class="pb_purchase_premium"><a href="http://pluginbazar.ml/product/woocommerce-order-alert/ ">Purchase Premium</a></div>
		
		</div>
		
		<div class="pb_single_item">
			
			<div class="pb_plugin_header"><a href="https://wordpress.org/plugins/woc-open-close/">WooCommerce Open Close</a></div>
			
			<div class="pb_plugin_img"><img src="http://ps.w.org/woc-open-close/assets/icon-128x128.png"></div>
			
			<div class="pb_plugin_content">This is a plug-in for a web shop to maintain it's opening and closing time in different days of a week.</div>
			<div class="pb_purchase_premium"><a href="http://pluginbazar.ml/product/woocommerce-open-close/">Purchase Premium</a></div>
		
		</div>
		
		
		
		<div class="pb_single_item">
			
			<div class="pb_plugin_header"><a href="https://wordpress.org/plugins/wp-poll/">WP Poll</a></div>
			
			<div class="pb_plugin_img"><img src="http://ps.w.org/wp-poll/assets/icon-128x128.png"></div>
			
			<div class="pb_plugin_content">It allows user to poll in your website with many awesome feature.</div>
			<div class="pb_purchase_premium"><a href="http://pluginbazar.ml/product/wp-poll/">Purchase Premium</a></div>
		
		</div>
		
		<div class="pb_single_item">
			
			<div class="pb_plugin_header"><a href="https://wordpress.org/plugins/wp-like-dislike/">WP Like Dislike</a></div>
			
			<div class="pb_plugin_img"><img src="http://ps.w.org/wp-like-dislike/assets/icon-128x128.png"></div>
			
			<div class="pb_plugin_content">It allows user to poll in your website with many awesome feature.</div>
			<div class="pb_purchase_premium"><a href="http://pluginbazar.ml/product/wp-like-dislike/">Purchase Premium</a></div>
		
		</div>
		
		</div> <!-- // pb_plugins_container -->
	</div>
		
	<?php
	}
	
	
} new class_class_pluginbazar_plugins();