<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemoBusinessProfile' ) ) {
	/**
	 * Install demo content for the Business Profile plugin
	 *
	 * @version 0.1
	 */
	class totcThemeSetupDemoBusinessProfile extends totcThemeSetupDemo {

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file = 'business-profile/business-profile.php';

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug = 'business-profile';

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'title' => '',
			'address' => '',
			'phone' => '',
			'email' => '',
		);

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		public function install() {

			global $bpfwp_controller;

			$settings = get_option( 'bpfwp-settings' );

			if ( empty( $settings['address'] ) || empty( $settings['address']['text'] ) ) {
				$settings['address'] = array (
					'text'	=> $this->strings['address'],
					'lat'	=> '37.4219998',
					'lon'	=> '-122.0839596',
				);
			}

			if ( empty( $settings['phone'] ) ) {
				$settings['phone'] = $this->strings['phone'];
			}

			if ( empty( $settings['contact-email'] ) && empty( $settings['contact-page'] ) ) {
				$settings['contact-email'] = $this->strings['email'];
			}

			if ( empty( $settings['opening-hours'] ) ) {
				$settings['opening-hours'] = array(
					array(
						'weekdays'	=> array(
							'monday'	=> 1,
							'tuesday'	=> 1,
							'wednesday'	=> 1,
							'thursday'	=> 1,
						),
						'time'		=> array(
							'start'	=> '9:00 AM',
							'end'	=> '5:30 PM',
						)
					),
					array(
						'weekdays'	=> array(
							'friday'	=> 1,
							'saturday'	=> 1,
						),
						'time'		=> array(
							'start'	=> '9:00 AM',
							'end'	=> '9:30 PM',
						)
					),
				);
			}

			update_option( 'bpfwp-settings', $settings );

			// Add page
			$contact_card_page_id = wp_insert_post( array(
				'post_content'	=> '[contact-card]',
				'post_status'	=> 'publish',
				'post_title'	=> $this->strings['title'],
				'post_type'		=> 'page'
			) );

			$this->set_installed_option( $contact_card_page_id );

			return true;
		}
	}
}
