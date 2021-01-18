<?php
/**
 * Add customizer panels and fields using Kirki.
 *
 * @link https://wordpress.org/plugins/kirki/
 *
 * @package MadeByAura\Prime\Plugins\Kirki
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;
use MadeByAura\Prime\Plugins\Kirki\Modules\Customizer;

$group    = 'buttons';
$priority = 10;

// General > Buttons.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Buttons', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Buttons > Placeholder.
$key      = 'placeholder';
$priority = Customizer::add_field( $group, $key, $priority, [
	'type' => 'hidden',
] );

foreach ( Base::get_choices( 'button_types' ) as $button_type => $button_name ) {
	$group = "button_{$button_type}";

	// General > Button > $button_name.
	Customizer::add_section( $group, [
		'title'   => $button_name,
		'section' => Base::get_info( 'prefix' ) . 'section_buttons',
	] );

	// General > Button > $button_name > Fields.
	Customizer::add_button_fields( $group, $button_type, $priority );
}
