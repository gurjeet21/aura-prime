<?php
/**
 * Widgets.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Hooks;

defined( 'ABSPATH' ) || die();

use Elementor\Plugin as Elementor;
use MadeByAura\Prime\Base;

/**
 * Widgets.
 */
class Widgets {
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
	public static function add_hooks() {
		// Register widgets.
		add_action( 'elementor/widgets/widgets_registered', [ __CLASS__, 'register_widgets' ], 20 );
	}

	/**
	 * Register widgets.
	 *
	 * @return void
	 */
	public static function register_widgets() {
		$namespace = Base::get_info( 'namespace' ) . '\\Plugins\\Elementor\\Widgets\\';

		$widgets = [
			'Button',
			'HamburgerMenu',
			'SVG',
		];

		foreach ( $widgets as $widget ) {
			$class = $namespace . $widget;

			Elementor::instance()->widgets_manager->register_widget_type( new $class() );
		}
	}
}
