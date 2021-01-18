<?php
/**
 * CssOutput.
 *
 * @link https://wordpress.org/plugins/kirki/
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Hooks
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Hooks;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;
use MadeByAura\Prime\Plugins\Kirki\Modules\CssOutput as CssOutputComponent;

/**
 * CssOutput.
 */
class CssOutput {
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
		// Typography CSS.
		add_filter( 'kirki_' . Base::get_info( 'prefix' ) . 'config_styles', [ __CLASS__, 'add_typography_css' ], 20 );

		// Custom CSS.
		add_filter( 'kirki_' . Base::get_info( 'prefix' ) . 'config_styles', [ __CLASS__, 'add_custom_css' ], 20 );
	}

	/**
	 * Add typography CSS to Kirki CSS.
	 *
	 * @param  array $css  Kirki CSS.
	 * @return array $css
	 */
	public static function add_typography_css( $css ) {
		// Body typography.
		$variant  = Base::get_mod( 'typography', 'body' )['variant'];
		$styles[] = [
			'selector' => ':root',
			'property' => '--aura-root__body--',
			'value'    => CssOutputComponent::parse_font_variant( $variant ),
		];

		// Heading typography.
		$variant  = Base::get_mod( 'typography', 'heading' )['variant'];
		$styles[] = [
			'selector' => ':root',
			'property' => '--aura-root__heading--',
			'value'    => CssOutputComponent::parse_font_variant( $variant ),
		];

		// Button typography.
		foreach ( Base::get_choices( 'button_css_targets' ) as  $button_type => $button_targets ) {
			if ( Base::get_mod( "button_{$button_type}", 'custom_typography' ) ) {
				$variant  = Base::get_mod( "button_{$button_type}", 'typography' )['variant'];
				$styles[] = [
					'selector' => $button_targets,
					'property' => '--aura-button--',
					'value'    => CssOutputComponent::parse_font_variant( $variant ),
				];
			}
		}

		// Add CSS.
		foreach ( $styles as $style ) {
			$selector = is_array( $style['selector'] ) ? implode( ',', $style['selector'] ) : $style['selector'];

			$css['global'][ $selector ][ $style['property'] . 'font-weight' ] = $style['value']['font-weight'];
			$css['global'][ $selector ][ $style['property'] . 'font-style' ]  = $style['value']['font-style'];
		}

		return $css;
	}

	/**
	 * Add custom CSS to Kirki CSS.
	 *
	 * @param  array $css  Kirki CSS.
	 * @return array $css
	 */
	public static function add_custom_css( $css ) {
		if ( Base::get_mod( 'advanced', 'google_recaptcha_hide_badge' ) ) {
			$css['global']['div.grecaptcha-badge']['width'] = '0!important';
		}

		return $css;
	}
}
