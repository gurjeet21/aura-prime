<?php
/**
 * Yoast WordPress Seo compatibility file.
 *
 * @link https://wordpress.org/plugins/wordpress-seo/
 *
 * @package MadeByAura\Prime\Plugins\WordpressSeo
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WordpressSeo;

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
		if ( Utils::is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
			Hooks\Setup::get_instance();
		}
	}
}
