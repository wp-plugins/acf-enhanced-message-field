(function($){

	$(document).ready(function() {	

		// override populating field_name
		var acf_fg = $('#acf_fields');

		acf_fg.on('blur','tr[class="field_label"] input', function (e) {

			$field = $(this).closest('.field');

			if($field.attr('data-type') == 'enhanced_message') {
			
				reinit_enhanced_message($(this), e);
				$(document).off('blur', '#acf_fields tr.field_label input.label');
			
			} else {

				// vars - retrieved from field-group.js [ACF core] @@ 536 @@ 
				var $label = $(this),
					$name = $field.find('tr.field_name:first input[type="text"]'),
					type = $field.attr('data-type');
					
					
				// leave blank for tab or message field
				if( type == 'tab' || type == 'message' || type == 'enhanced_message')
				{
					$name.val('').trigger('keyup');
					return;
				}
					
				
				if( $name.val() == '' )
				{
					// thanks to https://gist.github.com/richardsweeney/5317392 for this code!
					var val = $label.val(),
						replace = {
							'ä': 'a',
							'æ': 'a',
							'å': 'a',
							'ö': 'o',
							'ø': 'o',
							'é': 'e',
							'ë': 'e',
							'ü': 'u',
							'ó': 'o',
							'ő': 'o',
							'ú': 'u',
							'é': 'e',
							'á': 'a',
							'ű': 'u',
							'í': 'i',
							' ' : '_',
							'\'' : '',
							'\\?' : ''
						};
					
					$.each( replace, function(k, v){
						var regex = new RegExp( k, 'g' );
						val = val.replace( regex, v );
					});
					
					
					val = val.toLowerCase();
					$name.val( val );
					$field.find('td.field_name').first().html(val);
				}
			}

		});

		acf_fg.on('change','tr[class="field_type"] select', function (e) {
			
			if($(this).val() == 'enhanced_message' ) {
				reinit_enhanced_message($(this), e);
			}

		});

	});

	function reinit_enhanced_message($el, e) {

		$el.closest('.field').find('> .field_meta .field_name').text('');
		$el.closest('.field').find('tr[class="field_name"] input').val('');

	}

})(jQuery);