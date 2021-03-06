<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Schema_WP_Admin_Menu {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_main_menus' 	),	10 );
		add_action( 'admin_menu', array( $this, 'register_types_menus' 	),  20 );
		add_action( 'admin_menu', array( $this, 'register_about_menus' 	),  30 );
	}

	public function register_main_menus() {
		
		global $schema_wp_options_page;
		
		$schema_wp_options_page = add_menu_page(
			__( 'Schema', 'schema-wp' ),
			__( 'Schema', 'schema-wp' ),
			'manage_schema_options',
			'schema',
			'schema_wp_options_page'
		);
		
		add_submenu_page(
			'schema',
			__( 'Schema Settings', 'schema-wp' ),
			__( 'Settings', 'schema-wp' ),
			'manage_schema_options',
			'schema',
			'schema_wp_options_page'
		);
		
		// Contextual Help
		// @since 1.5.9.3
		if ( $schema_wp_options_page )
		add_action( 'load-' . $schema_wp_options_page, 'schema_wp_settings_contextual_help' );	
	}
	
	public function register_types_menus() {
		
		add_submenu_page(
			'schema',
			__( 'Types', 'schema-wp' ),
			__( 'Types', 'schema-wp' ),
			'manage_schema_options',
			'edit.php?post_type=schema'
		);
	}
	
	public function register_about_menus() {
		
		add_submenu_page(
			'schema',
			__( 'About', 'schema-wp' ),
			__( 'About', 'schema-wp' ),
			'manage_schema_options',
			'?page=schema-wp-what-is-new'
		);
	}

}

$schema_wp_menu = new Schema_WP_Admin_Menu;
