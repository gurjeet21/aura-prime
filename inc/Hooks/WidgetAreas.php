<?php
/**
 * WidgetAreas.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * WidgetAreas.
 */
class WidgetAreas {
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
		// Register widget areas.
		add_action( 'widgets_init', [ __CLASS__, 'register_widget_areas' ], 10 );
	}

	/**
	 * Register widget areas.
	 *
	 * @return void
	 */
	public static function register_widget_areas() {
		register_sidebar( [
			'name'          => esc_html__( 'Default Sidebar', 'aura-prime' ),
			'id'            => Base::get_info( 'prefix' ) . 'sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		] );
	}
}
