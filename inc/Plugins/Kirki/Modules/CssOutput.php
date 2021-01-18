<?php
/**
 * CssOutput.
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Modules;

defined( 'ABSPATH' ) || die();

/**
 * CssOutput.
 */
class CssOutput {
	/**
	 * Get font weight and font style from font variant.
	 *
	 * @param  string $variant  Font variant.
	 * @return array  $property
	 */
	public static function parse_font_variant( $variant ) {
		// Font weight.
		$property['font-weight'] = str_replace( 'italic', '', $variant );
		$property['font-weight'] = ( in_array( $property['font-weight'], array( '', 'regular' ), true ) ) ? '400' : $property['font-weight'];

		// Font style.
		$property['font-style'] = ( false === strpos( $variant, 'italic' ) ) ? 'normal' : 'italic';

		return $property;
	}
}
