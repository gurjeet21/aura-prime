<?php
/**
 * Setup.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Hooks;

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
	public static function add_hooks() {
		// Register theme locations.
		add_action( 'elementor/theme/register_locations', [ __CLASS__, 'register_theme_locations' ], 20 );

		// Register widget categories.
		add_action( 'elementor/elements/categories_registered', [ __CLASS__, 'register_widget_categories' ], 20 );
	}

	/**
	 * Register theme locations.
	 *
	 * @param object $elementor_theme_manager  Elementor theme manager.
	 */
	public static function register_theme_locations( $elementor_theme_manager ) {
		$elementor_theme_manager->register_all_core_location();
	}

	/**
	 * Register widget categories.
	 *
	 * @param object $elements_manager  Elements manager instance.
	 */
	public static function register_widget_categories( $elements_manager ) {
		$elements_manager->add_category( get_template(), [
			'title' => __( 'Aura', 'aura-prime' ),
			'icon'  => 'fa fa-plug',
		] );
	}
}
