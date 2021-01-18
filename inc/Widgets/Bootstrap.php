<?php
/**
 * Bootstrap.
 *
 * @package MadeByAura\Prime\Widgets
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Widgets;

defined( 'ABSPATH' ) || die();

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
		Hooks\Setup::get_instance();
	}
}
