<?php

/*
* @Author 		pluginbazar
* @Folder	 	job-board-manager\themes\joblist

* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access
	
	$wcd_active_set = empty( $wcd_active_set ) ? get_option( 'wcd_active_set' ) : $wcd_active_set;
	
/* 	if ( empty($wcd_active_set) ) {
		$html .= '
		<span class="wcd_error_messge">
			<i class="fa fa-exclamation-triangle"></i> No Active Business Hour Set !
		</span>';
		
		return $html;
	} */
	
	
	$html_each = '';
	
	if ( wcd_is_open() ):
		$status_class 	= 'wcd_open';
		$status_font 	= '<i class="fa fa-check-circle"></i>';
	else:
		$status_class 	= 'wcd_close';
		$status_font 	= '<i class="fa fa-times-circle"></i>';
	endif;
	
	if( $wcd_show_cart_icon == 'yes' ) $cart_icon = '<i class="fa fa-shopping-cart"></i>';
	else $cart_icon = '';
	if( $wcd_show_hand_icon == 'yes' ) $hand_icon = '<i class="fa fa-hand-o-right"></i>';
	else $hand_icon = ' - ';
	if( $wcd_show_status_icon == 'no' ) $status_font = '';
	
	
	if ( !empty( $wcd_header_text ) )
	$html_each .= '
	<li class="wcd_display_each wcd_header_text">
		<span>'.$wcd_header_text.'</span>
	</li>';
	
	
	
	$class_wcd_post_meta = new class_wcd_post_meta();
	$wcd_meta_options_hour = $class_wcd_post_meta->wcd_meta_options_hour();	
	
	$count = 0;
	foreach($wcd_meta_options_hour as $options_tab=>$options) 
	{
		if ( $count != 0 and $count <= 7 ):
	
			${'day_'.$count} = $options_tab;
			
			$today		= strtolower(date('D'));
			$this_day = strtolower(substr( $options_tab	, -0, 3) );
			
			if ( $this_day == $today ):
				$html_each .= '<li class="wcd_display_each wcd_active '.$status_class.'">';
				$open_font = $status_font;
				
			else: 
				$html_each .= '<li class="wcd_display_each">';		
				$open_font = '';
			endif;
			
			$start_time = get_post_meta ( $set, 'wcd_'.strtolower($this_day).'_start', true );
			$end_time	= get_post_meta ( $set, 'wcd_'.strtolower($this_day).'_end', true );
			
			if ( empty( $start_time) ) 	$start_time = '00:00';
			if ( empty( $end_time) ) 	$end_time = '00:00';
			
			$html_each .= '
			'.$cart_icon.'
			<span class="wcd_day">'.$options_tab.'</span>
			'.$hand_icon.'
			<span class="wcd_time">'.$start_time.' - '.$end_time.'</span>
			'.$open_font.'
			</li>';
		endif;
		
		$count++;
	}	
	
	$html .= '
	<div class="wcd_display wcd_display_'.$themes.'"
		<ul class="">
			'.$html_each.'
		</ul>
	</div>';
	
	
	
	
	// custom css
	$html .= '
	<style>
		.wcd_display_flat .wcd_display_each.wcd_header_text {
			color: '.$wcd_header_font_color.' !important;
			background-color:'.$wcd_header_background_color.' !important;
			font-size:'.$wcd_header_font_size.' !important;
		}
		.wcd_display_flat .wcd_display_each {
			width:'.$wcd_display_width.';
			background-color: '.$wcd_display_background_color.';
			color: '.$wcd_display_color.';
		}
		
	</style>';