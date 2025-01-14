<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_qa_delivery_hour_column{
	
	public function __construct(){

		add_action( 'manage_delivery_hour_posts_columns', array( $this, 'add_core_delivery_hour_columns' ),     16, 1 );
		add_action( 'manage_delivery_hour_posts_custom_column', array( $this, 'custom_columns_content' ),     10, 2 );
		add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 10, 2 );
		
	}
	
	public function add_core_delivery_hour_columns( $columns ) {

		$new = array();
		foreach ( $columns as $col_id => $col_label ) {
			
			if( 'title' === $col_id ) {
				$new[$col_id] = '<i class="fa fa-clock-o"></i> ' . esc_html__( 'Hour Set Name', WOCTEXTDOMAIN );
				
				// $new['wcd_shortcode'] = '<i class="fa fa-code" aria-hidden="true"></i>' . esc_html__( 'Shortcode', WOCTEXTDOMAIN );
				// $new['wcd_shortcode'] = '';
				$new['wcd_status'] = '';
				$new['wcd_date'] = '';
				
			}
			else $new[ $col_id ] = $col_label;
		}
		unset( $new['date'] );
		
		return $new;
	}
	
	public function custom_columns_content( $column, $post_id ) {
	switch ( $column ) {
		
		
			
		case 'wcd_status':
			
			if( $post_id == get_option( 'wcd_active_set' ) )
			echo '<div class="wcd_column_status"><i class="fa fa-check"></i> '.esc_html__('Active', WOCTEXTDOMAIN).'</div>';

			break;
		
		case 'wcd_date':
			
			$dateago = human_time_diff( get_the_time( 'U', $post_id ), current_time( 'timestamp' ) );
			
			?>Created <em><?php printf( __( '%s ago', WOCTEXTDOMAIN ), $dateago ); ?></em><?php 
			
			break;
			
			
		}
	}
	
	public function remove_row_actions( $actions ) {
		global $post;

		if ( $post->post_type === 'delivery_hour' ) {
			unset( $actions['inline hide-if-no-js'] );
			unset( $actions['view'] );
		}

		return $actions;
	}
	
	
} new class_qa_delivery_hour_column();