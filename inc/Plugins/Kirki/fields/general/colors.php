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
use MadeByAura\Prime\Plugins\Kirki\Modules\Data;

$group    = 'colors';
$priority = 10;

// General > Colors.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Colors', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Colors > Accent.
$key      = 'accent';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'     => esc_attr__( 'Accent', 'aura-prime' ),
	'type'      => 'multicolor',
	'default'   => Base::set_mod_default( $group, $key, [
		'normal' => Data::get_default_color( 'accent', 'normal' ),
		'text'   => Data::get_default_color( 'accent', 'text' ),
	] ),
	'choices'   => [
		'normal' => esc_attr__( 'Accent', 'aura-prime' ),
		'text'   => esc_attr__( 'Text on Accent', 'aura-prime' ),
	],
	'transport' => 'auto',
	'output'    => [
		[
			'choice'   => 'normal',
			'element'  => ':root',
			'property' => '--aura-root__accent--color',
		],
		[
			'choice'   => 'text',
			'element'  => ':root',
			'property' => '--aura-root__accent--text-color',
		],
	],
] );

// General > Colors > Heading.
$key      = 'heading';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'     => esc_attr__( 'Heading', 'aura-prime' ),
	'type'      => 'multicolor',
	'default'   => Base::set_mod_default( $group, $key, [
		'text'  => Data::get_default_color( 'heading', 'text' ),
		'link'  => Data::get_default_color( 'heading', 'link' ),
		'hover' => Data::get_default_color( 'heading', 'hover' ),
	] ),
	'choices'   => [
		'text'  => esc_attr__( 'Text', 'aura-prime' ),
		'link'  => esc_attr__( 'Link', 'aura-prime' ),
		'hover' => esc_attr__( 'Hover', 'aura-prime' ),
	],
	'transport' => 'auto',
	'output'    => [
		[
			'choice'   => 'text',
			'element'  => ':root',
			'property' => '--aura-root__heading--color',
		],
		[
			'choice'   => 'link',
			'element'  => ':root',
			'property' => '--aura-root__heading--link-color',
		],
		[
			'choice'   => 'hover',
			'element'  => ':root',
			'property' => '--aura-root__heading--hover-color',
		],
	],
] );

// General > Colors > Body.
$key      = 'body';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'     => esc_attr__( 'Body', 'aura-prime' ),
	'type'      => 'multicolor',
	'default'   => Base::set_mod_default( $group, $key, [
		'text'  => Data::get_default_color( 'body', 'text' ),
		'link'  => Data::get_default_color( 'body', 'link' ),
		'hover' => Data::get_default_color( 'body', 'hover' ),
		'light' => Data::get_default_color( 'body', 'light' ),
		'muted' => Data::get_default_color( 'body', 'muted' ),
	] ),
	'choices'   => [
		'text'  => esc_attr__( 'Text', 'aura-prime' ),
		'link'  => esc_attr__( 'Link', 'aura-prime' ),
		'hover' => esc_attr__( 'Hover', 'aura-prime' ),
		'light' => esc_attr__( 'Light', 'aura-prime' ),
		'muted' => esc_attr__( 'Muted', 'aura-prime' ),
	],
	'transport' => 'auto',
	'output'    => [
		[
			'choice'   => 'text',
			'element'  => ':root',
			'property' => '--aura-root__body--color',
		],
		[
			'choice'   => 'link',
			'element'  => ':root',
			'property' => '--aura-root__body--link-color',
		],
		[
			'choice'   => 'hover',
			'element'  => ':root',
			'property' => '--aura-root__body--hover-color',
		],
		[
			'choice'   => 'light',
			'element'  => ':root',
			'property' => '--aura-root__body--light-color',
		],
		[
			'choice'   => 'muted',
			'element'  => ':root',
			'property' => '--aura-root__body--muted-color',
		],
	],
] );

// General > Colors > General.
$key      = 'general';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'     => esc_attr__( 'General', 'aura-prime' ),
	'type'      => 'multicolor',
	'default'   => Base::set_mod_default( $group, $key, [
		'border'         => Data::get_default_color( 'general', 'border' ),
		'background'     => Data::get_default_color( 'general', 'background' ),
		'background_alt' => Data::get_default_color( 'general', 'background_alt' ),
	] ),
	'choices'   => [
		'border'         => esc_attr__( 'Borders', 'aura-prime' ),
		'background'     => esc_attr__( 'Background', 'aura-prime' ),
		'background_alt' => esc_attr__( 'Background (Alternate)', 'aura-prime' ),
	],
	'transport' => 'auto',
	'output'    => [
		[
			'choice'   => 'border',
			'element'  => ':root',
			'property' => '--aura-root__general--border-color',
		],
		[
			'choice'   => 'background',
			'element'  => ':root',
			'property' => '--aura-root__general--background-color',
		],
		[
			'choice'   => 'background_alt',
			'element'  => ':root',
			'property' => '--aura-root__general--background-alt-color',
		],
	],
] );
