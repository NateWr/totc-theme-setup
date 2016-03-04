<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Common library to generate a theme setup page to install demo content,
 * access help documentation and support, and more.
 *
 * @version 0.1
 */

if ( !function_exists( 'totc_theme_setup_get_object' ) ) {
	/**
	 * Instantiate and return an instance of the theme setup page
	 *
	 * @since 0.1
	 */
	function totc_theme_setup_get_object() {
		include_once( 'totcThemeSetup.class.php' );
		return new totcThemeSetup();
	}

}

if ( !function_exists( 'totc_theme_setup_add_page' ) ) {
	/**
	 * Add the menu page for theme setup
	 *
	 * @since 0.1
	 */
	function totc_theme_setup_add_menu_page() {
		$setup_page = totc_theme_setup_get_object();
		$setup_page->add_menu_page();
	}
}

if ( !function_exists( 'totc_theme_setup_ajax' ) ) {
	/**
	 * Handle ajax requests
	 *
	 * @since 0.1
	 */
	function totc_theme_setup_handle_ajax_requests() {
		$setup_page = totc_theme_setup_get_object();
		$setup_page->handle_ajax_requests();
	}
}
