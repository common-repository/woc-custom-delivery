jQuery(document).ready(function($)
	{
		
		$(function() {
			$( ".delivery_hours_licontainer" ).sortable({ handle: ".wcd_single_sorter" });
		});		
				
		var val = $( "#delivery_message_show_hour option:selected").val();
		if ( val != 'yes' ) $('.delivery_message_format').css('display','none');
		
		$('.wcd_btn_insert_input').on('click', function() {
			
			var day_key = $(this).attr('day_key');
			$('.delivery_hours_meta_'+day_key+'').addClass( 'adding_slack' );
			
			jQuery.ajax(
				{
			type: 'POST',
			url: wcd_ajax.wcd_ajaxurl,
			context:this,
			data: {
				"action"	: "wcd_add_more_time_slot",
				"day_key"	:day_key
			},
			success: function(data) {	
				$('.delivery_hours_meta_'+day_key+'').removeClass( 'adding_slack' );
				$('.delivery_hours_meta_'+day_key+'').append( data );
			}
				});
		});
		
		$('#delivery_message_show_hour').on('change', function() {
			if ( this.value == 'yes' ) $('.delivery_message_format').fadeIn();
			else $('.delivery_message_format').fadeOut();
		});
		
		
	});
	
	jQuery(document).on('click','.wcd_delete_single_schedule', function(){
		
		var ul_classes = jQuery(this).closest('li').parent().attr('class').split(' ');
		
		if( jQuery( '.' + ul_classes[1] + ' li' ).length <= 1 ) return;
		jQuery(this).closest('li').remove();
			
	});