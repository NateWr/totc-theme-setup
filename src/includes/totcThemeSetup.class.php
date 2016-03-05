<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetup' ) ) {
	/**
	 * Extensible class to add and manage a theme setup page
	 *
	 * @version 0.1
	 */
	class totcThemeSetup {

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'lib.url_base' => '',
			'page.title' => '',
			'page.menu.title' => '',
			'page.no.access' => '',
			'page.demo.section' => '',
			'page.demo.install_plugin' => '',
			'page.demo.install_plugin.no_permission' => '',
			'page.demo.activate_plugin' => '',
			'page.demo.activate_plugin.no_permission' => '',
			'page.demo.install_demo' => '',
			'page.demo.install_demo.no_permission' => '',
			'page.demo.view_demo' => '',
			'page.documentation.section' => '',
			'page.documentation.help' => '',
			'page.documentation.help.description' => '',
			'page.documentation.support' => '',
			'page.documentation.support.url' => '',
			'page.documentation.support.description' => '',
			'page.documentation.demo' => '',
			'page.documentation.demo.url' => '',
			'page.documentation.demo.description' => '',
		);

		/**
		 * Attached demo handler classes
		 *
		 * @since 0.1
		 */
		public $demos = array();

		/**
		 * Initialize the theme setup page
		 *
		 * @since 0.1
		 */
		public function __construct() {
			$this->strings = apply_filters( 'totc_theme_setup_strings', $this->strings );
		}

		/**
		 * Add the menu page
		 *
		 * @since 0.1
		 */
		public function add_menu_page() {

			$strings = $this->strings;
			$capability = apply_filters( 'totc_theme_setup_page_capability', 'edit_theme_options' );

			add_theme_page( $strings['page.title'], $strings['page.menu.title'], $capability, $this->get_menu_page_slug(), array( $this, 'render_page' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		}

		/**
		 * Get page slug
		 *
		 * @since 0.1
		 */
		public function get_menu_page_slug() {
			return apply_filters( 'totc_theme_setup_page_slug', 'totc-setup' );
		}

		/**
		 * Handle ajax requests for installing demo content
		 *
		 * @since 0.1
		 */
		public function handle_ajax_requests() {

			error_log( 'totcThemeSetup::handle_ajax_requests' );
			wp_send_json_success();
		}

		/**
		 * Load assets for the theme setup page
		 *
		 * @since 0.1
		 */
		public function enqueue_admin_assets() {

			// Use the page reference in $admin_page_hooks because
			// it changes in SOME hooks when it is translated.
			// https://core.trac.wordpress.org/ticket/18857
			global $admin_page_hooks;

			$screen = get_current_screen();
			$slug = $this->get_menu_page_slug();
			if ( empty( $screen ) || $screen->base != 'appearance_page_' . $slug ) {
				return;
			}

			wp_enqueue_script( 'totc-theme-setup', $this->strings['lib.url_base'] . '/js/theme-setup.js', array( 'jquery' ), '', true );
		}

		/**
		 * Output the HTML for this admin page
		 *
		 * @since 0.1
		 */
		public function render_page() {
			$this->get_demo_handlers();
			include( 'templates/page.php' );
		}

		/**
		 * Retrieve demo handler classes
		 *
		 * @since 0.1
		 */
		public function get_demo_handlers() {
			$this->demos = apply_filters( 'totc_theme_setup_demo_handlers', $this->demos );
			return $this->demos;
		}

	}
}
