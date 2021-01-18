<?php
/**
 * Elementor integeration file.
 *
 * @link https://wordpress.org/plugins/elementor/
 *
 * @package MadeByAura\Prime\Plugins\Elementor
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor;

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
		if ( Utils::is_plugin_active( 'elementor/elementor.php' ) ) {
			Hooks\Setup::get_instance();
			Hooks\Scripts::get_instance();

			Hooks\Button::get_instance();
			Hooks\DynamicTags::get_instance();
			Hooks\Widgets::get_instance();
		}
	}
}
