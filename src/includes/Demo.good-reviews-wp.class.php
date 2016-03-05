<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemoGoodReviewsForWordPress' ) ) {
	/**
	 * Install demo content for the Restaurant Reservations plugin
	 *
	 * @version 0.1
	 */
	class totcThemeSetupDemoGoodReviewsForWordPress extends totcThemeSetupDemo {

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file = 'good-reviews-wp/good-reviews-wp.php';

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug = 'good-reviews-wp';

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'page.title' => '',
			'post.content' => '',
			'post.title' => '',
			'post.review_url' => '',
			'post.reviewer_org' => '',
			'post.reviewer_url' => '',
		);

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		public function install() {

			for ( $i = 0; $i < 3; $i++ ) {

				$review_id = wp_insert_post( array(
					'post_status'	=> 'publish',
					'post_title'	=> sprintf( $this->strings['post.title'], $i ),
					'post_content'	=> $this->strings['post.content'],
					'post_type'		=> GRFWP_REVIEW_POST_TYPE
				) );

				update_post_meta( $review_id, 'gr_review_url', $this->strings['post.review_url'] );
				update_post_meta( $review_id, 'gr_reviewer_org', $this->strings['post.reviewer_org'] );
				update_post_meta( $review_id, 'gr_reviewer_url', $this->strings['post.reviewer_url'] );
				update_post_meta( $review_id, 'gr_reviewer_date', date( 'j M Y' ) );
				update_post_meta( $review_id, 'gr_rating', 5 );
				update_post_meta( $review_id, 'gr_rating_max', 5 );
				update_post_meta( $review_id, 'gr_rating_display', 'stars' );
			}

			$reviews_page = wp_insert_post( array(
				'post_content'	=> '[good-reviews]',
				'post_status'	=> 'publish',
				'post_title'	=> $this->strings['page.title'],
				'post_type'		=> 'page'
			) );

			$this->set_installed_option( $reviews_page );

			return true;
		}
	}
}
