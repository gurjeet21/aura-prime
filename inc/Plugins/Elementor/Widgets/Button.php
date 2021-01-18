<?php
/**
 * Elementor widget Button.
 *
 * @package MadeByAura\Prime\Plugins\Elementor\Widgets
 * @author  MadeByAura.com
 */

namespace MadeByAura\Prime\Plugins\Elementor\Widgets;

defined( 'ABSPATH' ) || die();

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use MadeByAura\Prime\Base;

/**
 * Elementor widget Button.
 */
class Button extends Widget_Base {
	/**
	 * Get the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return get_template() . '-button';
	}

	/**
	 * Get the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Button', 'aura-prime' );
	}

	/**
	 * Get the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'aura', 'button' ];
	}

	/**
	 * Get the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-dual-button';
	}

	/**
	 * Get the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ get_template() ];
	}

	/**
	 * Get the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section( 'section_content', [
			'label' => __( 'Button', 'aura-prime' ),
		] );

		$this->add_control( 'type', [
			'label'   => __( 'Type', 'aura-prime' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'alpha',
			'options' => Base::get_choices( 'button_types' ),
		] );

		$this->add_control( 'text', [
			'type'    => Controls_Manager::TEXT,
			'label'   => __( 'Text', 'aura-prime' ),
			'dynamic' => [ 'active' => true ],
			'default' => __( 'Button', 'aura-prime' ),
		] );

		$this->add_control( 'url', [
			'type'        => Controls_Manager::URL,
			'label'       => __( 'URL', 'aura-prime' ),
			'label_block' => false,
			'placeholder' => __( 'https://your-link.com', 'aura-prime' ),
			'dynamic'     => [ 'active' => true ],
			'default'     => [ 'url' => '#' ],
		] );

		$this->add_control( 'hr', [
			'type' => Controls_Manager::DIVIDER,
		] );

		$this->add_control( 'icon_type', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Icon Type', 'aura-prime' ),
			'default' => 'default',
			'options' => [
				'none'         => __( 'None', 'aura-prime' ),
				'default'      => __( 'Default', 'aura-prime' ),
				'font_awesome' => __( 'Font Awesome', 'aura-prime' ),
			],
		] );

		$this->add_control( 'icon_font_awesome_class', [
			'type'      => Controls_Manager::ICON,
			'label'     => __( 'Font Awesome Icon', 'aura-prime' ),
			'default'   => 'fa fa-long-arrow-right',
			'condition' => [
				'icon_type' => 'font_awesome',
			],
		] );

		$this->add_control( 'icon_position', [
			'name'      => '',
			'type'      => Controls_Manager::SELECT,
			'label'     => __( 'Icon Position', 'aura-prime' ),
			'default'   => 'after_text',
			'options'   => [
				'before_text' => __( 'Before Text', 'aura-prime' ),
				'after_text'  => __( 'After Text', 'aura-prime' ),
			],
			'condition' => [
				'icon_type' => 'font_awesome',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_style', [
			'label' => __( 'Button', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'display', [
			'type'        => Controls_Manager::CHOOSE,
			'label'       => __( 'Display', 'aura-prime' ),
			'label_block' => false,
			'default'     => 'inline-block',
			'options'     => [
				'inline-block' => [
					'title' => __( 'Inline Block', 'aura-prime' ),
					'icon'  => 'eicon-h-align-center',
				],
				'block'        => [
					'title' => __( 'Block', 'aura-prime' ),
					'icon'  => 'eicon-h-align-stretch',
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .aura-button' => 'display: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'padding', [
			'label'      => __( 'Padding', 'aura-prime' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-button' => '--aura-button--padding-top: {{TOP}}{{UNIT}}; --aura-button--padding-right: {{RIGHT}}{{UNIT}}; --aura-button--padding-bottom: {{BOTTOM}}{{UNIT}}; --aura-button--padding-left: {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'border_width', [
			'label'      => __( 'Border Width', 'aura-prime' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-button' => '--aura-button--border-top-width: {{TOP}}{{UNIT}}; --aura-button--border-right-width: {{RIGHT}}{{UNIT}}; --aura-button--border-bottom-width: {{BOTTOM}}{{UNIT}}; --aura-button--border-left-width: {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'border_radius', [
			'label'      => __( 'Border Radius', 'aura-prime' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-button' => '--aura-button--border-top-left-radius: {{TOP}}{{UNIT}}; --aura-button--border-top-right-radius: {{RIGHT}}{{UNIT}}; --aura-button--border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; --aura-button--border-bottom-right-radius: {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_space', [
			'label'      => __( 'Icon Space', 'aura-prime' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .aura-button' => '--aura-button__icon--space: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'color', [
			'label'     => __( 'Text Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button--color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_color', [
			'label'     => __( 'Background Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button--background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_color', [
			'label'     => __( 'Border Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button--border-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'typography',
			'selector' => '{{WRAPPER}} .aura-button',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_overlay', [
			'label' => __( 'Button Hover', 'aura-prime' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'hover_color', [
			'label'     => __( 'Text Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button__hover--color: {{VALUE}};',
			],
		] );

		$this->add_control( 'hover_background_color', [
			'label'     => __( 'Background Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button__hover--background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'hover_border_color', [
			'label'     => __( 'Border Color', 'aura-prime' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .aura-button' => '--aura-button__hover--border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = [
			'type'     => $settings['type'],
			'text'     => $settings['text'],
			'url'      => $settings['url']['url'],
			'external' => $settings['url']['is_external'],
			'nofollow' => $settings['url']['nofollow'],
		];

		if ( 'none' === $settings['icon_type'] ) {
			$args['icon_type'] = '';
		} elseif ( 'font_awesome' === $settings['icon_type'] ) {
			$args['icon_font_class'] = $settings['icon_font_awesome_class'];
			$args['icon_position']   = $settings['icon_position'];
		}

		get_template_part( 'template-parts/button', $args );
	}

	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function _content_template() {}
}
