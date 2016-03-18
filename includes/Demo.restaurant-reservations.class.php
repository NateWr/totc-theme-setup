<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemoRestaurantReservations' ) ) {
	/**
	 * Install demo content for the Restaurant Reservations plugin
	 *
	 * @version 0.1
	 */
	class totcThemeSetupDemoRestaurantReservations extends totcThemeSetupDemo {

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file = 'restaurant-reservations/restaurant-reservations.php';

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug = 'restaurant-reservations';

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'post.content' => '',
			'post.title' => '',
		);

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		public function install() {

			global $rtb_controller;

			$booking_page = $rtb_controller->settings->get_setting( 'booking-page' );

			if ( empty( $booking_page ) ) {

				$booking_page = wp_insert_post( array(
					'post_content'  => $this->strings['post.content'],
					'post_status'	=> 'publish',
					'post_title'	=> $this->strings['post.title'],
					'post_type'		=> 'page'
				) );

				$settings = get_option( 'rtb-settings' );
				$settings['booking-page'] = $booking_page;
				update_option( 'rtb-settings', $settings );
			}

			$this->set_installed_option( $booking_page );

			return true;
		}
	}
}
