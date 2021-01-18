<?php
/**
 * Button.
 *
 * @package MadeByAura\Prime\Plugins\WooCommerce\Hooks
 * @author  Incedia.com
 */

namespace MadeByAura\Prime\Plugins\WooCommerce\Hooks;

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
				'.woocommerce #respond input#submit',
				'.woocommerce a.button',
				'.woocommerce button.button',
				'.woocommerce input.button',
				'.woocommerce #respond input#submit.alt',
				'.woocommerce a.button.alt',
				'.woocommerce button.button.alt',
				'.woocommerce input.button.alt',
				'.woocommerce #respond input#submit.disabled',
				'.woocommerce #respond input#submit:disabled',
				'.woocommerce #respond input#submit:disabled[disabled]',
				'.woocommerce a.button.disabled',
				'.woocommerce a.button:disabled',
				'.woocommerce a.button:disabled[disabled]',
				'.woocommerce button.button.disabled',
				'.woocommerce button.button:disabled',
				'.woocommerce button.button:disabled[disabled]',
				'.woocommerce input.button.disabled',
				'.woocommerce input.button:disabled',
				'.woocommerce input.button:disabled[disabled]',
				'.woocommerce #respond input#submit.alt.disabled',
				'.woocommerce #respond input#submit.alt:disabled',
				'.woocommerce #respond input#submit.alt:disabled[disabled]',
				'.woocommerce a.button.alt.disabled',
				'.woocommerce a.button.alt:disabled',
				'.woocommerce a.button.alt:disabled[disabled]',
				'.woocommerce button.button.alt.disabled',
				'.woocommerce button.button.alt:disabled',
				'.woocommerce button.button.alt:disabled[disabled]',
				'.woocommerce input.button.alt.disabled',
				'.woocommerce input.button.alt:disabled',
				'.woocommerce input.button.alt:disabled[disabled]',
			] );
		}

		return $choices;
	}
}
