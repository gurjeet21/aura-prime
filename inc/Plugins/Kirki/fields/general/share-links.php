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

$group    = 'share_links';
$priority = 10;

// General > Social Links.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Share Links', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Social Links > Sites.
$key      = 'sites';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Sites', 'aura-prime' ),
	'type'    => 'sortable',
	'default' => Base::set_mod_default( $group, $key, [
		'facebook',
		'twitter',
		'pinterest',
		'linkedin',
		'reddit',
		'email',
	] ),
	'choices' => Base::get_choices( 'share_links' ),
] );

// General > Social Links > Twitter Username.
$key      = 'twitter_username';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'           => esc_attr__( 'Twitter Username', 'aura-prime' ),
	'type'            => 'text',
	'default'         => Base::set_mod_default( $group, $key, '' ),
	'active_callback' => [ __NAMESPACE__ . '\\Modules\\Callbacks', $group . '_' . $key ],
] );
