(function($){

	// override populating field_name
	var acf_fg = jQuery('#acf-field-group-fields');

	$(document).ready(function() {	

		acf_fg.on('blur','tr[data-name="label"] input', function (e) {
			
			$field = $(this).closest('.field');
			
			reinit_enhanced_message($field);

		});

	});

	// trigger event
	acf.add_action('change_field_type', function ($el) {
		
		reinit_enhanced_message($el);

	});

	function reinit_enhanced_message($el) {

		if($el.attr('data-type') == 'enhanced_message') {
			$el.find('> .field-info > .li-field_name').text('');
			$el.find('tr[data-name="name"] input').val('');
		}

	}

})(jQuery);