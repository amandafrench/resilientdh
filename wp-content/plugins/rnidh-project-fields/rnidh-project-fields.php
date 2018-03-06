<?php
/*
Plugin Name: RNIDH Project Fields
Plugin URI: http://resilientdh.org
Description: Adds additional fields to RNIDH Projects (Groups)
Version: 1.0
Requires at least: 3.3
Tested up to: 3.3.1
License: GPL3
Author: Amanda French
Author URI: http://amandafrench.net
*/

//wrapper function if BP is activated
function bp_group_meta_init() {
 
	function custom_field($meta_key='') {
	//get current group id and load meta_key value if passed. If not pass it blank
	return groups_get_groupmeta( bp_get_group_id(), $meta_key) ;
	}
    
    // This function is our custom field's form that is called in create a group and when editing group details
    
	function group_header_fields_markup() {
	global $bp, $wpdb;
	?>
	<label for="rnidh-project-url">Project URL (such as http://beyondragstoriches.org)</label>
	<input id="rnidh-project-url" type="text" name="rnidh-project-url" value="<?php echo custom_field('rnidh-project-url'); ?>" />
	<br /><br />
	<label for="rnidh-project-timeline">Project Timeline (such as May 2017-April 2018)</label>
	<input id="rnidh-project-timeline" type="text" name="rnidh-project-timeline" value="<?php echo custom_field('rnidh-project-timeline'); ?>" />
	<br />
	<?php
	}

	// This saves the custom group meta – props to Boone for the function
	// Where $plain_fields = array.. you may add additional fields, eg
	//  $plain_fields = array(
	//      'field-one',
	//      'field-two'
	//  );
	function group_header_fields_save( $group_id ) {
	global $bp, $wpdb;
	$plain_fields = array(
	'rnidh-project-url', 'rnidh-project-timeline'
	);
	foreach( $plain_fields as $field ) {
	$key = $field;
	if ( isset( $_POST[$key] ) ) {
	$value = $_POST[$key];
	groups_update_groupmeta( $group_id, $field, $value );
	}
	}
	} 


add_filter( 'groups_custom_group_fields_editable', 'group_header_fields_markup' );
add_action( 'groups_group_details_edited', 'group_header_fields_save' );
add_action( 'groups_created_group',  'group_header_fields_save' );	

// Show the custom field in the group header
function show_field_in_header( ) {

if (custom_field('rnidh-project-url') == null) 

echo ' '; 

else echo "<br /><span class='highlight'>URL: " . "<a href='" . custom_field('rnidh-project-url') . "'>" . custom_field('rnidh-project-url') . "</a></span>";

if (custom_field('rnidh-project-timeline') == null) 

echo ' '; 

else echo "<br /><span class='highlight'>Timeline: " . custom_field('rnidh-project-timeline') . "</span>";

}
add_action('bp_before_group_header_meta' , 'show_field_in_header') ;

}
add_action( 'bp_include', 'bp_group_meta_init' );

/* If you have code that does not need BuddyPress to run, then add it here. */

?>