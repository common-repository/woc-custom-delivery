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
<div class="wcd_wrap_faq">
	<h2>WooCommerce Open Close - Frequently Asked Question Panel</h2>

	<ul class="wcd_faq_panel">
	
		<li class="wcd_video_tutorial">
			<div class="wcd_block_header">Video Tutorial</div>
			<iframe src="https://www.youtube.com/embed/<?php echo wcd_video_code; ?>?feature=oembed&amp;autoplay=0&amp;controls=0&amp;showinfo=0&amp;rel=0frameborder=" style="width:100%;height:320px;" allowfullscreen="allowfullscreen"></iframe>
		</li>
	
		<li class="wcd_faq_link">
			<div class="wcd_block_header">Asked a Question</div>
			
			<form enctype="multipart/form-data" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				
				<p><input type="text" name="wcd_contact_name" required value="<?php echo $wcd_contact_name; ?>" placeholder="Your name"/>
				<input type="email" name="wcd_contact_email" required value="<?php echo $wcd_contact_email; ?>" placeholder="Your email"/> </p>
				<p><input type="text" size="45" name="wcd_contact_subject" required value="<?php echo $wcd_contact_subject; ?>" placeholder="Subject"/> </p>
				<p><textarea name="wcd_contact_message" required cols="45" placeholder="Your Mesaage"><?php echo $wcd_contact_message; ?></textarea></p>
				
				<input type="submit" class="button " value="Send Email" />
				
			</form> <br> <br>
			
			<span>OR</span> <br><br>
			<a href="<?php echo wcd_contact_url; ?>" target="_blank" class="wcd_asked_on_forum">Aksed on our forum</a>
		</li>
	</ul>
	
	<?php do_action('pluginbazar_plugins'); ?>
	
</div>
