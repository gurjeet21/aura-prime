<?php
/**
 * Menu.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Menu.
 */
class Menu {
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
		self::register_filters();
	}

	/**
	 * Register filters.
	 *
	 * @return void
	 */
	protected static function register_filters() {
		// Add choices.
		add_filter( 'aura_theme_choices_menus', [ __CLASS__, 'get_choices' ], 20 );

		// Nav Menu Widget.
		add_filter( 'aura_theme_script_app_js_object', [ __CLASS__, 'add_js_object_properties_nav_menu_widget' ], 20 );
	}

	/**
	 * Get menu choices.
	 *
	 * @return array $choices
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices = get_terms( [
				'taxonomy' => 'nav_menu',
				'fields'   => 'id=>name',
			] );
		}

		return $choices;
	}

	/**
	 * Add properties for Nav Menu Widget to the javascript object.
	 *
	 * @param  array $object  Javascript object.
	 * @return array $object  Javascript object.
	 */
	public static function add_js_object_properties_nav_menu_widget( $object ) {
		$object['navMenuWidget'] = [
			'open'  => esc_html__( 'Open Sub Menu', 'aura-prime' ),
			'close' => esc_html__( 'Close Sub Menu', 'aura-prime' ),
		];

		return $object;
	}
}
