<?php
/**
 * Sidebar.
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\WPTools\Utils;
use MadeByAura\Prime\Base;

/**
 * Sidebar.
 */
class Sidebar {
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
		// Disable sidebar on WooCommerce pages.
		add_filter( 'aura_theme_sidebar_widget_area', [ __CLASS__, 'set_shop_widget_area' ], 20 );
	}

	/**
	 * Disable sidebar on WooCommerce pages.
	 *
	 * @param  string $widget_area  ID of widget area.
	 * @return string
	 */
	public static function set_shop_widget_area( $widget_area ) {
		if ( Utils::is_wc_page() ) {
			$widget_area = Base::get_info( 'prefix' ) . 'shop-sidebar';
		}

		return $widget_area;
	}
}
