<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemoEventOrganiser' ) ) {
	/**
	 * Install demo content for the Event Organiser plugin
	 *
	 * @version 0.1
	 */
	class totcThemeSetupDemoEventOrganiser extends totcThemeSetupDemo {

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file = 'event-organiser/event-organiser.php';

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug = 'event-organiser';

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'calendar.title' => '',
			'event.title' => '',
			'event.content' => '',
		);

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		public function install() {

			$current = new DateTime();

			for( $i = 1; $i < 4; $i++ ) {

				eo_insert_event(

					// post data
					array(
						'post_title' => sprintf( $this->strings['event.title'], $i ),
						'post_content' => $this->strings['event.content'],
						'post_status' => 'publish',
					),

					// event data
					array(
						'start' => $current,
					)
				);

				$current->add( new DateInterval( 'P3D' ) );
			}

			$calendar_page_id = wp_insert_post( array(
				'post_title' => $this->strings['calendar.title'],
				'post_content' => '[eo_fullcalendar]',
				'post_type' => 'page',
				'post_status' => 'publish',
			) );

			$this->set_installed_option( $calendar_page_id );

			return true;
		}
	}
}
