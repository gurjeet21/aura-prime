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

$group    = 'post';
$priority = 10;

// Single Post.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Single Post', 'aura-prime' ),
] );

// Single Post.
$key      = 'sidebar_position';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sidebar Position', 'aura-prime' ),
	'type'    => 'select',
	'default' => Base::set_mod_default( $group, $key, 'default' ),
	'choices' => Base::get_choices( 'sidebar_position_with_default' ),
] );
