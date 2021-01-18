<?php
/**
 * Data.
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Data.
 */
class Data {
	/**
	 * Get mod.
	 *
	 * @param  string $group  Group.
	 * @param  string $key    Key.
	 * @return mixed
	 */
	public static function get( $group, $key ) {
		$id = $group . '_' . sanitize_key( $key );

		$value = get_theme_mod( Base::get_info( 'prefix' ) . $id, self::get_default( $group, $key ) );
		$value = apply_filters( 'aura_theme_mods_value', $value, $group, $key );
		$value = apply_filters( "aura_theme_mods_value_{$key}", $value, $group, $key );

		return $value;
	}

	/**
	 * Get default mod.
	 *
	 * @param  string $group  Group.
	 * @param  string $key    Key.
	 * @return mixed
	 */
	public static function get_default( $group, $key ) {
		$id = $group . '_' . sanitize_key( $key );

		$value = '';
		$value = apply_filters( 'aura_theme_mods_default', $value, $group, $key );
		$value = apply_filters( "aura_theme_mods_default_{$id}", $value, $group, $key );

		return $value;
	}

	/**
	 * Get default color.
	 *
	 * @param  string $element   Element.
	 * @param  string $property  Property.
	 * @return string
	 */
	public static function get_default_color( $element, $property = '' ) {
		static $colors;

		if ( empty( $colors ) ) {
			// Accent.
			$colors['accent']['normal'] = '#0274be';
			$colors['accent']['text']   = '#fff';
			// Heading colors.
			$colors['heading']['text']  = '#111';
			$colors['heading']['link']  = '#111';
			$colors['heading']['hover'] = '#555';
			// Body colors.
			$colors['body']['text']  = '#555';
			$colors['body']['link']  = '#0274be';
			$colors['body']['hover'] = '#111';
			$colors['body']['light'] = '#999';
			$colors['body']['muted'] = '#bbb';
			// General colors.
			$colors['general']['border']         = '#eee';
			$colors['general']['background']     = '#fff';
			$colors['general']['background_alt'] = '#eee';
		}

		if ( $property ) {
			return $colors[ $element ] [ $property ];
		} else {
			return $colors[ $element ];
		}
	}

	/**
	 * Get default typography.
	 *
	 * @param  string $element   Element.
	 * @param  string $property  Property.
	 * @return string
	 */
	public static function get_default_typography( $element, $property = '' ) {
		static $typography;

		if ( empty( $typography ) ) {
			// Body.
			$typography['body'] = [
				'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
				'variant'        => 'regular',
				'font-size'      => '16px',
				'line-height'    => '1.6',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
			];

			// Heading.
			$typography['heading'] = [
				'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
				'variant'        => '700',
				'font-size'      => '21px',
				'line-height'    => '1.2',
				'letter-spacing' => '0px',
				'text-transform' => 'none',
			];
		}

		if ( $property ) {
			return $typography[ $element ] [ $property ];
		} else {
			return $typography[ $element ];
		}
	}

	/**
	 * Get default button.
	 *
	 * @param  string $element   Element.
	 * @param  string $property  Property.
	 * @return string
	 */
	public static function get_default_button( $element, $property = '' ) {
		static $buttons;

		if ( empty( $buttons ) ) {
			foreach ( Base::get_choices( 'button_types' ) as $button_id => $button_title ) {
				$button['padding'] = [
					'top'    => '10px',
					'right'  => '16px',
					'bottom' => '10px',
					'left'   => '16px',
				];

				// Border width.
				$button['border_width'] = [
					'top-width'    => '0px',
					'right-width'  => '0px',
					'bottom-width' => '0px',
					'left-width'   => '0px',
				];

				// Border radius.
				$button['border_radius'] = [
					'top-left-radius'     => '0px',
					'top-right-radius'    => '0px',
					'bottom-left-radius'  => '0px',
					'bottom-right-radius' => '0px',
				];

				// Icon.
				$button['icon_type']               = 'default';
				$button['icon_font_awesome_class'] = 'fas fa-angle-right';
				$button['icon_position']           = 'after_text';
				$button['icon_space']              = '5';

				// Typography.
				$button['custom_typography']         = false;
				$button['typography']                = self::get_default_typography( 'body' );
				$button['typography']['font-size']   = '14px';
				$button['typography']['line-height'] = '1.2';

				// Colors.
				$button['custom_colors'] = false;
				$button['colors']        = [
					'color'      => self::get_default_color( 'accent', 'text' ),
					'background' => self::get_default_color( 'accent', 'normal' ),
					'border'     => self::get_default_color( 'accent', 'normal' ),
				];
				$button['hover_colors']  = [
					'color'      => self::get_default_color( 'accent', 'text' ),
					'background' => '#555',
					'border'     => '#555',
				];

				// Overrides for text button.
				if ( 'beta' === $button_id ) {
					$button['typography']['font-family'] = self::get_default_typography( 'body', 'font-family' );
					$button['typography']['variant']     = self::get_default_typography( 'body', 'variant' );

					$button['padding'] = [
						'top'    => '0px',
						'right'  => '0px',
						'bottom' => '0px',
						'left'   => '0px',
					];

					$button['colors'] = [
						'color'      => self::get_default_color( 'body', 'link' ),
						'background' => 'rgba(0,0,0,0)',
						'border'     => 'rgba(0,0,0,0)',
					];

					$button['hover_colors'] = [
						'color'      => self::get_default_color( 'body', 'hover' ),
						'background' => 'rgba(0,0,0,0)',
						'border'     => 'rgba(0,0,0,0)',
					];
				}

				$buttons[ $button_id ] = $button;
			}
		}

		if ( $property ) {
			return $buttons[ $element ] [ $property ];
		} else {
			return $buttons[ $element ];
		}
	}
}
