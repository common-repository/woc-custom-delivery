<?php

/*
* @Author 		pluginbazar
* Copyright: 	2015 pluginbazar
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wcd_post_meta{
	
	public function __construct(){
		add_action('add_meta_boxes', array($this, 'meta_boxes_delivery_hour'));
		add_action('save_post', array($this, 'meta_boxes_delivery_hour_save'));
		add_action('post_submitbox_misc_actions', array($this, 'publish_box_delivery_hour_function') );
	}
	
	public function meta_boxes_delivery_hour($post_type) {
		$post_types = array('delivery_hour');
		if (in_array($post_type, $post_types)) {
			add_meta_box('wcd_metabox',__('WooCommerce Custom Delivery TIme',WOCTEXTDOMAIN),
				array($this, 'wcd_meta_box_function'),
				$post_type,'normal','high');
		}
	}
	
	
	public function publish_box_delivery_hour_function(){
	
	global $post;
	if( $post->post_type == 'delivery_hour' ) {
	
	$delivery_hours_meta = get_post_meta( $post->ID, 'delivery_hours_meta', true );
	$delivery_message 	= isset( $delivery_hours_meta['delivery_message'] ) ? $delivery_hours_meta['delivery_message'] : '';
	
	?>
	<style>#minor-publishing-actions, .misc-pub-post-status,.misc-pub-curtime,.misc-pub-visibility { display:none; !important; } </style>
	
	<div class="pb-settings woc-message" style="padding:0 15px;">
		
		
			<p class="option-title">Title</p>
			<input name="post_title" placeholder="Delivery hour title" autocomplete="off" value="<?php echo $post->post_title; ?>" />
			
			<p class="option-title">Message</p>
			<textarea name="delivery_hours_meta[delivery_message]" class="delivery_message" id="delivery_message" rows="4" cols="25"><?php echo $delivery_message; ?></textarea>
		
	</div> 
	
	
	<?php }
	}

	public function wcd_meta_box_function($post) {
        wp_nonce_field('wcd_nonce_check', 'wcd_nonce_check_value');
		
		$delivery_hours_meta = get_post_meta( $post->ID, 'delivery_hours_meta', true );
		
		// echo '<pre>'; print_r( $delivery_hours_meta ); echo '</pre>';
		
		
		$days_array = array(
			
			'mon' => array(
					'name' => 'Monday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'tue' => array(
					'name' => 'Tuesday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'wed' => array(
					'name' => 'Wednesday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'thu' => array(
					'name' => 'Thursday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'fri' => array(
					'name' => 'Friday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'sat' => array(
					'name' => 'Saturday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
			'sun' => array(
					'name' => 'Sunday',
					'icon' => '<i class="fa fa-sun-o"></i>',
				),
		);
		
		echo '<div class="pb-settings woc-schedule-container">';
		
		$tab_nav = '';
		$tab_box = '';
		
		$count = 1; 		
		foreach( $days_array as $day_key => $day_details ) {
			
			if( $count == 1 ) {
				$tab_nav .= '<li nav="'.$count.'" class="nav'.$count.' active">'.$day_details['icon'].' '.$day_details['name'].'</li>';
				$tab_box .= '<li style="display: block;" class="box'.$count.' tab-box active">';
			} 
			else {
				$tab_nav .= '<li nav="'.$count.'" class="nav'.$count.'">'.$day_details['icon'].' '.$day_details['name'].'</li>';
				$tab_box .= '<li style="display: none;" class="box'.$count.' tab-box">';
			}
			
			$tab_box .= '
			<div class="wcd_btn_insert_input" day_key="'.$day_key.'"><i class="fa fa-plus-circle"></i> Add New Row</div>
			<div class="option-box">
				<p class="option-title">'.$day_details['name'].' Schedule</p>
				<p class="option-info">You can add more slacks.</p>
					
					<ul class="delivery_hours_licontainer delivery_hours_meta_'.$day_key.'">';
					
					if( empty($delivery_hours_meta) ) {
					
						$tab_box .= '
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
					
					 } else {
					
						foreach( $delivery_hours_meta[$day_key] as $schedule_id => $schedule_details ) {

						$tab_box .= '
						<li class="wcd_single_schedule" id="'.$schedule_id.'">
							<label for="wcd_'.$day_key.'_open_'.$schedule_id.'"><i class="fa fa-angle-up"></i> Opening Time </label>
							<input type="text" name="delivery_hours_meta['.$day_key.']['.$schedule_id.'][open]" value="'.$schedule_details['open'].'" id="wcd_'.$day_key.'_open_'.$schedule_id.'" placeholder="Click to set time"/>
							
							<label for="wcd_'.$day_key.'_close_'.$schedule_id.'"><i class="fa fa-angle-down"></i> Closing Time </label>
							<input type="text" name="delivery_hours_meta['.$day_key.']['.$schedule_id.'][close]" value="'.$schedule_details['close'].'" id="wcd_'.$day_key.'_close_'.$schedule_id.'" placeholder="Click to set time"/>
							
							<div class="wcd_delete_single_schedule" row_id="'.$schedule_id.'"><i class="fa fa-times-circle-o"></i></div>
							
							<div class="wcd_single_sorter"><i class="fa fa-sort" aria-hidden="true"></i></div>
						
						</li>
						<script> 
							jQuery("#wcd_'.$day_key.'_open_'.$schedule_id.'").timepicker({ "timeFormat": "H:i" }); 
							jQuery("#wcd_'.$day_key.'_close_'.$schedule_id.'").timepicker({ "timeFormat": "H:i" }); 
							
							
						</script>';
						
						}
					}
					
					$tab_box .= '
					</ul>
					
				</div>
				   
			</li>';
			
			$count++;
			
		}
		
		
		echo '<ul class="tab-nav">'.$tab_nav.'</ul>';
		echo '<ul class="box">'.$tab_box.'</ul>';
		
		echo '</div>'; //pb-settings
   	}
	
	public function meta_boxes_delivery_hour_save($post_id){
		if (!isset($_POST['wcd_nonce_check_value'])) return $post_id;
		$nonce = $_POST['wcd_nonce_check_value'];
		
	 	if (!wp_verify_nonce($nonce, 'wcd_nonce_check')) return $post_id;
	 	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	 	if ('page' == $_POST['post_type']) if (!current_user_can('edit_page', $post_id)) return $post_id;
		else if (!current_user_can('edit_post', $post_id)) return $post_id;
	
		$delivery_hours_meta = stripslashes_deep($_POST['delivery_hours_meta']);
		update_post_meta($post_id, 'delivery_hours_meta', $delivery_hours_meta);		
	}
} new class_wcd_post_meta();