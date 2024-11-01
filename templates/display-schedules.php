<?php

/*
* @Author 		pluginbazar
* @Folder	 	job-board-manager\themes\joblist

* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access
	
	$wcd_active_set = empty( $wcd_active_set ) ? get_option( 'wcd_active_set' ) : $wcd_active_set;
	
	$delivery_hours_meta = get_post_meta( $wcd_active_set, 'delivery_hours_meta', true );
	
	?>
	<div class="wcd_schedules_container"> 
		
		<div class="wcd_schedules">
	
	
	
	<?php 
	
	$current_day 	= strtolower(date('D'));
	
	foreach( $delivery_hours_meta as $day => $day_schedule ) {
		
		if( $day == 'delivery_message' ) continue;
		
		$wcd_status = '';
		if( $current_day == $day ) 
		$wcd_status = wcd_is_open() ? 'wcd_open_now' : 'wcd_close_now';

		
		?><div class="single_schedule" day_key="<?php echo $day; ?>">
		
		<div class="wcd_day <?php echo $wcd_status; ?>"><?php echo ucfirst($day).' Day'; ?></div>
		
		<div class="wcd_day_schedule day_key_<?php echo $day; ?>" style="<?php if( $current_day != $day ) echo 'display:none;' ?>">
		<?php
		$time			= date('H:i');
		
		foreach( $day_schedule as $schedule_id => $schedule_details ) {
			
			if( isset( $schedule_details['open'] ) and $schedule_details['close'] ) {
				
			?><div class="single_schedule_inside"> <?php echo $schedule_details['open'].' - '.$schedule_details['close']; ?></div><?php 
			
			} else {
				
				?><div class="single_schedule_inside"> - </div><?php 
				
			}
		}
		
		?></div></div><?php
	}
	?>
	
		</div>
	
	</div>
	
	
	