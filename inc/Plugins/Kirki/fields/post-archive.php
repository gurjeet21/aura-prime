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

$group    = 'post_archive';
$priority = 10;

// Post Archive.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Blog / Post Archive', 'aura-prime' ),
] );

// Post Archive > Sidebar Position.
$key      = 'sidebar_position';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sidebar Position', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'default' ),
	'choices' => Base::get_choices( 'sidebar_position_with_default' ),
] );

// Post Archive > Layout.
$key      = 'post_layout';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Layout', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'list' ),
	'choices' => Base::get_choices( 'post_layout' ),
] );

// Post Archive > Pagination.
$key      = 'pagination_type';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Pagination', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'links' ),
	'choices' => Base::get_choices( 'pagination_type' ),
] );
