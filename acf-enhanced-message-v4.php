<?php

/*
*  ACF - Enhanced Message Field Class
*
*/

class acf_field_enhanced_message extends acf_field {
	
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'enhanced_message';
		$this->label = __('Enhanced Message');
		$this->category = __("Layout",'acf'); 
		$this->defaults = array(
				'enhanced_message' => '',
				'hide_label' => 'no',
			);
		
		// do not delete!
    	parent::__construct();

	}
	
	
	/*
	*  create_options()
	*/
	
	function create_options( $field )
	{
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>
<!-- Message -->
<tr class="field_option field_option_<?php echo $this->name; ?>">
		
	<td class="label">
		<label><?php _e("Message",'acf'); ?></label>
		<p class="description"><?php echo __('Works like the default Message field but supports PHP and without','acf') . ' <a href="http://codex.wordpress.org/Function_Reference/wpautop" target="_blank">wpautop()</a>'; ?></p>
	</td>
	<td>
		<?php
		
		do_action('acf/create_field', array(
			'type'		=>	'textarea',
			'value'		=>	$field['enhanced_message'],
			'name'		=>	'fields['.$key.'][enhanced_message]',
		));
		
		?>
	</td>
</tr>

<!-- Hide Label? -->
<tr class="field_option field_option_<?php echo $this->name; ?>">
	
	<td class="label">
		<label><?php _e("Hide Label?",'acf'); ?></label>
	</td>
	<td>
		<?php
		
		do_action('acf/create_field', array(
			'type'		=>	'radio',
			'value'		=>	$field['hide_label'],
			'name'		=>	'fields['.$key.'][hide_label]',
			'layout'	=>	'horizontal',
			'choices'	=>	array(
				'yes' => __('Yes'),
				'no' => __('No'),
			)
		));
		
		?>
	</td>
</tr>
		<?php
		
	}
	
	/*
	*  field_group_admin_head()
	*/

	function field_group_admin_head()
	{
		?>
<style>
	#acf_fields .fields .field_type-enhanced_message tr.field_name, 
	#acf_fields .fields .field_type-enhanced_message tr.field_instructions, 
	#acf_fields .fields .field_type-enhanced_message tr.required { display: none; }
</style>
<script>

</script>
		<?php
	}


	/*
	*  load_field()
	*
	*/
	
	function load_field( $field )
	{
		global $post;

		if($field['hide_label'] == 'yes' && $post->post_type != 'acf') {
			$field['label'] = '';
			echo '<style>div[data-field_key="'.$field['key'].'"] .label {display:none;}</style>';
		}

		return $field;
	}

	/*
	*  field_group_admin_enqueue_scripts()
	*/
	
	function field_group_admin_enqueue_scripts() {
	
		
		$dir = plugin_dir_url( __FILE__ );
		
		// register & include JS
		wp_register_script( 'acf-input-enhanced_message', "{$dir}js/input-v4.js", array(), false, true );
		wp_enqueue_script('acf-input-enhanced_message');
		
	}

	/*
	*  create_field()
	*/
	
	function create_field( $field )
	{
		$stringVal = $field['enhanced_message'];

		ob_start();
		eval('?>'.$stringVal);
		$stringVal = ob_get_contents();
		ob_end_clean();

		echo $stringVal;
	}


	
}


// create field
new acf_field_enhanced_message();

?>
