<?php
/**
 * Button.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Hooks
 * @author  Incedia.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Hooks;

defined( 'ABSPATH' ) || die();

/**
 * Button.
 */
class Button {
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
		add_filter( 'aura_theme_choices_button_css_targets', [ __CLASS__, 'add_css_targets' ], 30 );
	}

	/**
	 * Add CSS targets.
	 *
	 * @param  array $choices  CSS targets.
	 * @return array
	 */
	public static function add_css_targets( $choices ) {
		if ( isset( $choices['alpha'] ) && is_array( $choices['alpha'] ) ) {
			$choices['alpha'] = array_merge( $choices['alpha'], [
				'.elementor-menu-cart__footer-buttons .elementor-button',
			] );
		}

		return $choices;
	}
}
