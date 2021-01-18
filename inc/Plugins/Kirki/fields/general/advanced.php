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

$group    = 'advanced';
$priority = 10;

// General > Advanced.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Advanced', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Advanced > Hide Custom Fields menu item.
$key      = 'acf_hide_menu_item';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Hide Custom Fields menu item', 'aura-prime' ),
	'type'    => 'checkbox',
	'default' => Base::set_mod_default( $group, $key, false ),
] );

// General > Advanced > Hide Google reCAPTCHA Badge.
$key      = 'google_recaptcha_hide_badge';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Hide Google reCAPTCHA v3 Badge', 'aura-prime' ),
	'type'    => 'checkbox',
	'default' => Base::set_mod_default( $group, $key, false ),
] );
