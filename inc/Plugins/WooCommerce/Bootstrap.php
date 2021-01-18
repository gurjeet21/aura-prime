<?php
/**
 * WooCommerce integeration file.
 *
 * @link https://wordpress.org/plugins/woocommerce/
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;

/**
 * Bootstrap.
 */
class Bootstrap {
	/**
	 * Instance.
	 *
	 * @var object  Class object.
	 */
	private static $instance;

	/**
	 * Instantiator.
	 *
	 * @return object  Class instance.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	protected function __construct() {
		if ( Utils::is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			Hooks\Setup::get_instance();
			Hooks\Scripts::get_instance();
			Hooks\WidgetAreas::get_instance();
			Hooks\Wrappers::get_instance();
			Hooks\Button::get_instance();
			Hooks\General::get_instance();
			Hooks\Sidebar::get_instance();
		}
	}
}
