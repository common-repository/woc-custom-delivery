<?php

/*
* @Author 		pluginbazar
* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wcd_post_types{
	
	public function __construct(){
		add_action( 'init', array( $this, 'wcd_posttype_delivery_hour' ), 0 );
	}
	
	public function wcd_posttype_delivery_hour(){
		if ( post_type_exists( "delivery_hour" ) )
		return;

		$singular  = __( 'Delivery Hour', WOCTEXTDOMAIN );
		$plural    = __( 'Delivery Hours', WOCTEXTDOMAIN );
	 
	 
		register_post_type( "delivery_hour",
			apply_filters( "wcd_posttype_delivery_hour", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, WOCTEXTDOMAIN ),
					'all_items'             => sprintf( __( 'All %s', WOCTEXTDOMAIN ), $plural ),
					'add_new' 				=> __( 'Add New', WOCTEXTDOMAIN ),
					'add_new_item' 			=> sprintf( __( 'Add %s', WOCTEXTDOMAIN ), $singular ),
					'edit' 					=> __( 'Edit', WOCTEXTDOMAIN ),
					'edit_item' 			=> sprintf( __( 'Edit %s', WOCTEXTDOMAIN ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', WOCTEXTDOMAIN ), $singular ),
					'view' 					=> sprintf( __( 'View %s', WOCTEXTDOMAIN ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', WOCTEXTDOMAIN ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', WOCTEXTDOMAIN ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', WOCTEXTDOMAIN ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', WOCTEXTDOMAIN ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', WOCTEXTDOMAIN ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', WOCTEXTDOMAIN ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array(''),
				'show_in_nav_menus' 	=> true,
				'menu_icon' => 'dashicons-clock',
			) )
		);
	}
	
	}
	
	new class_wcd_post_types();