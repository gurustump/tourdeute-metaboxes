<?php
/**
 * @package Guru_Metaboxes
 * @version 1
 */
/*
Plugin Name: Guru Metaboxes
Plugin URI: 
Description: Adding metaboxes for various post types using CMB2. Requires CMB2 Plugin, or the CMB2 theme folder.
Author: Matthew Stumphy
Version: 1
Author URI: http://www.guru.com
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_init', 'guru_register_page_metabox' );

function guru_register_page_metabox() {
	$prefix = '_guru_page_';
	
	$cmb_page_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Custom Page Fields', 'cmb2' ),
		'object_types'  => array( 'page'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_page_box->add_field( array(
		'name'		=> __( 'Background Image', 'cmb2' ),
		'desc' => __( 'Add a background image to the page', 'cmb2' ),
		'id'			=> $prefix . 'page_bg',
		'type'		=> 'file',
	) );

	$cmb_page_box->add_field( array(
		'name'		=> __( 'Body Class', 'cmb2' ),
		'desc' => __( 'For applying special styles to a page, add additional class names to the <body> tag here. If you are uncertain what this does, it is recommended that you leave this alone, as this could break the page.', 'cmb2' ),
		'id'			=> $prefix . 'body_class',
		'type'		=> 'text',
	) );

}


add_action( 'cmb2_init', 'guru_register_video_metabox' );

function guru_register_video_metabox() {
	$prefix = '_guru_video_';
	
	$cmb_video_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Video Information', 'cmb2' ),
		'object_types'  => array( 'video'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_video_box->add_field( array(
		'name'		=> __( 'Video ID', 'cmb2' ),
		'desc' => __( 'Input the ID of the Vimeo video', 'cmb2' ),
		'id'			=> $prefix . 'video_ID',
		'type'		=> 'text',
	) );

}

add_action( 'cmb2_init', 'guru_register_person_metabox' );

function guru_register_person_metabox() {
	$prefix = '_guru_person_';
	
	$cmb_person_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Person Information - All fields are optional', 'cmb2' ),
		'object_types'  => array( 'person'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_person_box->add_field( array(
		'name' => __( 'Title', 'cmb2' ),
		'desc' => __( "Enter the person's official title", 'cmb2' ),
		'id'   => $prefix . 'title',
		'type' => 'text',
		'protocols' => array('http', 'https'), // Array of allowed protocols
	) );

}


// Adding a box on the General Settings page in the Wordpress Admin for some extra settings
// https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/options-pages-with-submenus.php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function guru_register_main_options_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$main_options = new_cmb2_box( array(
		'id'           => 'guru_main_options_page',
		'title'        => esc_html__( 'Theme Options', 'cmb2' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'custom_main_options', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'guru_options_page_message_callback',
	) );
	/**
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$main_options->add_field( array(
		'name'    => esc_html__( 'Site Theme', 'cmb2' ),
		'desc'    => esc_html__( 'Select which display theme you want for the site', 'cmb2' ),
		'id'      => 'display_theme',
		'type'    => 'select',
		'default' => 'light',
		'options' => array(
			'light' => esc_html__( 'Light' ),
			'dark' => esc_html__( 'Dark' ),
		),
	) );
}
add_action( 'cmb2_admin_init', 'guru_register_main_options_metabox' );


function guru_register_module_metabox() {
	$prefix = '_guru_module_';

	$cmb_module_box = new_cmb2_box( array(
		'id'           => $prefix.'metabox',
		'title'        => __( 'Module Information', 'cmb2' ),
		'object_types' => array( 'modules' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

}
add_action( 'cmb2_init', 'guru_register_module_metabox' );


?>
