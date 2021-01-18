<?php
/**
 * Button.
 *
 * @package MadeByAura\Prime\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

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
		// Add choices.
		add_filter( 'aura_theme_choices_button_types', [ __CLASS__, 'get_choices' ], 20 );
		add_filter( 'aura_theme_choices_button_css_targets', [ __CLASS__, 'get_css_targets' ], 20 );

		// Set default icon.
		add_filter( 'aura/wp-tools/view/button/data', [ __CLASS__, 'set_default_icon' ], 20 );
	}

	/**
	 * Get button choices.
	 *
	 * @return array $choices  Button choices.
	 */
	public static function get_choices() {
		static $choices;

		if ( ! $choices ) {
			$choices['alpha'] = __( 'Alpha Button', 'aura-prime' );
			$choices['beta']  = __( 'Beta Button', 'aura-prime' );
			$choices['gamma'] = __( 'Gamma Button', 'aura-prime' );
		}

		return $choices;
	}

	/**
	 * Get button css targets.
	 *
	 * @return array $choices  Button css targets.
	 */
	public static function get_css_targets() {
		static $choices;

		if ( ! $choices ) {
			$choices['alpha'] = [
				'button',
				'input[type="button"]',
				'input[type="submit"]',
				'input[type="reset"]',
				'.aura-button--type-alpha',
			];

			$choices['beta']  = '.aura-button--type-beta';
			$choices['gamma'] = '.aura-button--type-gamma';
		}

		return $choices;
	}

	/**
	 * Add icon and position from theme mods.
	 *
	 * @param  array $data  Button view data.
	 * @return array
	 */
	public static function set_default_icon( $data ) {
		$type      = empty( $data['type'] ) ? 'alpha' : $data['type'];
		$icon_type = Base::get_mod( "button_{$type}", 'icon_type' );

		if ( 'none' === $icon_type ) {
			return $data;
		}

		if ( empty( $data['icon_font_class'] ) ) {
			if ( 'default' === $icon_type ) {
				$data['icon_font_class'] = Base::get_mod( 'icons', 'next_fa' );
			} elseif ( 'font_awesome' === $icon_type ) {
				if ( Base::get_mod( "button_{$type}", 'icon_font_awesome_class' ) ) {
					$data['icon_font_class'] = Base::get_mod( "button_{$type}", 'icon_font_awesome_class' );
				}
			}
		}

		if ( empty( $data['icon_position'] ) ) {
			if ( Base::get_mod( "button_{$type}", 'icon_position' ) ) {
				$data['icon_position'] = Base::get_mod( "button_{$type}", 'icon_position' );
			}
		}

		return $data;
	}
}
