<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce\Hooks;

defined( 'ABSPATH' ) || die();

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
		// Add theme support for WooCommerce.
		add_filter( 'after_setup_theme', [ __CLASS__, 'add_theme_support' ], 20 );
	}

	/**
	 * Add theme support for WooCommerce.
	 *
	 * @return void
	 */
	public static function add_theme_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
