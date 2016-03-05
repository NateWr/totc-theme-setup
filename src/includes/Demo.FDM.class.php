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
	}
}
