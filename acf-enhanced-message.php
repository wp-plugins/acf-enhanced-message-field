<?php
/*
Plugin Name: ACF Enhanced Message Field
Description: Adds an enhanced version of the default Message field to accept PHP and certainly no wpauto().
Version: 1.0.1
Author: Dreb Bits
Author URI: http://drebbits.com
*/

// Include field type for ACF5
function include_field_type_enhancedMessage( $version ) {

	include_once('acf-enhanced-message-v5.php');
}

add_action('acf/include_field_types', 'include_field_type_enhancedMessage');	


// Include field type for ACF4
function register_fields_enhancedMessage() {
	
	include_once('acf-enhanced-message-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_enhancedMessage');	
?>