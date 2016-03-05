<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemo' ) ) {
	/**
	 * Base class to handle the installation of demo content for a plugin
	 *
	 * @version 0.1
	 */
	abstract class totcThemeSetupDemo {

		/**
		 * Plugin title
		 *
		 * @since 0.1
		 */
		public $title;

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file;

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug;

		/**
		 * Status of plugin installation/demo content
		 *
		 * @param string Status key:
		 *  install_plugin = The plugin needs to be installed
		 *  activate_plugin = The plugin needs to be activated
		 *  install_demo = The demo content needs to be installed
		 *  done = Demo content installed
		 * @since 0.1
		 */
		public $status;

		/**
		 * Initialize the class and set up base variables
		 *
		 * @since 0.1
		 */
		public function __construct( $args ) {
			foreach( $args as $key => $val ) {
				if ( property_exists( $this, $key ) ) {
					$this->{$key} = $val;
				}
			}
		}

		/**
		 * Get the current status of the plugin
		 *
		 * @param bool $update Whether or not use the cached status value
		 * @since 0.1
		 */
		public function get_status( $update = false ) {

			if ( !$update && !empty( $this->status ) ) {
				return $this->status;
			}

			if ( !function_exists( 'get_plugins' ) ) {
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			}

			$plugins = get_plugins();
			$plugin_installed = !empty( get_plugins( '/' . sanitize_file_name( $this->slug ) ) );
			$active = is_plugin_active( $this->file );
			$demo_installed = $this->get_installed_option();

			if ( !$active && empty( $plugin_installed ) ) {
				$this->status = 'install_plugin';
			} elseif ( !$active ) {
				$this->status = 'activate_plugin';
			} elseif ( !$demo_installed ) {
				$this->status = 'install_demo';
			} else {
				$post = get_post( $demo_installed );
				if ( !is_a( $post, 'WP_Post' ) ) {
					$this->status = 'install_demo';
				} else {
					$this->status = 'done';
				}
			}

			return $this->status;
		}

		/**
		 * Is the current user allowed to install this demo content?
		 *
		 * @since 0.1
		 */
		public function current_user_can() {
			return current_user_can( 'edit_posts' );
		}

		/**
		 * Get the value of the installed option key (matches post id for demo
		 * content)
		 *
		 * @since 0.1
		 */
		public function get_installed_option() {
			return get_option( 'totc_theme_demo_content_' . sanitize_key( $this->slug ), false );
		}

		/**
		 * Get the permalink for an installed demo
		 *
		 * @since 0.1
		 */
		public function get_demo_permalink() {
			$post_id = $this->get_installed_option();
			return $post_id ? get_permalink( $post_id ) : '';
		}

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		abstract function install();
	}
}
