<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'totcThemeSetupDemoFoodAndDrinkMenu' ) ) {
	/**
	 * Install demo content for the Food and Drink Menu plugin
	 *
	 * @version 0.1
	 */
	class totcThemeSetupDemoFoodAndDrinkMenu extends totcThemeSetupDemo {

		/**
		 * Plugin file name
		 *
		 * @since 0.1
		 */
		public $file = 'food-and-drink-menu/food-and-drink-menu.php';

		/**
		 * Plugin slug
		 *
		 * @since 0.1
		 */
		public $slug = 'food-and-drink-menu';

		/**
		 * Translatable strings
		 *
		 * @since 0.1
		 */
		public $strings = array(
			'menu.title' => '',
			'section.starters' => '',
			'section.entrees' => '',
			'section.desserts' => '',
			'item.title' => '',
			'item.description' => '',
			'item.price' => '',
		);

		/**
		 * Install the demo content
		 *
		 * @since 0.1
		 */
		public function install() {

			$sections = array();
			$sections[] = self::create_menu_section( 'starters', $this->strings['section.starters'] );
			$sections[] = self::create_menu_section( 'entrees', $this->strings['section.entrees'] );
			$sections[] = self::create_menu_section( 'desserts', $this->strings['section.desserts'] );

			$item_count = 0;
			for ( $i = 1; $i < 11; $i++ ) {
				if ( $i < 4 ) {
					$item_id = self::create_menu_item( $i, 'starters' );
				} elseif ( $i < 10 ) {
					$item_id = self::create_menu_item( $i, 'entrees' );
				} else {
					$item_id = self::create_menu_item( $i, 'desserts' );
				}
				if ( $item_id ) {
					$item_count++;
				}
			}

			$menu_id = wp_insert_post( array(
				'post_status'    => 'publish',
				'post_title'     => $this->strings['menu.title'],
				'post_type'      => 'fdm-menu'
			) );
			update_post_meta( $menu_id, 'fdm_menu_column_one', join( ',', $sections ) );

			$this->set_installed_option( $menu_id );

			return true;
		}


		/**
		 * Create a menu section
		 *
		 * @since 0.1
		 */
		public function create_menu_section( $slug, $title ) {

			if ( term_exists( $slug, 'fdm-menu-section' ) ) {
				$section = get_term_by( 'slug', $slug, 'fdm-menu-section' );
				return $section->term_id;
			}

			$section = wp_insert_term( $title, 'fdm-menu-section', array( 'slug' => $slug ) );

			return $section['term_id'];
		}

		/**
		 * Create a menu item
		 *
		 * @since 0.1
		 */
		public function create_menu_item( $index, $section ) {

			$menu_item = array(
				'post_content'   => $this->strings['item.description'],
				'post_status'    => 'publish',
				'post_title'     => sprintf( $this->strings['item.title'], $index ),
				'post_type'      => 'fdm-menu-item',
				'tax_input'      => array( 'fdm-menu-section' => array( $section ) )
			);

			$post_id = wp_insert_post( $menu_item );
			update_post_meta( $post_id, 'fdm_item_price', $this->strings['item.price'] );

			return $post_id;
		}
	}
}
