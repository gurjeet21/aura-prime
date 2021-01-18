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

$group    = 'sidebar';
$priority = 10;

// General > Sidebar.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Sidebar', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Sidebar > Sidebar Position.
$key      = 'position';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sidebar Position', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'right' ),
	'choices' => Base::get_choices( 'sidebar_position' ),
] );

// General > Sidebar > Sticky Sidebar.
$key      = 'sticky_method';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sticky Method', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'last_widget' ),
	'choices' => Base::get_choices( 'sidebar_sticky_method' ),
] );
