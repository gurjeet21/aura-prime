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

$group    = 'branding';
$priority = 10;

// Branding.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Branding', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// Branding > Browser Theme Color.
$key      = 'browser_theme_color';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Browser Theme Color', 'aura-prime' ),
	'type'    => 'color',
	'default' => Base::set_mod_default( $group, $key, '#111' ),
] );

// Branding > Logo.
$key      = 'logo';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Logo', 'aura-prime' ),
	'type'    => 'image',
	'default' => Base::set_mod_default( $group, $key, '' ),
] );

// Branding > Logo (Retina).
$key      = 'logo_2x';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Logo (Retina)', 'aura-prime' ),
	'type'    => 'image',
	'default' => Base::set_mod_default( $group, $key, '' ),
] );

// Branding > Logo.
$key      = 'logo_small';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Small Logo', 'aura-prime' ),
	'type'    => 'image',
	'default' => Base::set_mod_default( $group, $key, '' ),
] );

// Branding > Logo (Retina).
$key      = 'logo_small_2x';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Small Logo (Retina)', 'aura-prime' ),
	'type'    => 'image',
	'default' => Base::set_mod_default( $group, $key, '' ),
] );
