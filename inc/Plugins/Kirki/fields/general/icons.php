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

$group    = 'icons';
$priority = 10;

// Branding.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Icons', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Icons > Previous.
$key      = 'prev_fa';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Previous Icon', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'fas fa-angle-left' ),
	'choices' => Base::get_choices( 'icons' ),
] );

// General > Icons > Next.
$key      = 'next_fa';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Next Icon', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'fas fa-angle-right' ),
	'choices' => Base::get_choices( 'icons' ),
] );
