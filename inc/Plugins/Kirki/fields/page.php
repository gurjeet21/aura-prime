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

$group    = 'page';
$priority = 10;

// Page.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Pages', 'aura-prime' ),
] );

// Page > Show Title.
$key      = 'title_enabled';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Show Title', 'aura-prime' ),
	'type'    => 'checkbox',
	'default' => Base::set_mod_default( $group, $key, true ),
] );

// Page > Sidebar Position.
$key      = 'sidebar_position';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sidebar Position', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'default' ),
	'choices' => Base::get_choices( 'sidebar_position_with_default' ),
] );
