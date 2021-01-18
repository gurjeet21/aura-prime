<?php
/**
 * ACF Pro compatibility file.
 *
 * @link https://www.advancedcustomfields.com/pro/
 *
 * @package MadeByAura\Prime\Plugins\ACFPro
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\ACFPro;

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
		if ( Utils::is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
			Hooks\Setup::get_instance();
			Hooks\Scripts::get_instance();
			Hooks\OptionPage::get_instance();
			Hooks\DynamicChoices::get_instance();
		}
	}
}
