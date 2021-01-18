<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Widgets\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Widgets\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Setup.
 */
class Setup {
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
		self::add_hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @return void
	 */
	protected static function add_hooks() {
		add_action( 'widgets_init', [ __CLASS__, 'register_widgets' ], 10 );
	}

	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public static function register_widgets() {
		register_widget( Base::get_info( 'namespace' ) . '\\Widgets\\Widgets\\NavMenu' );
	}
}
