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

$group    = 'typography';
$priority = 10;

// General > Typography.
Customizer::add_section( $group, [
	'title' => esc_attr__( 'Typography', 'aura-prime' ),
	'panel' => Base::get_info( 'prefix' ) . 'panel_general',
] );

// General > Typography > Body.
$key      = 'body';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Body', 'aura-prime' ),
	'type'    => 'typography',
	'default' => Base::set_mod_default( $group, $key, Data::get_default_typography( 'body' ) ),
	'choices' => [
		'variant' => [
			'regular',
			'italic',
			'700',
			'700italic',
		],
	],
	'output'  => [
		[
			'choice'   => 'font-family',
			'element'  => ':root',
			'property' => '--aura-root__body--font-family',
		],
		[
			'choice'   => 'font-size',
			'element'  => ':root',
			'property' => '--aura-root__body--font-size',
		],
		[
			'choice'   => 'line-height',
			'element'  => ':root',
			'property' => '--aura-root__body--line-height',
		],
		[
			'choice'   => 'text-transform',
			'element'  => ':root',
			'property' => '--aura-root__body--text-transform',
		],
		[
			'choice'   => 'letter-spacing',
			'element'  => ':root',
			'property' => '--aura-root__body--letter-spacing',
		],
	],
] );

// General > Typography > Headings.
$key      = 'heading';
$priority = Customizer::add_field( $group, $key, $priority, [
	'label'   => esc_attr__( 'Headings', 'aura-prime' ),
	'type'    => 'typography',
	'default' => Base::set_mod_default( $group, $key, [
		'font-family' => Data::get_default_typography( 'heading', 'font-family' ),
		'variant'     => Data::get_default_typography( 'heading', 'variant' ),
	] ),
	'choices' => [
		'variant' => [
			'regular',
			'italic',
			'700',
			'700italic',
		],
	],
	'output'  => [
		[
			'choice'   => 'font-family',
			'element'  => ':root',
			'property' => '--aura-root__heading--font-family',
		],
	],
] );

$headings = [
	'h1' => [
		'label'       => esc_attr__( 'H1', 'aura-prime' ),
		'font-size'   => '36px',
		'line-height' => '1',
		'mobile'      => [
			'font-size'   => '27px',
			'line-height' => '1.1',
		],
	],
	'h2' => [
		'label'       => esc_attr__( 'H2', 'aura-prime' ),
		'font-size'   => '27px',
		'line-height' => '1.1',
		'mobile'      => [
			'font-size'   => '24px',
			'line-height' => '1.2',
		],
	],
	'h3' => [
		'label'       => esc_attr__( 'H3', 'aura-prime' ),
		'font-size'   => '24px',
		'line-height' => '1.2',
		'mobile'      => [
			'font-size'   => '21px',
			'line-height' => '1.2',
		],
	],
	'h4' => [
		'label'       => esc_attr__( 'H4', 'aura-prime' ),
		'font-size'   => '21px',
		'line-height' => '1.2',
		'mobile'      => [
			'font-size'   => '21px',
			'line-height' => '1.2',
		],
	],
	'h5' => [
		'label'       => esc_attr__( 'H5', 'aura-prime' ),
		'font-size'   => '21px',
		'line-height' => '1.2',
		'mobile'      => [
			'font-size'   => '21px',
			'line-height' => '1.2',
		],
	],
	'h6' => [
		'label'       => esc_attr__( 'H6', 'aura-prime' ),
		'font-size'   => '21px',
		'line-height' => '1.2',
		'mobile'      => [
			'font-size'   => '21px',
			'line-height' => '1.2',
		],
	],
];

foreach ( $headings as $heading_tag => $heading ) {
	// General > Typography > $heading['label'] (Collapsible).
	$priority = Customizer::add_collapsible( $group, $heading_tag, $priority, [
		'title' => $heading['label'],
	] );

	// General > Typography > $heading['label'].
	$key      = $heading_tag;
	$priority = Customizer::add_field( $group, $key, $priority, [
		'label'     => $heading['label'],
		'type'      => 'typography',
		'default'   => Base::set_mod_default( $group, $key, [
			'font-size'      => $heading['font-size'],
			'line-height'    => $heading['line-height'],
			'letter-spacing' => Data::get_default_typography( 'heading', 'letter-spacing' ),
			'text-transform' => Data::get_default_typography( 'heading', 'text-transform' ),
		] ),
		'transport' => 'auto',
		'output'    => [
			[
				'choice'   => 'font-size',
				'element'  => $heading_tag,
				'property' => '--aura-root__heading--font-size',
			],
			[
				'choice'   => 'line-height',
				'element'  => $heading_tag,
				'property' => '--aura-root__heading--line-height',
			],
			[
				'choice'   => 'text-transform',
				'element'  => $heading_tag,
				'property' => '--aura-root__heading--text-transform',
			],
			[
				'choice'   => 'letter-spacing',
				'element'  => $heading_tag,
				'property' => '--aura-root__heading--letter-spacing',
			],
		],
	] );

	// General > Typography > $heading['label'] (Mobile).
	$key      = $heading_tag . '_mobile';
	$priority = Customizer::add_field( $group, $key, $priority, [
		// Translators: 1: Heading Title.
		'label'     => esc_attr( sprintf( __( '%1$s (Mobile)', 'aura-prime' ), $heading['label'] ) ),
		'type'      => 'typography',
		'default'   => Base::set_mod_default( $group, $key, [
			'font-size'      => $heading['mobile']['font-size'],
			'line-height'    => $heading['mobile']['line-height'],
			'letter-spacing' => Data::get_default_typography( 'heading', 'letter-spacing' ),
			'text-transform' => Data::get_default_typography( 'heading', 'text-transform' ),
		] ),
		'transport' => 'auto',
		'output'    => [
			[
				'choice'      => 'font-size',
				'element'     => $heading_tag,
				'property'    => '--aura-root__heading--font-size',
				'media_query' => '@media (max-width: 425px)',
			],
			[
				'choice'      => 'line-height',
				'element'     => $heading_tag,
				'property'    => '--aura-root__heading--line-height',
				'media_query' => '@media (max-width: 425px)',
			],
			[
				'choice'      => 'text-transform',
				'element'     => $heading_tag,
				'property'    => '--aura-root__heading--text-transform',
				'media_query' => '@media (max-width: 425px)',
			],
			[
				'choice'      => 'letter-spacing',
				'element'     => $heading_tag,
				'property'    => '--aura-root__heading--letter-spacing',
				'media_query' => '@media (max-width: 425px)',
			],
		],
	] );
}
