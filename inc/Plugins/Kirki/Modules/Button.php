<?php
/**
 * Button.
 *
 * @package MadeByAura\Prime\Plugins\Kirki\Modules
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Kirki\Modules;

defined( 'ABSPATH' ) || die();

use MadeByAura\Prime\Base;

/**
 * Button.
 */
class Button {
	/**
	 * Add button fields.
	 *
	 * @param  string $group     Group.
	 * @param  string $type      Type.
	 * @param  int    $priority  Priority.
	 * @return int    $priority
	 */
	public static function add_fields( $group, $type, $priority ) {
		$default        = Data::get_default_button( $type );
		$output_element = Base::get_choices( 'button_css_targets' )[ $type ];

		// Padding.
		$key      = 'padding';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'     => esc_attr__( 'Padding', 'aura-prime' ),
			'type'      => 'dimensions',
			'default'   => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'transport' => 'auto',
			'output'    => [
				[
					'element'  => $output_element,
					'property' => '--aura-button--padding',
				],
			],
		] );

		// Border Width.
		$key      = 'border_width';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'     => esc_attr__( 'Border Width', 'aura-prime' ),
			'type'      => 'dimensions',
			'default'   => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'transport' => 'auto',
			'output'    => [
				[
					'element'  => $output_element,
					'property' => '--aura-button--border',
				],
			],
		] );

		// Border Radius.
		$key      = 'border_radius';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'     => esc_attr__( 'Border Radius', 'aura-prime' ),
			'type'      => 'dimensions',
			'default'   => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'transport' => 'auto',
			'output'    => [
				[
					'element'  => $output_element,
					'property' => '--aura-button--border',
				],
			],
		] );

		// Icon.
		$key      = 'icon_type';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'   => esc_attr__( 'Icon', 'aura-prime' ),
			'type'    => 'select',
			'default' => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices' => [
				'none'         => esc_attr__( 'None', 'aura-prime' ),
				'default'      => esc_attr__( 'Default', 'aura-prime' ),
				'font_awesome' => esc_attr__( 'Font Awesome', 'aura-prime' ),
			],
		] );

		// Font Awesome Icon.
		$key      = 'icon_font_awesome_class';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Font Awesome Icon', 'aura-prime' ),
			'type'            => 'select',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices'         => Base::get_choices( 'icons' ),
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_icon_type",
					'operator' => '==',
					'value'    => 'font_awesome',
				],
			],
		] );

		// Icon Position.
		$key      = 'icon_position';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Icon Position', 'aura-prime' ),
			'type'            => 'select',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices'         => [
				'before_text' => esc_attr__( 'Before Text', 'aura-prime' ),
				'after_text'  => esc_attr__( 'After Text', 'aura-prime' ),
			],
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_icon_type",
					'operator' => '!=',
					'value'    => 'none',
				],
			],
		] );

		// Icon Space.
		$key      = 'icon_space';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Icon Space', 'aura-prime' ),
			'type'            => 'slider',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices'         => [
				'min'  => '0',
				'max'  => '20',
				'step' => '1',
			],
			'transport'       => 'auto',
			'output'          => [
				[
					'element'  => $output_element,
					'property' => '--aura-button__icon--space',
					'units'    => 'px',
				],
			],
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_icon_type",
					'operator' => '!=',
					'value'    => 'none',
				],
			],
		] );

		// Custom Typography.
		$key      = 'custom_typography';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'   => esc_attr__( 'Custom Typography', 'aura-prime' ),
			'type'    => 'toggle',
			'default' => Base::set_mod_default( $group, $key, $default[ $key ] ),
		] );

		// Typography.
		$key      = 'typography';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Typography', 'aura-prime' ),
			'type'            => 'typography',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'output'          => [
				[
					'choice'   => 'font-family',
					'element'  => $output_element,
					'property' => '--aura-button--font-family',
				],
				[
					'choice'   => 'font-size',
					'element'  => $output_element,
					'property' => '--aura-button--font-size',
				],
				[
					'choice'   => 'line-height',
					'element'  => $output_element,
					'property' => '--aura-button--line-height',
				],
				[
					'choice'   => 'text-transform',
					'element'  => $output_element,
					'property' => '--aura-button--text-transform',
				],
				[
					'choice'   => 'letter-spacing',
					'element'  => $output_element,
					'property' => '--aura-button--letter-spacing',
				],
			],
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_custom_typography",
					'operator' => '==',
					'value'    => true,
				],
			],
		] );

		// Custom Colors.
		$key      = 'custom_colors';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'   => esc_attr__( 'Custom Colors', 'aura-prime' ),
			'type'    => 'toggle',
			'default' => Base::set_mod_default( $group, $key, $default[ $key ] ),
		] );

		// Colors.
		$key      = 'colors';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Colors', 'aura-prime' ),
			'type'            => 'multicolor',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices'         => [
				'color'      => esc_attr__( 'Color', 'aura-prime' ),
				'background' => esc_attr__( 'Background Color', 'aura-prime' ),
				'border'     => esc_attr__( 'Border', 'aura-prime' ),
			],
			'transport'       => 'auto',
			'output'          => [
				[
					'choice'   => 'color',
					'element'  => $output_element,
					'property' => '--aura-button--color',
				],
				[
					'choice'   => 'background',
					'element'  => $output_element,
					'property' => '--aura-button--background-color',
				],
				[
					'choice'   => 'border',
					'element'  => $output_element,
					'property' => '--aura-button--border-color',
				],
			],
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_custom_colors",
					'operator' => '==',
					'value'    => true,
				],
			],
		] );

		// Hover Colors.
		$key      = 'hover_colors';
		$priority = Customizer::add_field( $group, $key, $priority, [
			'label'           => esc_attr__( 'Hover Colors', 'aura-prime' ),
			'type'            => 'multicolor',
			'default'         => Base::set_mod_default( $group, $key, $default[ $key ] ),
			'choices'         => [
				'color'      => esc_attr__( 'Color', 'aura-prime' ),
				'background' => esc_attr__( 'Background Color', 'aura-prime' ),
				'border'     => esc_attr__( 'Border', 'aura-prime' ),
			],
			'transport'       => 'auto',
			'output'          => [
				[
					'choice'   => 'color',
					'element'  => $output_element,
					'property' => '--aura-button__hover--color',
				],
				[
					'choice'   => 'background',
					'element'  => $output_element,
					'property' => '--aura-button__hover--background-color',
				],
				[
					'choice'   => 'border',
					'element'  => $output_element,
					'property' => '--aura-button__hover--border-color',
				],
			],
			'active_callback' => [
				[
					'setting'  => Base::get_info( 'prefix' ) . "{$group}_custom_colors",
					'operator' => '==',
					'value'    => true,
				],
			],
		] );

		return $priority;
	}
}
