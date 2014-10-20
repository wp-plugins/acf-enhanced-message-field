<?php

/*
*  ACF - Enhanced Message Field Class
*
*/

if( ! class_exists('acf_field_enhanced_message') ) :

class acf_field_enhanced_message extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*/
	
	function __construct() {
		
		// vars
		$this->name = 'enhanced_message';
		$this->label = __("Enhanced Message",'acf');
		$this->category = 'layout';
		$this->defaults = array(
			'enhanced_message'	=> '',
			'hide_label' => 'no',
		);
		
		
		// do not delete!
    	parent::__construct();
	}
	
	
	/*
	*  render_field()
	*/
	
	function render_field( $field ) {
		
		$stringVal = $field['enhanced_message'];

		ob_start();
		eval('?>'.$stringVal);
		$stringVal = ob_get_contents();
		ob_end_clean();

		echo $stringVal;
	}
	
	/*
	*  field_group_admin_head()
	*
	*/
	
	function field_group_admin_head() {
		?>
<style>
	.acf-field-list .field_type-enhanced_message tr[data-name="name"], 
	.acf-field-list .field_type-enhanced_message tr[data-name="instructions"], 
	.acf-field-list .field_type-enhanced_message tr[data-name="required"] { display: none; }
</style>
		<?php
	}

	/*
	*  field_group_admin_enqueue_scripts()
	*/
	
	function field_group_admin_enqueue_scripts() {
	
		
		$dir = plugin_dir_url( __FILE__ );
		
		// register & include JS
		wp_register_script( 'acf-input-enhanced_message', "{$dir}js/input.js", array(), false, true );
		wp_enqueue_script('acf-input-enhanced_message');
		
	}

	/*
	*  load_field()
	*
	*/
	
	function load_field( $field )
	{
		global $post;

		if($field['hide_label'] == 'yes' && $post->post_type != 'acf-field-group') {
			$field['label'] = '';
			echo '<style>div[data-key="'.$field['key'].'"] .acf-label {display:none;}</style>';
		}

		return $field;
	}

	
	/*
	*  render_field_settings()
	*/
	
	function render_field_settings( $field ) {
		
		// Message
		acf_render_field_setting( $field, array(
			'label'			=> __('Message','acf'),
			'instructions'	=> __('Works like the default Message field but supports PHP and without ','acf') . '<a href="http://codex.wordpress.org/Function_Reference/wpautop" target="_blank">wpautop()</a>',
			'type'			=> 'textarea',
			'name'			=> 'enhanced_message',
		));

		// Hide Label?
		acf_render_field_setting( $field, array(
			'label'			=> __('Hide Label','acf'),
			'type'			=> 'radio',
			'name'			=> 'hide_label',
			'layout'		=> 'horizontal',
			'choices'	=>	array(
				'yes' => __('Yes'),
				'no' => __('No'),
			)
		));
		
	}
	
}

new acf_field_enhanced_message();

endif;

?>
